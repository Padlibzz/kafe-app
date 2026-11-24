<?php

namespace Database\Seeders;

use App\Models\DetailPesanan;
use App\Models\Menu;
use App\Models\Pesanan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KdsTestDataSeeder extends Seeder
{
    public function run(): void
    {
        $menu = Menu::query()->first() ?? Menu::query()->create([
            'nama_menu' => 'Menu Testing KDS',
            'deskripsi' => 'Menu untuk pengujian KDS',
            'harga' => 25000,
            'foto' => 'testing-kds.jpg',
            'ketersediaan' => true,
        ]);

        foreach (['pending', 'dibuat', 'diproses', 'dibayar', 'selesai'] as $status) {
            if (Pesanan::query()->where('status', $status)->where('catatan', 'Data testing KDS')->exists()) {
                continue;
            }

            DB::transaction(function () use ($menu, $status): void {
                $order = Pesanan::query()->create([
                    'status' => $status,
                    'total_harga' => $menu->harga,
                    'catatan' => 'Data testing KDS',
                ]);

                DetailPesanan::query()->create([
                    'id_pesanan' => $order->getKey(),
                    'id_menu' => $menu->getKey(),
                    'jumlah' => 1,
                    'subtotal' => $menu->harga,
                ]);
            });
        }
    }
}
