<?php

namespace App\Http\Controllers;

use App\FamilyLandingPage;
use Illuminate\Http\Request;
use \TCG\Voyager\Models\Page;
use Illuminate\Support\Facades\Auth;
use App\Branch;
use App\Libary;
use App\Http\Controllers\TemplateController;
use App\Temple;
use App\AlbumCategory;
// use App\FamilyLandingPage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PageController extends Controller
{
  public function index($branch_id, $slug_gia_pha, $slug_bai_viet)
  {

    if (Auth::user()->branch_id != $branch_id) {
      return redirect()->back();
    }


    $page = Page::where('branch_id', $branch_id)->where('slug', $slug_bai_viet)->first();

    if (empty($page)) {
      return redirect()->back();
    }

    $branch = Branch::where('id', $branch_id)->first();

    $template = TemplateController::checkTemplate();

    // dd($template);

    return view('screens.page')->with(compact('page', 'slug_gia_pha', 'branch', 'template'));
  }

  // public function edit($branch_id, $slug_gia_pha, $slug_bai_viet)
  // {
  //   if (Auth::user()->branch_id != $branch_id) {
  //     return redirect()->back();
  //   }

  //   $page = Page::where('branch_id', $branch_id)->where('slug', $slug_bai_viet)->first();

  //   if (empty($page)) {
  //     return redirect()->back();
  //   }

  //   $branch = Branch::where('id', $branch_id)->first();

  //   $template = TemplateController::checkTemplate();

  //   return view('screens.page-edit')->with(compact('page', 'slug_gia_pha', 'branch', 'template'));
  // }

  // public function update(Request $request, $branch_id, $slug_gia_pha, $slug_bai_viet)
  // {
  //   $page = Page::where('branch_id', $branch_id)->where('slug', $slug_bai_viet)->first();

  //   $page->body = $request->body;

  //   $page->save();

  //   $branch = Branch::where('id', $branch_id)->first();

  //   $template = TemplateController::checkTemplate();

  //   return redirect()->route('page', [
  //     'branch_id' => $branch_id,
  //     'slug_gia_pha' => $slug_gia_pha,
  //     'slug_bai_viet' => $slug_bai_viet
  //   ])->with(compact('template'));
  // }

  //17-9-2024
  public function edit()
  {
    $page = Page::where('branch_id', auth()->user()->branch_id)->where('slug', 'gioi-thieu')->first();

    if (empty($page)) {
      return redirect()->back();
    }

    return view('screens.auth.about')->with(compact('page'));
  }

  public function update(Request $request)
  {
    // Validate request
    $request->validate([
      'body' => 'required|string',
      'timeline' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
      'important_people' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Tìm page 'gioi-thieu' của branch hiện tại
    $page = Page::where('branch_id', auth()->user()->branch_id)
      ->where('slug', 'gioi-thieu')
      ->first();

    $familyHome = auth()->user()->familyHome->first();

    $page->body = $request->body;

    // Handle Timeline upload
    if ($request->hasFile('timeline')) {
      $timelineFile = $request->file('timeline');
      $fileName = time() . '_' . $timelineFile->getClientOriginalName();
      $filePath = $timelineFile->storeAs('family-landing-pages/timeline', $fileName, 'public');
      $familyHome->timeline = $filePath;
    }

    // Handle Important People upload
    if ($request->hasFile('important_people')) {
      $importantPeopleFile = $request->file('important_people');
      $importantPeopleFileName = time() . '_' . $importantPeopleFile->getClientOriginalName();
      $importantPeopleFilePath = $importantPeopleFile->storeAs('family-landing-pages/important_people', $importantPeopleFileName, 'public');
      $familyHome->important_people = $importantPeopleFilePath;
    }

    $familyHome->save();
    $page->save();

    $template = TemplateController::checkTemplate();

    return redirect()->route('page', [
      'branch_id' => auth()->user()->branch_id,
      'slug_gia_pha' => auth()->user()->lineage->slug,
      'slug_bai_viet' => 'gioi-thieu'
    ])->with(compact('template'));
  }
  //End











  public function album($branch_id, $slug_gia_pha, $category_slug = null)
  {
    $branch = Branch::where('id', $branch_id)->first();
    $template = TemplateController::checkTemplate();
    $categorise_album = AlbumCategory::where('user_id', auth()->user()->id)->get();

    // Nếu không có category_id, mặc định lấy category đầu tiên
    $current_category = $category_slug
      ? AlbumCategory::where('user_id', auth()->user()->id)->where('slug', $category_slug)->first()
      : AlbumCategory::where('user_id', auth()->user()->id)->first();

    return view('screens.temple', compact('slug_gia_pha', 'branch', 'template', 'categorise_album', 'current_category'));
  }



  public function album_category_store(Request $request)
  {
    $slug = Str::slug($request->name, '-');

    AlbumCategory::create([
      'name' => $request->name,
      'user_id' => auth()->id(),
      'slug' => $slug,
    ]);

    return redirect()->back();
  }


  public function album_image_store(Request $request)
  {
    // Lưu file ảnh vào thư mục
    if ($request->hasFile('image')) {
      $image = $request->file('image');
      $imageName = time() . '_' . $image->getClientOriginalName();
      $image->storeAs('public/albums', $imageName);

      // Lưu thông tin ảnh vào cơ sở dữ liệu
      $album = new \App\AlbumImage();
      $album->name = $request->input('image_name');
      $album->image = 'albums/' . $imageName;
      $album->album_category_id = $request->input('category_id');
      $album->save();
    }

    return redirect()->back();
  }


  public function album_category_delete(Request $request)
  {
    $category = AlbumCategory::find($request->category_id);
    if ($category->images->count() > 0) {
      return redirect()->back()->with('error', 'Không thể xóa danh mục này vì nó có ảnh.');
    } else {
      $category->delete();
    }

    return redirect()->route('temple', [
      'branch_id' => auth()->user()->branch_id,
      'slug_gia_pha' => auth()->user()->lineage->slug
    ]);
  }

  public function album_image_delete(Request $request)
  {
    $image = \App\AlbumImage::find($request->image_id);

    if ($image && $image->image) {
      Storage::disk('public')->delete($image->image);
    }

    // Xóa bản ghi hình ảnh khỏi DB
    $image->delete();

    // Thông báo thành công
    return redirect()->back()->with('success', 'Hình ảnh đã được xóa thành công.');
  }


  public function dien_dan($branch_id, $slug_gia_pha)
  {
    $template = TemplateController::checkTemplate();

    return view('screens.dien_dan', compact('template', 'branch_id', 'slug_gia_pha'));
  }


  public function secondHome()
  {
    $template = TemplateController::checkTemplate();
    $data = FamilyLandingPage::where('user_id', Auth::user()->id)->first();

    $libaries = Libary::where('user_id', auth()->user()->id)->get();

    return view('screens.second-home', compact('template', 'data', 'libaries'));
  }
}
