<?php

use App\Models\Absensi;
use App\Models\Admin;
use App\Models\AturanLoyalty;
use App\Models\Customer;
use App\Models\LaporanKeuangan;
use App\Models\LogStatusPesanan;
use App\Models\Meja;
use App\Models\Menu;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

Route::get('/', fn () => session()->has('admin_id')
    ? redirect()->route('admin.orders')
    : redirect()->route('admin.login'));

Route::get('/admin/login', function () {
    if (Admin::find(session('admin_id'))) {
        return redirect()->route('admin.orders');
    }

    return view('admin.login');
})->name('admin.login');
Route::post('/admin/login', function (Request $request) {
    $credentials = $request->validate(['username' => ['required', 'string'], 'password' => ['required', 'string']]);
    $admin = Admin::where('username', $credentials['username'])->first();
    if (! $admin || ! Hash::check($credentials['password'], $admin->password)) {
        return back()->withErrors(['username' => 'Username atau password salah.'])->onlyInput('username');
    }
    $request->session()->regenerate();
    $request->session()->put('admin_id', $admin->getKey());

    return redirect()->route('admin.orders');
})->name('admin.login.submit');

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/orders', fn () => view('admin.orders', ['orders' => Pesanan::with(['customer', 'meja'])->latest()->paginate(15)]))->name('admin.orders');
    Route::get('/kds', function (Request $request) {
        $status = $request->validate(['status' => ['sometimes', 'in:pending,dibuat,diproses,dibayar,selesai']])['status'] ?? null;
        $sort = $request->validate(['sort' => ['sometimes', 'in:lama,baru']])['sort'] ?? 'lama';
        $visibleOrders = fn ($query) => $query->where(function ($query) {
            $query->whereIn('status', ['pending', 'dibuat', 'diproses', 'dibayar'])
                ->orWhere(fn ($completed) => $completed->where('status', 'selesai')->whereDate('updated_at', today()));
        });
        $statusCounts = Pesanan::query()->where($visibleOrders)->selectRaw('status, COUNT(*) as aggregate')->groupBy('status')->pluck('aggregate', 'status');
        $orders = Pesanan::with(['customer', 'meja', 'detailPesanan.menu'])
            ->where($visibleOrders)
            ->when($status === 'pending', fn ($query) => $query->whereIn('status', ['pending', 'dibuat']))
            ->when($status && $status !== 'pending', fn ($query) => $query->where('status', $status))
            ->orderBy('created_at', $sort === 'baru' ? 'desc' : 'asc')
            ->get();
        $statusCounts = $statusCounts->map(fn ($count) => (int) $count);

        return view('admin.kds', compact('orders', 'statusCounts'));
    })->name('admin.kds');
    Route::patch('/kds/{pesanan}/transition', function (Pesanan $pesanan) {
        $nextStatus = ['pending' => 'diproses', 'dibuat' => 'diproses', 'diproses' => 'dibayar', 'dibayar' => 'selesai'];
        DB::transaction(function () use ($pesanan, $nextStatus) {
            $lockedOrder = Pesanan::query()->lockForUpdate()->findOrFail($pesanan->getKey());
            abort_unless(isset($nextStatus[$lockedOrder->status]), 422, 'Status pesanan tidak dapat diubah dari KDS.');
            $oldStatus = $lockedOrder->status;
            $lockedOrder->status = $nextStatus[$oldStatus];
            $lockedOrder->save();
            $log = new LogStatusPesanan;
            $log->id_pesanan = $lockedOrder->getKey();
            $log->status_lama = $oldStatus;
            $log->status_baru = $nextStatus[$oldStatus];
            $log->created_by = (string) session('admin_id');
            $log->save();
        });

        return redirect()->route('admin.kds')->with('status', 'Status pesanan berhasil diperbarui.');
    })->name('admin.kds.transition');
    Route::get('/menus', fn () => view('admin.menus', ['menus' => Menu::orderBy('nama_menu')->paginate(15)]))->name('admin.menus');
    Route::get('/menus/create', fn () => view('admin.menu-form', ['menu' => new Menu]))->name('admin.menus.create');
    Route::post('/menus', function (Request $request) {
        $data = $request->validate([
            'nama_menu' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'harga' => ['required', 'numeric', 'min:0'],
            'foto' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'ketersediaan' => ['required', 'boolean'],
        ]);
        $data['foto'] = $request->file('foto')->store('menus', 'public');
        $menu = new Menu;
        $menu->nama_menu = $data['nama_menu'];
        $menu->deskripsi = $data['deskripsi'];
        $menu->harga = $data['harga'];
        $menu->foto = $data['foto'];
        $menu->ketersediaan = $data['ketersediaan'];
        $menu->save();

        return redirect()->route('admin.menus');
    })->name('admin.menus.store');
    Route::get('/menus/{menu}/edit', fn (Menu $menu) => view('admin.menu-form', compact('menu')))->name('admin.menus.edit');
    Route::put('/menus/{menu}', function (Request $request, Menu $menu) {
        $data = $request->validate([
            'nama_menu' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'harga' => ['required', 'numeric', 'min:0'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'ketersediaan' => ['required', 'boolean'],
        ]);
        if ($request->hasFile('foto')) {
            $newPhoto = $request->file('foto')->store('menus', 'public');
            if ($menu->foto && Storage::disk('public')->exists($menu->foto)) {
                Storage::disk('public')->delete($menu->foto);
            }
            $data['foto'] = $newPhoto;
        } else {
            unset($data['foto']);
        }
        $menu->nama_menu = $data['nama_menu'];
        $menu->deskripsi = $data['deskripsi'];
        $menu->harga = $data['harga'];
        $menu->ketersediaan = $data['ketersediaan'];
        if (isset($data['foto'])) {
            $menu->foto = $data['foto'];
        }
        $menu->save();

        return redirect()->route('admin.menus');
    })->name('admin.menus.update');
    Route::patch('/menus/{menu}/availability', function (Menu $menu) {
        $menu->update(['ketersediaan' => ! $menu->ketersediaan]);

        return redirect()->route('admin.menus');
    })->name('admin.menus.availability');
    Route::get('/tables', fn () => view('admin.tables', ['tables' => Meja::orderBy('nomor_meja')->paginate(15)]))->name('admin.tables');
    Route::get('/customers', fn () => view('admin.customers', ['customers' => Customer::query()->select(['id_customer', 'nama', 'saldo_poin'])->orderBy('nama')->orderBy('id_customer')->paginate(15)]))->name('admin.customers');
    Route::get('/loyalty', fn () => view('admin.loyalty', ['rules' => AturanLoyalty::query()->select(['id', 'nama', 'deskripsi', 'poin_per_transaksi', 'minimal_poin'])->orderBy('nama')->paginate(15)]))->name('admin.loyalty');
    Route::get('/attendance', fn () => view('admin.attendance', ['attendances' => Absensi::query()->select(['id', 'id_karyawan', 'tanggal', 'status', 'jam_masuk', 'jam_keluar'])->with('karyawan:id_karyawan,nama')->orderByDesc('tanggal')->orderByDesc('id')->paginate(15)]))->name('admin.attendance');
    Route::get('/reports/finance', fn () => view('admin.finance-reports', ['reports' => LaporanKeuangan::query()->select(['id', 'start_date', 'end_date', 'total_pendapatan', 'total_biaya', 'created_at'])->orderByDesc('created_at')->orderByDesc('id')->paginate(15)]))->name('admin.finance-reports');
    Route::get('/tables/create', fn () => view('admin.table-form', ['table' => new Meja]))->name('admin.tables.create');
    Route::post('/tables', function (Request $request) {
        $data = $request->validate(['nomor_meja' => ['required', 'string', 'max:255', 'unique:mejas,nomor_meja']]);
        $meja = new Meja;
        $meja->nomor_meja = $data['nomor_meja'];
        $meja->kode_qr = Str::random(40);
        $meja->save();

        return redirect()->route('admin.tables');
    })->name('admin.tables.store');
    Route::get('/tables/{meja}/edit', fn (Meja $meja) => view('admin.table-form', ['table' => $meja]))->name('admin.tables.edit');
    Route::put('/tables/{meja}', function (Request $request, Meja $meja) {
        $data = $request->validate(['nomor_meja' => ['required', 'string', 'max:255', 'unique:mejas,nomor_meja,'.$meja->id_meja.',id_meja']]);
        $meja->nomor_meja = $data['nomor_meja'];
        $meja->save();

        return redirect()->route('admin.tables');
    })->name('admin.tables.update');
    Route::post('/logout', function (Request $request) {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    })->name('admin.logout');
});
