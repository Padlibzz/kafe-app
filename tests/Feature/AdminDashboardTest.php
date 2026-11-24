<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Menu;
use App\Models\Pesanan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_dashboard(): void
    {
        $this->get(route('admin.dashboard'))->assertRedirect(route('admin.login'));
    }

    public function test_customer_and_employee_sessions_do_not_authorize_admin_dashboard(): void
    {
        $this->withSession(['customer_id' => 99])
            ->get(route('admin.dashboard'))
            ->assertRedirect(route('admin.login'));

        $this->withSession(['karyawan_id' => 99])
            ->get(route('admin.dashboard'))
            ->assertRedirect(route('admin.login'));
    }

    public function test_admin_sees_dashboard_totals_and_top_menu_from_saved_data(): void
    {
        $admin = new Admin;
        $admin->nama = 'Admin';
        $admin->username = 'admin';
        $admin->password = 'secret';
        $admin->save();

        $menu = new Menu;
        $menu->nama_menu = 'Kopi Uji';
        $menu->deskripsi = 'Menu testing';
        $menu->harga = 25000;
        $menu->foto = 'menus/test.jpg';
        $menu->ketersediaan = false;
        $menu->save();

        $order = new Pesanan;
        $order->status = 'selesai';
        $order->total_harga = 50000;
        $order->save();

        $orderDetail = $order->detailPesanan()->getRelated();
        $orderDetail->id_menu = $menu->getKey();
        $orderDetail->jumlah = 2;
        $orderDetail->subtotal = 50000;
        $order->detailPesanan()->save($orderDetail);

        $this->withSession(['admin_id' => $admin->getKey()])
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Dashboard Utama')
            ->assertSee('Rp50.000')
            ->assertSee('Kopi Uji')
            ->assertSee('2 terjual')
            ->assertSee('Menu Tidak Tersedia')
            ->assertSee('1', false);
    }
}
