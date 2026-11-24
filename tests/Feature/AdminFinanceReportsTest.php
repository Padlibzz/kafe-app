<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\LaporanKeuangan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminFinanceReportsTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_finance_reports(): void
    {
        $this->get(route('admin.finance-reports'))->assertRedirect(route('admin.login'));
    }

    public function test_admin_sees_persisted_finance_report_fields(): void
    {
        $admin = new Admin;
        $admin->nama = 'Admin';
        $admin->username = 'admin';
        $admin->password = 'secret';
        $admin->save();

        $report = new LaporanKeuangan;
        $report->start_date = '2026-11-01';
        $report->end_date = '2026-11-15';
        $report->total_pendapatan = '1250.50';
        $report->total_biaya = '450.25';
        $report->save();

        $response = $this->withSession(['admin_id' => $admin->getKey()])
            ->get(route('admin.finance-reports'))
            ->assertOk()
            ->assertSee('01/11/2026')
            ->assertSee('15/11/2026')
            ->assertSee('1250.50')
            ->assertSee('450.25');

        $this->assertSame(['id', 'start_date', 'end_date', 'total_pendapatan', 'total_biaya', 'created_at'], array_keys($response->viewData('reports')->items()[0]->getAttributes()));
    }
}
