<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Document;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\File;

class DocumentController extends Controller
{
  public function index()
  {
    $docs = Document::where('user_id', auth()->user()->id)->get();
    // dd($docs);

    return view('screens.auth.document', compact('docs'));
  }

  public function add()
  {
    $docs = Document::where('user_id', auth()->user()->id)->get();
    $i = 0;
    foreach ($docs as $doc) {
      $i += Storage::disk('public')->size($doc->file);
    }
    // $sizeInMB = 100;
    $sizeInMB = number_format($i / (1024 * 1024), 2);
    // dd($sizeInMB);

    if (auth()->user()->loai_dich_vu == 1) {
      if ($sizeInMB >= 100) {
        $alert = [
          "type" => "error",
          "title" => __("Tải lên thất bại"),
          "body" => __("Bạn đã đạt đến giới hạn dung lượng tải lên!")
        ];

        return redirect()->back()->with('alert',$alert);
      }
    } elseif (auth()->user()->loai_dich_vu == 2) {
      if ($sizeInMB >= 1000) {
        $alert = [
          "type" => "error",
          "title" => __("Tải lên thất bại"),
          "body" => __("Bạn đã đạt đến giới hạn dung lượng tải lên!")
        ];

        return redirect()->back()->with('alert',$alert);
      }
    } else {
      if ($sizeInMB >= 10000) {
        $alert = [
          "type" => "error",
          "title" => __("Tải lên thất bại"),
          "body" => __("Bạn đã đạt đến giới hạn dung lượng tải lên!")
        ];

        return redirect()->back()->with('alert',$alert);
      }
    }


    return view('screens.auth.document-add');
  }

  public function store(Request $request)
  {
    // Validate the request
    $data = $request->validate([
      'name' => 'required|string',
      'file' => 'required|file|mimes:pdf,doc,docx|max:2048', // Ensure the file is of valid type and size
    ], [
      'name.required' => 'Tên tài liệu không được để trống',
      'name.string' => 'Tên tài liệu không được chứa kí tự đặc biệt',
      'file.required' => 'Tài liệu không được để trống',
      'file.mimes' => 'Tài liệu phải có định dạng pdf, doc hoặc docx',
      'file.max' => 'Tài liệu không được vượt quá 2MB',
    ]);

    // Handle the file upload
    $file = $request->file('file');
    $path = Storage::disk('public')->put('uploads/documents', $file);

    // Save the document info to the database
    Document::create([
      'name' => $data['name'],
      'file' => $path,
      'user_id' => auth()->user()->id,
    ]);

    // Prepare alert message
    $alert = [
      "type" => "success",
      "title" => __("Thành công"),
      "body" => __("Tài liệu đã được thêm thành công!")
    ];

    // Redirect with alert
    return redirect()->route('documents')->with('alert', $alert);
  }

  public function delete($id)
  {
    // Find the document entry
    $document = Document::find($id);

    if (!$document) {
      return redirect()->route('documents')->with('error', 'Không tìm thấy tài liệu.');
    }

    // Ensure the document belongs to the currently authenticated user
    if ($document->user_id != auth()->user()->id) {
      return redirect()->back()->with('error', 'Bạn không có quyền xóa tài liệu này.');
    }

    // Delete the file from storage
    Storage::disk('public')->delete($document->file);

    // Delete the document record from the database
    $document->delete();

    return redirect()->route('documents')->with('success', 'Tài liệu đã được xóa thành công.');
  }
}