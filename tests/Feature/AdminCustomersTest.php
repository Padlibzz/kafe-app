<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCustomersTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_customer_list(): void
    {
        $this->get(route('admin.customers'))->assertRedirect(route('admin.login'));
    }

    public function test_admin_sees_customer_details_without_email_or_password(): void
    {
        $admin = new Admin;
        $admin->nama = 'Admin';
        $admin->username = 'admin';
        $admin->password = 'secret';
        $admin->save();
        foreach (range(1, 16) as $number) {
            $customer = new Customer;
            $customer->nama = sprintf('Customer %02d', $number === 16 ? 15 : $number);
            $customer->email = 'private'.$number.'@example.test';
            $customer->password = 'customer-secret';
            $customer->saldo_poin = 42;
            $customer->save();
        }

        $response = $this->withSession(['admin_id' => $admin->getKey()])
            ->get(route('admin.customers'))
            ->assertOk()
            ->assertSee('Customer 01')
            ->assertSee('42')
            ->assertDontSee('private1@example.test')
            ->assertDontSee('customer-secret')
            ->assertSee('Pelanggan')
            ->assertSee('Customer 15')
            ->assertSee('pagination');

        $customer = $response->viewData('customers')->items()[0];

        $this->assertSame(['id_customer', 'nama', 'saldo_poin'], array_keys($customer->getAttributes()));

        $this->withSession(['admin_id' => $admin->getKey()])
            ->get(route('admin.customers', ['page' => 2]))
            ->assertOk()
            ->assertSee('Customer 15')
            ->assertDontSee('Customer 14');

        $customers = $response->viewData('customers')->items();
        $this->assertSame('Customer 15', $customers[14]->nama);
        $this->assertSame(15, $customers[14]->getKey());
    }
}
