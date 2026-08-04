<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LineageController extends Controller
{
  protected $path;
  public function __construct()
  {
    $this->path = Storage::disk('public');
  }
  // public function index() : View
  // {
  //     $data = Lineage::with(['branch' ])->get();
  //     $lineage = json_encode($data);
  //     return view('pages.lineage')->with(compact('lineage'));
  // }

  public function uploadImage(Request $request)
  {

    if ($file = $request->file('files')) {
      $fileData = $this->path->put('members', $file);
    }
    $url_image = env('APP_URL') . '/storage/' . $fileData;
    return response()->json($url_image);
  }
}
