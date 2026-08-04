<?php

namespace App\Http\Middleware;

use Closure;
use App\Announcement;
use Carbon\Carbon;

class CheckAnnouncementTime
{
  public function handle($request, Closure $next)
  {
    // Kiểm tra xem thông báo đã được xử lý trong phiên này chưa
    if (session()->has('announcements_processed')) {
      return $next($request);
    }

    // Lấy danh sách thông báo đã hiển thị trong session của phiên đăng nhập hiện tại
    $shownNotifications = session('shown_notifications', []);

    $now = Carbon::now()->format('Y-m-d');

    $notifications = Announcement::where('user_id', auth()->user()->id)->whereNotIn('id', $shownNotifications)
      ->where(function ($query) use ($now) {
        $query->orWhere(function ($subQuery) use ($now) {
          // Option 0: Hiển thị trước ngày thông báo 5 ngày, không tính ngày đã qua
          $subQuery->where('option', 0)
            ->where('datetime', '>=', Carbon::parse($now)->subDays(5)->format('Y-m-d'))
            ->where('datetime', '>=', Carbon::today()->format('Y-m-d')); // Không lấy những ngày đã qua
        })
          ->orWhere(function ($subQuery) use ($now) {
            // Option 1: Hiển thị trước ngày thông báo 7 ngày, không tính ngày đã qua
            $subQuery->where('option', 1)
              ->where('datetime', '>=', Carbon::parse($now)->subDays(7)->format('Y-m-d'))
              ->where('datetime', '>=', Carbon::today()->format('Y-m-d')); // Không lấy những ngày đã qua
          })
          ->orWhere(function ($subQuery) use ($now) {
            // Option 2: Hiển thị trước ngày thông báo 1 tháng, không tính ngày đã qua
            $subQuery->where('option', 2)
              ->where('datetime', '>=', Carbon::parse($now)->subMonth()->format('Y-m-d'))
              ->where('datetime', '>=', Carbon::today()->format('Y-m-d')); // Không lấy những ngày đã qua
          });
      })
      ->get();


    // Kiểm tra nếu có thông báo mới
    if ($notifications->isNotEmpty()) {
      // Lưu vào session những thông báo đã hiển thị
      $shownIds = array_merge($shownNotifications, $notifications->pluck('id')->toArray());
      session()->put('shown_notifications', $shownIds);

      // Flash thông báo để hiển thị trong view
      session()->put('notifications', $notifications);
    }

    // Đánh dấu là đã xử lý thông báo cho phiên này
    session()->put('announcements_processed', true);

    return $next($request);
  }
}
