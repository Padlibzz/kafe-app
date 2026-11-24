<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Karyawan;
use App\Models\Menu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_shows_public_landing_page_and_available_menu(): void
    {
        $menu = new Menu;
        $menu->nama_menu = 'Kopi Uji';
        $menu->deskripsi = 'Kopi pilihan';
        $menu->harga = 18000;
        $menu->foto = 'kopi-uji.jpg';
        $menu->ketersediaan = true;
        $menu->save();

        $unavailableMenu = new Menu;
        $unavailableMenu->nama_menu = 'Menu Tidak Tersedia';
        $unavailableMenu->deskripsi = 'Tidak ditampilkan';
        $unavailableMenu->harga = 21000;
        $unavailableMenu->foto = 'menu-tidak-tersedia.jpg';
        $unavailableMenu->ketersediaan = false;
        $unavailableMenu->save();

        $this->get('/')
            ->assertOk()
            ->assertSee('Chōgō Coffee')
            ->assertSee('Kopi Uji')
            ->assertSee('Rp18.000')
            ->assertDontSee('Menu Tidak Tersedia')
            ->assertSee(route('admin.login'))
            ->assertSee(route('customer.register'));
    }

    public function test_login_page_shows_brand_and_account_types(): void
    {
        $this->get(route('admin.login'))
            ->assertOk()
            ->assertSee('Selamat datang kembali')
            ->assertSee('Admin')
            ->assertSee('Karyawan')
            ->assertSee('Pelanggan')
            ->assertSee(route('customer.register'));
    }

    public function test_admin_can_login_using_existing_username_credentials(): void
    {
        $admin = new Admin;
        $admin->nama = 'Admin';
        $admin->username = 'admin';
        $admin->password = 'secret-password';
        $admin->save();

        $this->post(route('admin.login.submit'), ['account_type' => 'admin', 'username' => 'admin', 'password' => 'secret-password'])
            ->assertRedirect(route('admin.dashboard'))
            ->assertSessionHas('admin_id', $admin->getKey());
    }

    public function test_employee_credentials_are_verified_without_granting_admin_session(): void
    {
        $employee = new Karyawan;
        $employee->nama = 'Staff';
        $employee->username = 'staff';
        $employee->password = 'secret-password';
        $employee->hak_akses = 'staff';
        $employee->save();

        $this->post(route('admin.login.submit'), ['account_type' => 'employee', 'username' => 'staff', 'password' => 'secret-password'])
            ->assertRedirect(route('admin.login'))
            ->assertSessionHas('account_notice', 'Akun karyawan berhasil diverifikasi. Area akun karyawan belum tersedia.')
            ->assertSessionMissing('admin_id');
    }

    public function test_customer_credentials_are_verified_by_email_without_granting_admin_session(): void
    {
        $customer = new Customer;
        $customer->nama = 'Pelanggan';
        $customer->email = 'member@example.test';
        $customer->password = 'secret-password';
        $customer->saldo_poin = 0;
        $customer->save();

        $this->post(route('admin.login.submit'), ['account_type' => 'customer', 'username' => 'member@example.test', 'password' => 'secret-password'])
            ->assertRedirect(route('admin.login'))
            ->assertSessionHas('account_notice', 'Akun pelanggan berhasil diverifikasi. Area akun pelanggan belum tersedia.')
            ->assertSessionMissing('admin_id');
    }

    public function test_login_rejects_credentials_for_the_wrong_selected_account_type(): void
    {
        $admin = new Admin;
        $admin->nama = 'Admin';
        $admin->username = 'admin';
        $admin->password = 'secret-password';
        $admin->save();

        $this->from(route('admin.login'))->post(route('admin.login.submit'), ['account_type' => 'employee', 'username' => 'admin', 'password' => 'secret-password'])
            ->assertRedirect(route('admin.login'))
            ->assertSessionHasErrors('username')
            ->assertSessionMissing('admin_id');
    }

    public function test_customer_registration_creates_customer_without_authenticating_session(): void
    {
        $this->get(route('customer.register'))
            ->assertOk()
            ->assertSee('Buat akun pelanggan')
            ->assertSee('Akun admin dan karyawan');

        $this->post(route('customer.register.submit'), [
            'nama' => 'Pelanggan Baru',
            'email' => 'baru@example.test',
            'password' => 'password-aman',
            'password_confirmation' => 'password-aman',
            'terms' => '1',
        ])->assertRedirect(route('customer.register'))
            ->assertSessionHas('registration_success');

        $customer = Customer::query()->where('email', 'baru@example.test')->sole();
        $this->assertSame('Pelanggan Baru', $customer->nama);
        $this->assertSame(0, $customer->saldo_poin);
        $this->assertNotSame('password-aman', $customer->password);
        $this->assertNull(session('customer_id'));
    }

    public function test_customer_registration_validates_duplicate_email_password_confirmation_and_terms(): void
    {
        $existing = new Customer;
        $existing->nama = 'Sudah Ada';
        $existing->email = 'member@example.test';
        $existing->password = 'secret-password';
        $existing->saldo_poin = 0;
        $existing->save();

        $this->from(route('customer.register'))
            ->post(route('customer.register.submit'), [
                'nama' => 'Pendaftar',
                'email' => 'member@example.test',
                'password' => 'password-aman',
                'password_confirmation' => 'tidak-sama',
            ])
            ->assertRedirect(route('customer.register'))
            ->assertSessionHasErrors(['email', 'password', 'terms']);

        $this->assertDatabaseCount('customers', 1);
    }

    public function test_login_rejects_unknown_account_type(): void
    {
        $this->from(route('admin.login'))->post(route('admin.login.submit'), ['account_type' => 'owner', 'username' => 'owner', 'password' => 'secret'])
            ->assertRedirect(route('admin.login'))
            ->assertSessionHasErrors('account_type');
    }
}
