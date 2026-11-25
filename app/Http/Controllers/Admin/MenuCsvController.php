<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MenuCsvController extends Controller
{
    private const CSV_HEADERS = ['nama_menu', 'deskripsi', 'harga', 'foto', 'ketersediaan'];

    public function export(): StreamedResponse
    {
        return response()->streamDownload(function (): void {
            $output = fopen('php://output', 'w');

            if ($output === false) {
                return;
            }

            fputcsv($output, self::CSV_HEADERS, ',', '"', '');

            Menu::query()->orderBy('id_menu')->chunk(500, function ($menus) use ($output): void {
                foreach ($menus as $menu) {
                    fputcsv($output, [
                        $menu->nama_menu,
                        $menu->deskripsi,
                        $menu->harga,
                        $menu->foto,
                        (int) $menu->ketersediaan,
                    ], ',', '"', '');
                }
            });

            fclose($output);
        }, 'menu-harga.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function import(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:csv,txt', 'max:5120'],
        ]);

        $handle = fopen($request->file('file')->getRealPath(), 'r');

        if ($handle === false) {
            return back()->withErrors(['file' => 'File CSV tidak dapat dibaca.']);
        }

        $headers = fgetcsv($handle, escape: '\\');

        if ($headers === false) {
            fclose($handle);

            return back()->withErrors(['file' => 'File CSV kosong atau header tidak valid.']);
        }

        $headers[0] = preg_replace('/^\\xEF\\xBB\\xBF/', '', (string) $headers[0]);

        if ($headers !== self::CSV_HEADERS) {
            fclose($handle);

            return back()->withErrors([
                'file' => 'Header harus berurutan: '.implode(',', self::CSV_HEADERS).'.',
            ]);
        }

        $rows = [];
        $errors = [];
        $line = 1;

        while (($values = fgetcsv($handle, escape: '\\')) !== false) {
            $line++;

            if ($values === [null] || $values === []) {
                continue;
            }

            if (count($values) !== count(self::CSV_HEADERS)) {
                $errors[] = "Baris {$line}: jumlah kolom tidak sesuai.";

                continue;
            }

            $row = array_combine(self::CSV_HEADERS, $values);
            $validator = Validator::make($row, [
                'nama_menu' => ['required', 'string', 'max:255'],
                'deskripsi' => ['required', 'string', 'max:255'],
                'harga' => ['required', 'numeric', 'min:0', 'max:999999.99'],
                'foto' => ['nullable', 'string', 'max:255'],
                'ketersediaan' => ['required', 'in:0,1'],
            ]);

            if ($validator->fails()) {
                $errors[] = "Baris {$line}: ".implode(' ', $validator->errors()->all());

                continue;
            }

            if ($row['foto'] !== '' && ! Storage::disk('public')->exists($row['foto'])) {
                $errors[] = "Baris {$line}: file foto '{$row['foto']}' tidak ditemukan di storage public.";

                continue;
            }

            $rows[] = $row;
        }

        fclose($handle);

        if ($errors !== []) {
            return back()->withErrors(['file' => $errors])->withInput();
        }

        if ($rows === []) {
            return back()->withErrors(['file' => 'Tidak ada baris menu untuk diimpor.']);
        }

        DB::transaction(function () use ($rows): void {
            foreach ($rows as $row) {
                $menu = new Menu;
                $menu->nama_menu = $row['nama_menu'];
                $menu->deskripsi = $row['deskripsi'];
                $menu->harga = $row['harga'];
                $menu->foto = $row['foto'] ?? '';
                $menu->ketersediaan = $row['ketersediaan'] === '1';
                $menu->save();
            }
        });

        return redirect()->route('admin.menus')->with('status', count($rows).' menu berhasil diimpor.');
    }
}
