<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Meja;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTablesTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_table_create_and_store(): void
    {
        $this->get('/admin/tables/create')->assertRedirect(route('admin.login'));
        $this->post('/admin/tables', ['nomor_meja' => 'Meja 1'])->assertRedirect(route('admin.login'));

        $this->assertDatabaseCount('mejas', 0);
    }

    public function test_admin_sees_table_create_form_and_generated_token_explanation(): void
    {
        $this->actingAsAdmin();

        $this->get(route('admin.tables.create'))
            ->assertOk()
            ->assertSee('Tambah Meja Baru')
            ->assertSee('Informasi Meja')
            ->assertSee('Nomor atau nama meja')
            ->assertSee('Token QR akan dibuat otomatis')
            ->assertSee('Simpan Meja');
    }

    public function test_admin_sees_existing_table_data_and_update_preserves_token(): void
    {
        $this->actingAsAdmin();
        $table = new Meja;
        $table->nomor_meja = 'Meja Teras';
        $table->kode_qr = 'preserved-token';
        $table->save();

        $this->get(route('admin.tables.edit', $table))
            ->assertOk()
            ->assertSee('Ubah Data Meja')
            ->assertSee('Meja Teras')
            ->assertSee('preserved-token')
            ->assertSee('Simpan Perubahan Meja');
    }

    public function test_admin_can_create_table_with_generated_qr_token(): void
    {
        $this->actingAsAdmin();

        $this->post('/admin/tables', ['nomor_meja' => 'Meja 1', 'kode_qr' => 'attacker-token'])
            ->assertRedirect(route('admin.tables'));

        $table = Meja::query()->sole();
        $this->assertSame('Meja 1', $table->nomor_meja);
        $this->assertSame(40, strlen($table->kode_qr));
        $this->assertNotSame('attacker-token', $table->kode_qr);
    }

    public function test_updating_table_number_preserves_qr_token(): void
    {
        $this->actingAsAdmin();
        $table = new Meja;
        $table->nomor_meja = 'Meja 1';
        $table->kode_qr = 'stable-token';
        $table->save();

        $this->put("/admin/tables/{$table->getKey()}", ['nomor_meja' => 'Meja 2', 'kode_qr' => 'attacker-token'])
            ->assertRedirect(route('admin.tables'));

        $this->assertSame('Meja 2', $table->fresh()->nomor_meja);
        $this->assertSame('stable-token', $table->fresh()->kode_qr);
    }

    public function test_admin_sees_table_cards_and_search_instead_of_fake_occupancy_or_scannable_qr(): void
    {
        $this->actingAsAdmin();
        $table = new Meja;
        $table->nomor_meja = 'Window 01';
        $table->kode_qr = 'saved-token';
        $table->save();

        $this->get(route('admin.tables'))
            ->assertOk()
            ->assertSee('Manajemen Meja & QR')
            ->assertSee('Window 01')
            ->assertSee('Token · saved-token')
            ->assertSee('tables-search')
            ->assertSee('bukan QR yang dapat dipindai.')
            ->assertDontSee('16 Meja Terisi');
    }

    public function test_admin_cannot_create_table_with_duplicate_number(): void
    {
        $this->actingAsAdmin();
        $table = new Meja;
        $table->nomor_meja = 'Meja 1';
        $table->kode_qr = 'existing-token';
        $table->save();

        $this->from('/admin/tables/create')
            ->post('/admin/tables', ['nomor_meja' => 'Meja 1'])
            ->assertRedirect('/admin/tables/create')
            ->assertSessionHasErrors('nomor_meja');

        $this->assertDatabaseCount('mejas', 1);
    }

    private function actingAsAdmin(): void
    {
        $admin = new Admin;
        $admin->nama = 'Admin';
        $admin->username = 'admin';
        $admin->password = 'secret';
        $admin->save();
        $this->withSession(['admin_id' => $admin->getKey()]);
    }
}
