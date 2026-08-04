<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckDateTime
{
  public function handle(Request $request, Closure $next): Response
  {
    $currentDate = now();
    $user = Auth::user();

    if ($user->role_id == 1) {
      return $next($request);
    }

    $ngayGiaHan = $user->ngay_gia_han;
    $soNgayHan = $user->so_ngay_han;

    $daysDifference = $currentDate->diffInDays($ngayGiaHan);

    if ($daysDifference >= $soNgayHan || $ngayGiaHan == '') {
      $alert = [
        "type" => "error",
        "title" => __("Tài khoản hết hạn"),
        "body" => __("Tài khoản bạn đã hết hạn, hãy liên hệ để gia hạn thêm!")
      ];
      return redirect()->route('payment')->with('alert', $alert);
    }

    return $next($request);
  }
}