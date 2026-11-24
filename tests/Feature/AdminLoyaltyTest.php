<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\AturanLoyalty;
use App\Models\Customer;
use App\Models\Reward;
use App\Models\RiwayatPoin;
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
            ->assertSee('Aturan Poin & Loyalty')
            ->assertSee('Aturan perolehan poin')
            ->assertSee('Status penukaran')
            ->assertSee('Aktivitas poin terbaru')
            ->assertSee('Riwayat penukaran reward');
    }

    public function test_admin_sees_point_and_reward_history_without_credentials(): void
    {
        $admin = new Admin;
        $admin->nama = 'Admin';
        $admin->username = 'admin';
        $admin->password = 'secret';
        $admin->save();

        $customer = new Customer;
        $customer->nama = 'Pelanggan Uji';
        $customer->email = 'private@example.test';
        $customer->password = 'private-password';
        $customer->saldo_poin = 40;
        $customer->save();

        $rule = new AturanLoyalty;
        $rule->nama = 'Aturan Uji';
        $rule->deskripsi = 'Aturan uji';
        $rule->poin_per_transaksi = 5;
        $rule->minimal_poin = 0;
        $rule->save();

        $point = new RiwayatPoin;
        $point->id_customer = $customer->getKey();
        $point->id_aturan_loyalty = $rule->getKey();
        $point->tipe = 'tambah';
        $point->poin = 5;
        $point->keterangan = 'Pembelian uji';
        $point->save();

        $reward = new Reward;
        $reward->id_customer = $customer->getKey();
        $reward->id_aturan_loyalty = $rule->getKey();
        $reward->poin_digunakan = 10;
        $reward->status = 'pending';
        $reward->save();

        $this->withSession(['admin_id' => $admin->getKey()])
            ->get(route('admin.loyalty'))
            ->assertOk()
            ->assertSee('Pelanggan Uji')
            ->assertSee('Pembelian uji')
            ->assertSee('Riwayat penukaran reward')
            ->assertSee('10')
            ->assertDontSee('private@example.test')
            ->assertDontSee('private-password');
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
