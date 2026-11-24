<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\AturanLoyalty;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminLoyaltyTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_loyalty_rules(): void
    {
        $this->get(route('admin.loyalty'))->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_view_loyalty_rules_without_personal_history(): void
    {
        $admin = new Admin;
        $admin->nama = 'Admin';
        $admin->username = 'admin';
        $admin->password = 'secret';
        $admin->save();

        $rule = new AturanLoyalty;
        $rule->nama = 'Poin transaksi';
        $rule->deskripsi = 'Poin diberikan setiap transaksi';
        $rule->poin_per_transaksi = 5;
        $rule->minimal_poin = 20;
        $rule->save();

        $this->withSession(['admin_id' => $admin->getKey()])
            ->get(route('admin.loyalty'))
            ->assertOk()
            ->assertSee('Poin transaksi')
            ->assertSee('Poin diberikan setiap transaksi')
            ->assertSee('5')
            ->assertSee('20')
            ->assertSee('Loyalty');
    }

    public function test_admin_can_paginate_loyalty_rules(): void
    {
        $admin = new Admin;
        $admin->nama = 'Admin';
        $admin->username = 'admin';
        $admin->password = 'secret';
        $admin->save();

        for ($number = 1; $number <= 16; $number++) {
            $rule = new AturanLoyalty;
            $rule->nama = sprintf('Rule %02d', $number);
            $rule->deskripsi = sprintf('Description %02d', $number);
            $rule->poin_per_transaksi = $number;
            $rule->minimal_poin = $number * 10;
            $rule->save();
        }

        $this->withSession(['admin_id' => $admin->getKey()])
            ->get(route('admin.loyalty'))
            ->assertOk()
            ->assertDontSee('Rule 16');

        $this->withSession(['admin_id' => $admin->getKey()])
            ->get(route('admin.loyalty', ['page' => 2]))
            ->assertOk()
            ->assertSee('Rule 16');
    }
}
