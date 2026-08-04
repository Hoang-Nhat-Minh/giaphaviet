<?php

namespace App\Http\Controllers;

use App\FamilyLandingPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
  public function addImage(Request $request)
  {
    $family_landing_page = FamilyLandingPage::find(auth()->user()->familyHome->first()->id);

    if (auth()->user()->id != $family_landing_page->user_id) {
      return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
    }

    if ($request->hasFile('gallery')) {
      $file = $request->file('gallery');
      $path = Storage::disk('public')->put('images/gallery', $file);

      $gallery = json_decode($family_landing_page->gallery, true);
      $gallery[] = $path;

      $family_landing_page->update([
        'gallery' => json_encode($gallery)
      ]);

      return response()->json(['success' => true, 'url' => Storage::url($path)]);
    }

    return response()->json(['success' => false, 'message' => 'No file uploaded'], 400);
  }

  public function removeImage(Request $request)
  {
    // dd('sfsdf');
    $family_landing_page = FamilyLandingPage::find(auth()->user()->familyHome->first()->id);

    if (auth()->user()->id != $family_landing_page->user_id) {
      return redirect()->back();
    }

    $gallery = json_decode($family_landing_page->gallery, true);

    if (isset($gallery[$request->index])) {
      // dd($gallery[$request->index]);
      Storage::disk('public')->delete($gallery[$request->index]);
      unset($gallery[$request->index]);
      $gallery = array_values($gallery); // Reindex the array

      $family_landing_page->update([
        'gallery' => json_encode($gallery)
      ]);

    }

    return response()->json(['success' => true]);
  }

  public function moveImageUp(Request $request)
  {
    $family_landing_page = FamilyLandingPage::find(auth()->user()->familyHome->first()->id);

    $gallery = json_decode($family_landing_page->gallery, true);

    if ($request->index > 0 && isset($gallery[$request->index])) {
      $temp = $gallery[$request->index];
      $gallery[$request->index] = $gallery[$request->index - 1];
      $gallery[$request->index - 1] = $temp;

      $family_landing_page->update([
        'gallery' => json_encode($gallery)
      ]);

    }
    return response()->json(['success' => true]);
  }

  public function moveImageDown(Request $request)
  {
    $family_landing_page = FamilyLandingPage::find(auth()->user()->familyHome->first()->id);

    $gallery = json_decode($family_landing_page->gallery, true);

    if (isset($gallery[$request->index]) && isset($gallery[$request->index + 1])) {
      $temp = $gallery[$request->index];
      $gallery[$request->index] = $gallery[$request->index + 1];
      $gallery[$request->index + 1] = $temp;

      $family_landing_page->update([
        'gallery' => json_encode($gallery)
      ]);
    }

    return response()->json(['success' => true]);
  }
}