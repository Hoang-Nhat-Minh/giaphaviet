<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Announcement;


class AnnouncementController extends Controller
{
  public function index()
  {
    $anouncements = Announcement::where('user_id', auth()->user()->id)->get();

    return view('screens.auth.announcement', compact('anouncements'));
  }

  public function add()
  {
    return view('screens.auth.announcement-add');
  }
  public function store(Request $request)
  {
    $count = Announcement::where('user_id', auth()->user()->id)->count();
    if ($count >= 5) {
      $alert = [
        "type" => "error",
        "title" => __("Thất bại"),
        "body" => __("Giới hạn 5 thông báo!")
      ];

      return redirect()->route('announcement')->with('alert', $alert);
    }

    // dd($request);
    $data = $request->validate([
      'name' => 'required|string',
      'datetime' => 'required|after_or_equal:now',
    ], [
      'name.required' => 'Tên thông báo không được để trống.',
      'name.string' => 'Tên thông báo không hợp lệ.',
      'datetime.required' => 'Hãy nhập thời gian thông báo.',
      'datetime.after_or_equal' => 'Thông báo không được đăng trước thời gian hiện tại.',
    ]);

    Announcement::create([
      'name' => $data['name'],
      'datetime' => $data['datetime'],
      'option' => $request['options'],
      'user_id' => auth()->user()->id
    ]);

    $alert = [
      "type" => "success",
      "title" => __("Thành công"),
      "body" => __("Thêm thông báo thành công!")
    ];

    return redirect()->route('announcement')->with('alert', $alert);
  }

  public function delete(Request $request)
  {
    $announcement = Announcement::find($request->id);

    if ($announcement->user_id != auth()->user()->id) {
      return redirect()->back()->with('alert', [
        "type" => "success",
        "title" => __("Thành công"),
        "body" => __("Bạn không có quyền!")
      ]);
    }

    $announcement->delete();

    return redirect()->route('announcement')->with('alert', [
      "type" => "success",
      "title" => __("Thành công"),
      "body" => __("Xóa thông báo thành công!")
    ]);
  }
}