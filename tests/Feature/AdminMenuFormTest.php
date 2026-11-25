<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Menu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminMenuFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_sees_menu_creation_form_with_labeled_fields(): void
    {
        $admin = new Admin;
        $admin->nama = 'Admin';
        $admin->username = 'admin';
        $admin->password = 'secret';
        $admin->save();

        $this->withSession(['admin_id' => $admin->getKey()])
            ->get(route('admin.menus.create'))
            ->assertOk()
            ->assertSee('Informasi Dasar Produk')
            ->assertSee('id="nama_menu"', false)
            ->assertSee('id="deskripsi"', false)
            ->assertSee('id="harga"', false)
            ->assertSee('id="foto"', false)
            ->assertSee('Simpan Menu')
            ->assertSee('Live Preview Kartu Menu')
            ->assertSee('Tambah Menu Racikan Baru');
    }

    public function test_admin_can_upload_menu_photo(): void
    {
        Storage::fake('public');
        $admin = $this->createAdmin();

        $this->withSession(['admin_id' => $admin->getKey()])
            ->post(route('admin.menus.store'), [
                'nama_menu' => 'Kopi Susu',
                'deskripsi' => 'Kopi susu test',
                'harga' => 25000,
                'foto' => UploadedFile::fake()->image('kopi.jpg'),
                'ketersediaan' => 1,
            ])
            ->assertRedirect(route('admin.menus'));

        $menu = Menu::query()->firstOrFail();
        $this->assertDatabaseHas('menus', ['id_menu' => $menu->getKey()]);
        Storage::disk('public')->assertExists($menu->foto);
    }

    public function test_menu_edit_keeps_current_photo_when_no_replacement_is_uploaded(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('menus/current.jpg', 'existing image');
        $admin = $this->createAdmin();
        $menu = new Menu;
        $menu->nama_menu = 'Kopi Susu';
        $menu->deskripsi = 'Kopi susu test';
        $menu->harga = 25000;
        $menu->foto = 'menus/current.jpg';
        $menu->ketersediaan = true;
        $menu->save();

        $this->withSession(['admin_id' => $admin->getKey()])
            ->put(route('admin.menus.update', $menu), [
                'nama_menu' => 'Kopi Susu Baru',
                'deskripsi' => 'Deskripsi baru',
                'harga' => 27000,
                'ketersediaan' => 1,
            ])
            ->assertRedirect(route('admin.menus'));

        $this->assertSame('menus/current.jpg', $menu->fresh()->foto);
        Storage::disk('public')->assertExists('menus/current.jpg');
    }

    public function test_admin_can_toggle_menu_availability(): void
    {
        $admin = $this->createAdmin();
        $menu = new Menu;
        $menu->nama_menu = 'Kopi Susu';
        $menu->deskripsi = 'Kopi susu test';
        $menu->harga = 25000;
        $menu->foto = 'menus/current.jpg';
        $menu->ketersediaan = true;
        $menu->save();

        $this->withSession(['admin_id' => $admin->getKey()])
            ->patch(route('admin.menus.availability', $menu))
            ->assertRedirect(route('admin.menus'));

        $this->assertFalse((bool) $menu->fresh()->ketersediaan);
    }

    public function test_admin_sees_menu_catalog_with_search_stock_filters_and_saved_menu_data(): void
    {
        $admin = $this->createAdmin();
        $menu = new Menu;
        $menu->nama_menu = 'Kopi Gula Aren';
        $menu->deskripsi = 'Espresso dengan susu dan gula aren';
        $menu->harga = 28000;
        $menu->foto = 'menus/kopi-gula-aren.jpg';
        $menu->ketersediaan = true;
        $menu->save();

        $this->withSession(['admin_id' => $admin->getKey()])
            ->get(route('admin.menus'))
            ->assertOk()
            ->assertSee('Katalog Menu & Manajemen Harga')
            ->assertSee('Kopi Gula Aren')
            ->assertSee('Espresso dengan susu dan gula aren')
            ->assertSee('Rp28.000')
            ->assertSee('data-stock-filter="available"', false)
            ->assertSee('Habis')
            ->assertDontSee('HPP:')
            ->assertDontSee('Best Seller');
    }

    public function test_admin_can_import_valid_menu_csv_rows(): void
    {
        $admin = $this->createAdmin();
        $csv = "nama_menu,deskripsi,harga,foto,ketersediaan\nKopi CSV,Menu dari CSV,28000,,1\n";

        $this->withSession(['admin_id' => $admin->getKey()])
            ->post(route('admin.menus.import'), [
                'file' => UploadedFile::fake()->createWithContent('menus.csv', $csv),
            ])
            ->assertRedirect(route('admin.menus'))
            ->assertSessionHas('status', '1 menu berhasil diimpor.');

        $this->assertDatabaseHas('menus', [
            'nama_menu' => 'Kopi CSV',
            'harga' => 28000,
            'ketersediaan' => true,
        ]);
    }

    public function test_invalid_menu_csv_does_not_import_any_rows(): void
    {
        $admin = $this->createAdmin();
        $csv = "nama_menu,deskripsi,harga,foto,ketersediaan\nKopi Valid,Menu valid,28000,,1\nKopi Invalid,Menu invalid,bukan-harga,,1\n";

        $this->withSession(['admin_id' => $admin->getKey()])
            ->from(route('admin.menus'))
            ->post(route('admin.menus.import'), [
                'file' => UploadedFile::fake()->createWithContent('menus.csv', $csv),
            ])
            ->assertRedirect(route('admin.menus'))
            ->assertSessionHasErrors('file');

        $this->assertDatabaseMissing('menus', ['nama_menu' => 'Kopi Valid']);
        $this->assertDatabaseMissing('menus', ['nama_menu' => 'Kopi Invalid']);
    }

    public function test_admin_can_export_menu_csv_with_headers_and_saved_data(): void
    {
        $admin = $this->createAdmin();
        $menu = new Menu;
        $menu->nama_menu = 'Kopi CSV';
        $menu->deskripsi = 'Menu ekspor';
        $menu->harga = 28000;
        $menu->foto = '';
        $menu->ketersediaan = true;
        $menu->save();

        $response = $this->withSession(['admin_id' => $admin->getKey()])
            ->get(route('admin.menus.export'))
            ->assertOk()
            ->assertDownload('menu-harga.csv');

        $this->assertStringContainsString('nama_menu,deskripsi,harga,foto,ketersediaan', $response->streamedContent());
        $this->assertStringContainsString('Kopi CSV,Menu ekspor,28000.00,,1', str_replace('"', '', $response->streamedContent()));
    }

    private function createAdmin(): Admin
    {
        $admin = new Admin;
        $admin->nama = 'Admin';
        $admin->username = 'admin';
        $admin->password = 'secret';
        $admin->save();

        return $admin;
    }
}
