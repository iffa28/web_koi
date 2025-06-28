<?php

namespace Tests\Unit;

use App\Http\Controllers\AdminPesananController;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Mockery;
use Tests\TestCase;

class AdminPesananControllerTest extends TestCase
{
    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }

    /** @test */
    public function batalkan_status_hanya_bisa_dilakukan_oleh_admin()
    {
        Auth::shouldReceive('user')->once()->andReturn((object)['role' => 'user']);

        $controller = new AdminPesananController();

        $this->expectException(\Symfony\Component\HttpKernel\Exception\HttpException::class);
        $this->expectExceptionMessage('Akses ditolak. Halaman ini hanya untuk admin.');

        $controller->batalkanStatus(1);
    }
}
