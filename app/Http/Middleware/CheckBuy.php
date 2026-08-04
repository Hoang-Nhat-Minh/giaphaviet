<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckBuy
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || empty(auth()->user()->loai_dich_vu)) {
            return redirect()->back()->with('error', 'Tài khoản của bạn chưa mua gói dịch vụ nào.');
        }

        return $next($request);
    }
}
