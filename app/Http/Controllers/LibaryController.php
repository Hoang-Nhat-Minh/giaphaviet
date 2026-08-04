<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Libary;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\File;

class LibaryController extends Controller
{
  public function index()
  {
    $libaries = Libary::where('user_id', auth()->user()->id)->get();

    return view('screens.auth.libary', compact('libaries'));
  }

  public function view($id)
  {
    $library = Libary::find($id);

    if (!$library) {
      return redirect()->route('library')->with('error', 'Không tìm thấy dữ liệu.');
    }

    if ($library->user_id != auth()->user()->id) {
      return redirect()->back();
    }

    return view('screens.auth.libary-view', compact('library'));
  }

  public function add()
  {
    return view('screens.auth.libary-add');
  }

  public function store(Request $request)
  {
    // Validate the request
    $data = $request->validate([
      'name' => 'required|string',
      'date' => 'required|date',
      'img' => 'required|image|mimes:jpeg,jpg,png', // Validate the single image field
      'des' => 'required|string',
      'content' => 'required|string',
    ], [
      'name.required' => 'Tên không được để trống.',
      'name.string' => 'Tên phải là một chuỗi.',
      'date.required' => 'Ngày không được để trống.',
      'date.date' => 'Ngày phải là một ngày hợp lệ.',
      'img.required' => 'Ảnh không được để trống.',
      'img.image' => 'Ảnh phải là một file ảnh.',
      'img.mimes' => 'Ảnh phải có định dạng jpeg, jpg, png.',
      'des.required' => 'Giới thiệu ngắn không được để trống.',
      'des.string' => 'Giới thiệu phải là một chuỗi.',
      'content.required' => 'Nội dung không được để trống.',
      'content.string' => 'Nội dung phải là một chuỗi.',
    ]);

    // Handle image upload
    if ($request->hasFile('img')) {
      // Store the image in a folder using Storage facade
      $path = Storage::disk('public')->put('uploads/images', $request->file('img'));
      $data['img'] = $path; // Save the relative file path
    }

    // Save data to the database
    Libary::create([
      'name' => $data['name'],
      'datetime' => $data['date'],
      'img' => $data['img'],
      'des' => $data['des'],
      'content' => $data['content'],
      'user_id' => auth()->user()->id,
    ]);

    $alert = [
      "type" => "success",
      "title" => __("Thành công"),
      "body" => __("Thêm sự kiện thành công!")
    ];

    return redirect()->route('library')->with('alert', $alert);
  }


  public function delete($id)
  {
    // Tìm thư viện sự kiện
    $library = Libary::findOrFail($id);

    // Kiểm tra quyền của người dùng
    if ($library->user_id != auth()->user()->id) {
      return redirect()->back()->with('error', 'Bạn không có quyền xóa sự kiện này.');
    }

    // Lấy đường dẫn ảnh
    $imagePath = Voyager::image($library->img);

    // Xóa ảnh nếu tồn tại
    if (file_exists($imagePath)) {
      File::delete($imagePath);
    }

    // Xóa sự kiện sau khi xóa ảnh
    $library->delete();

    // Thông báo thành công
    $alert = [
      "type" => "success",
      "title" => __("Thành công"),
      "body" => __("Xóa sự kiện thành công!")
    ];

    return redirect()->route('library')->with('alert', $alert);
  }



  public function edit($id)
  {
    $library = Libary::find($id);

    // dd($libary);

    if (!$library) {
      return redirect()->route('library')->with('error', 'Không tìm thấy dữ liệu.');
    }

    if ($library->user_id != auth()->user()->id) {
      return redirect()->back();
    }

    return view('screens.auth.libary-update', compact('library'));
  }

  public function update(Request $request, $id)
  {
    // Validate the request
    $data = $request->validate([
      'name' => 'required|string|max:255',
      'date' => 'required|date',
      'img' => 'image|mimes:jpeg,jpg,png|nullable', // Allow optional image upload
      'des' => 'required|string|max:255',
      'content' => 'required|string',
    ], [
      'name.required' => 'Tên không được để trống.',
      'name.string' => 'Tên phải là một chuỗi.',
      'date.required' => 'Ngày không được để trống.',
      'date.date' => 'Ngày phải là một ngày hợp lệ.',
      'img.image' => 'Ảnh phải là một file ảnh.',
      'img.mimes' => 'Ảnh phải có định dạng jpeg, jpg, png.',
      'des.required' => 'Giới thiệu không được để trống.',
      'content.required' => 'Nội dung không được để trống.',
    ]);

    // Retrieve the library event from the database
    $library = Libary::findOrFail($id);

    // Handle image upload if a new image is uploaded
    if ($request->hasFile('img')) {
      // Delete the old image if exists
      if ($library->img) {
        Storage::disk('public')->delete($library->img);
      }

      // Store the new image
      $path = Storage::disk('public')->put('uploads/images', $request->file('img'));
      $data['img'] = $path;
    }

    // Update the library event data
    $library->update([
      'name' => $data['name'],
      'datetime' => $data['date'], // Assuming this is the event date
      'img' => $data['img'] ?? $library->img, // Use old image if no new image uploaded
      'des' => $data['des'],
      'content' => $data['content'],
    ]);

    // Set a success message
    $alert = [
      "type" => "success",
      "title" => __("Thành công"),
      "body" => __("Cập nhật sự kiện thành công!")
    ];

    // Redirect back with a success message
    return redirect()->route('library')->with('alert', $alert);
  }

}