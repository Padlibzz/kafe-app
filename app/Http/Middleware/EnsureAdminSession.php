<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminSession
{
    public function handle(Request $request, Closure $next): Response
    {
        $admin = Admin::find($request->session()->get('admin_id'));

        if (! $admin) {
            return redirect()->route('admin.login');
        }

        view()->share('authenticatedAdmin', $admin);

        return $next($request);
    }
}
