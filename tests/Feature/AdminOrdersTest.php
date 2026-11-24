<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Pesanan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminOrdersTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_sees_indonesian_labels_for_order_statuses(): void
    {
        $admin = new Admin;
        $admin->nama = 'Admin';
        $admin->username = 'admin';
        $admin->password = 'secret';
        $admin->save();

        foreach (['pending' => 'Menunggu', 'dibuat' => 'Dibuat', 'dibayar' => 'Dibayar', 'diproses' => 'Diproses', 'selesai' => 'Selesai', 'dibatalkan' => 'Dibatalkan'] as $status => $label) {
            $order = new Pesanan;
            $order->status = $status;
            $order->total_harga = 0;
            $order->save();
        }

        $this->withSession(['admin_id' => $admin->getKey()])
            ->get(route('admin.orders'))
            ->assertOk()
            ->assertSee('Diproses')
            ->assertSee('Selesai')
            ->assertSee('Menunggu')
            ->assertSee('Dibuat')
            ->assertSee('Dibayar')
            ->assertSee('Dibatalkan');
    }
}
