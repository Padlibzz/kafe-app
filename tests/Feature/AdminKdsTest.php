<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Pesanan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminKdsTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_sees_orders_grouped_in_kds_lanes(): void
    {
        $admin = new Admin;
        $admin->nama = 'Admin';
        $admin->username = 'admin';
        $admin->password = 'secret';
        $admin->save();

        foreach (['pending', 'dibuat', 'diproses', 'dibayar', 'selesai'] as $status) {
            $order = new Pesanan;
            $order->status = $status;
            $order->total_harga = 0;
            $order->save();
        }

        $this->withSession(['admin_id' => $admin->getKey()])
            ->get(route('admin.kds'))
            ->assertOk()
            ->assertSee('Live KDS Display')
            ->assertSee('Pesanan Masuk')
            ->assertSee('Pesanan Dibuat')
            ->assertSee('Proses Dapur &amp; Barista', false)
            ->assertSee('Siap Saji / Ambil')
            ->assertSee('Selesai Hari Ini')
            ->assertSee('#CHG-');
    }

    public function test_admin_can_advance_order_and_status_change_is_logged(): void
    {
        $admin = new Admin;
        $admin->nama = 'Admin';
        $admin->username = 'admin';
        $admin->password = 'secret';
        $admin->save();

        $order = new Pesanan;
        $order->status = 'pending';
        $order->total_harga = 0;
        $order->save();

        $this->withSession(['admin_id' => $admin->getKey()])
            ->patch(route('admin.kds.transition', $order))
            ->assertRedirect(route('admin.kds'));

        $this->assertSame('diproses', $order->fresh()->status);
        $this->assertDatabaseHas('log_status_pesanans', [
            'id_pesanan' => $order->getKey(),
            'status_lama' => 'pending',
            'status_baru' => 'diproses',
            'created_by' => (string) $admin->getKey(),
        ]);
    }

    public function test_status_filter_returns_only_matching_orders(): void
    {
        $admin = new Admin;
        $admin->nama = 'Admin';
        $admin->username = 'admin';
        $admin->password = 'secret';
        $admin->save();

        foreach (['pending', 'diproses'] as $status) {
            $order = new Pesanan;
            $order->status = $status;
            $order->total_harga = 0;
            $order->save();
        }

        $this->withSession(['admin_id' => $admin->getKey()])
            ->get(route('admin.kds', ['status' => 'dibuat']))
            ->assertOk()
            ->assertSee('Semua Pesanan (2)')
            ->assertSee('1 pesanan antre')
            ->assertDontSee('Tandai Siap Saji');
    }

    public function test_dibuat_filter_returns_order_with_dibuat_status(): void
    {
        $admin = new Admin;
        $admin->nama = 'Admin';
        $admin->username = 'admin';
        $admin->password = 'secret';
        $admin->save();

        $order = new Pesanan;
        $order->status = 'dibuat';
        $order->total_harga = 0;
        $order->save();

        $this->withSession(['admin_id' => $admin->getKey()])
            ->get(route('admin.kds', ['status' => 'dibuat']))
            ->assertOk()
            ->assertSee('1 pesanan antre')
            ->assertSee('Mulai Proses');
    }

    public function test_each_supported_kds_transition_advances_only_one_step(): void
    {
        $admin = new Admin;
        $admin->nama = 'Admin';
        $admin->username = 'admin';
        $admin->password = 'secret';
        $admin->save();

        foreach (['pending' => 'diproses', 'dibuat' => 'diproses', 'diproses' => 'dibayar', 'dibayar' => 'selesai'] as $oldStatus => $newStatus) {
            $order = new Pesanan;
            $order->status = $oldStatus;
            $order->total_harga = 0;
            $order->save();

            $this->withSession(['admin_id' => $admin->getKey()])
                ->patch(route('admin.kds.transition', $order))
                ->assertRedirect(route('admin.kds'));

            $this->assertSame($newStatus, $order->fresh()->status);
        }

        $this->assertDatabaseCount('log_status_pesanans', 4);
    }
}
