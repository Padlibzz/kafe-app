<?php

namespace Tests\Feature;

use App\Models\Absensi;
use App\Models\Admin;
use App\Models\Karyawan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAttendanceTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_attendance_list(): void
    {
        $this->get(route('admin.attendance'))->assertRedirect(route('admin.login'));
    }

    public function test_admin_sees_attendance_details_without_employee_credentials(): void
    {
        $admin = new Admin;
        $admin->nama = 'Admin';
        $admin->username = 'admin';
        $admin->password = 'secret';
        $admin->save();

        $employee = new Karyawan;
        $employee->nama = 'Karyawan Contoh';
        $employee->username = 'private-user';
        $employee->password = 'private-password';
        $employee->hak_akses = 'staff';
        $employee->save();

        $attendance = new Absensi;
        $attendance->id_karyawan = $employee->getKey();
        $attendance->tanggal = '2026-11-20';
        $attendance->status = 'hadir';
        $attendance->jam_masuk = '2026-11-20 08:05:00';
        $attendance->jam_keluar = '2026-11-20 17:00:00';
        $attendance->save();

        $response = $this->withSession(['admin_id' => $admin->getKey()])
            ->get(route('admin.attendance'))
            ->assertOk()
            ->assertSee('Karyawan Contoh')
            ->assertSee('20/11/2026')
            ->assertSee('hadir')
            ->assertSee('08:05')
            ->assertSee('17:00')
            ->assertDontSee('private-user')
            ->assertDontSee('private-password');

        $this->assertSame(['id', 'id_karyawan', 'tanggal', 'status', 'jam_masuk', 'jam_keluar'], array_keys($response->viewData('attendances')->items()[0]->getAttributes()));
        $this->assertSame(['id_karyawan', 'nama'], array_keys($response->viewData('attendances')->items()[0]->karyawan->getAttributes()));
    }
}
