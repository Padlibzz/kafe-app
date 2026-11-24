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
