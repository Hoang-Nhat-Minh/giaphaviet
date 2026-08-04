<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FamilyLandingPage;

class FamilyLandingPageController extends Controller
{
  public function editCustom()
  {
    $family_landing_page = FamilyLandingPage::find(auth()->user()->familyHome->first()->id);
    if (auth()->user()->id != $family_landing_page->user_id) {
      return redirect()->back();
    }
    // $galleries = Gallery::where('family_home_id', $family_landing_page->id)->get();

    return view('screens.auth.edit-homepage', compact('family_landing_page'));
  }

  public function update(Request $request)
  {
    // dd($request);
    $family_landing_page = FamilyLandingPage::find(auth()->user()->familyHome->first()->id);

    if (auth()->user()->id != $family_landing_page->user_id) {
      return redirect()->back();
    }

    $data = $request->validate([
      'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
      'about' => 'string',
      'about_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
      'address' => 'string',
      'telephone' => 'string',
      'email' => 'string',
      // 'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096', // Validate gallery images
    ], [
      'banner.image' => 'Tệp được chọn phải là một hình ảnh.',
      'banner.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, hoặc gif.',
      'banner.max' => 'Kích thước tệp không được lớn hơn 4MB.',
      'about_image.image' => 'Tệp được chọn phải là một hình ảnh.',
      'about_image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, hoặc gif.',
      'about_image.max' => 'Kích thước tệp không được lớn hơn 4MB.',
      // 'gallery.*.image' => 'Tất cả các tệp trong gallery phải là hình ảnh.',
      // 'gallery.*.mimes' => 'Hình ảnh trong gallery phải có định dạng: jpeg, png, jpg, hoặc gif.',
      // 'gallery.*.max' => 'Kích thước tệp trong gallery không được lớn hơn 4MB.',
      'about.string' => 'Trường about phải là một chuỗi.',
      'address.string' => 'Trường địa chỉ phải là một chuỗi.',
      'telephone.string' => 'Trường số điện thoại phải là một chuỗi.',
      'email.string' => 'Trường email phải là một chuỗi.',
    ]);

    if ($request->hasFile('banner')) {
      $image = $request->file('banner');
      $imageName = time() . '.' . $image->getClientOriginalExtension();
      $path = $image->storeAs('public/images', $imageName);
      $data['banner'] = str_replace('public/', '', $path);
    }

    if ($request->hasFile('about_image')) {
      $image = $request->file('about_image');
      $imageName = time() . '.' . $image->getClientOriginalExtension();
      $path = $image->storeAs('public/images', $imageName);
      $data['about_image'] = str_replace('public/', '', $path);
    }

    // Xử lý gallery images
    // if ($request->hasFile('gallery')) {
    //   $galleryImages = [];
    //   foreach ($request->file('gallery') as $image) {
    //     if ($image) {
    //       $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
    //       $path = $image->storeAs('public/images/gallery', $imageName);
    //       $galleryImages[] = str_replace('public/', '', $path);
    //     }
    //   }
    //   $data['gallery'] = json_encode($galleryImages); // Lưu gallery images dưới dạng JSON
    // }

    $family_landing_page->update([
      'banner' => $data['banner'] ?? $family_landing_page->banner,
      'about' => $data['about'],
      'about_image' => $data['about_image'] ?? $family_landing_page->about_image,
      'address' => $data['address'],
      'telephone' => $data['telephone'],
      'email' => $data['email'],
      // 'gallery' => $data['gallery'] ?? $family_landing_page->gallery, // Giữ gallery cũ nếu không có ảnh mới
    ]);

    return redirect()->route('second.home');
  }
}
