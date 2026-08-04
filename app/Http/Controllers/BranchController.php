<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Branch;

class BranchController extends Controller
{
  public function index($lineage_id, $slug)
  {
    if (Auth::user()->lineage_id != $lineage_id) {
      return redirect()->back();
    }

    $branch = Branch::where('lineage_id', $lineage_id)->first();
    $slug_gia_pha = $slug;

    $template = \App\Http\Controllers\TemplateController::checkTemplate();
    
    // Ghi log số lượng thành viên
    if ($branch && !empty($branch->data)) {
        $dataArray = is_string($branch->data) ? json_decode($branch->data, true) : $branch->data;
        $memberCount = is_array($dataArray) ? count($dataArray) : 0;
        \Log::info("Branch {$branch->id} loaded with {$memberCount} members.");
    }


    return view('screens.home')->with(compact('branch', 'slug_gia_pha', 'template'));
  }

  public function update(Request $request, $id)
  {
    $branch = Branch::where('id', $id)->first();
    if (!$branch) {
      return response()->json(['message' => 'Không tìm thấy chi phái.'], 404);
    }

    // Security Ownership Check (Prevent IDOR vulnerability)
    if (auth()->user()->lineage_id != $branch->lineage_id) {
      return response()->json(['message' => 'Bạn không có quyền chỉnh sửa dòng họ này.'], 403);
    }

    // Security Package / License Check
    $loaiDichVu = (int) auth()->user()->loai_dich_vu;
    if (empty($loaiDichVu)) {
      return response()->json(['message' => 'Tài khoản của bạn chưa đăng ký gói dịch vụ nào.'], 403);
    }

    $data = $request->all();
    $memberCount = is_array($data) ? count($data) : 0;

    // Package Member Limits Enforcement
    if ($loaiDichVu === 1 && $memberCount > 30) {
      return response()->json(['message' => 'Bạn đã đạt tối đa thành viên cho Gói 1 (Tối đa 30 thành viên).'], 400);
    }
    if ($loaiDichVu === 2 && $memberCount > 150) {
      return response()->json(['message' => 'Bạn đã đạt tối đa thành viên cho Gói 2 (Tối đa 150 thành viên).'], 400);
    }
    if ($loaiDichVu >= 3 && $memberCount > 499) {
      return response()->json(['message' => 'Hệ thống hiện tại chỉ hỗ trợ tối đa 200 thành viên.'], 400);
    }

    $branch->data = $data;
    $branch->save();
    return response()->json($branch);
  }
}
