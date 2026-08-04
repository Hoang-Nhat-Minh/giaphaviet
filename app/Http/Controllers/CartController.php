<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\Cart;
use App\Service;
use App\Checkout;
// use App\CheckoutSaveItem;

class CartController extends Controller
{
  // public function index()
  // {
  //   $cart = Cart::where('user_id', auth()->user()->id)->get();

  //   return view('pages.landingpage.cart', compact('cart'));
  // }
  // public function save(Request $request)
  // {
  //   $data = $request->all();

  //   Cart::create([
  //     'user_id' => auth()->user()->id,
  //     'service_type' => $data['service_type'],
  //     'service_id' => $data['service_id'],
  //   ]);

  //   $alert = [
  //     "type" => "success",
  //     "title" => __("Thành công"),
  //     "body" => __("Đặt thành công!")
  //   ];

  //   return redirect()->route('cart')->with('alert', $alert);
  // }

  // public function delete(Request $request)
  // {
  //   Cart::where('id', $request->id)->delete();

  //   $alert = [
  //     "type" => "success",
  //     "title" => __("Thành công"),
  //     "body" => __("Hủy thành công!")
  //   ];

  //   return redirect()->route('cart')->with('alert', $alert);
  // }

  public function checkout(Request $request)
  {

    $data = $request->validate([
      'name' => 'required|string|max:255', // Thêm kiểm tra độ dài tối đa cho name
      'phone' => 'required|digits_between:9,13', // Giữ nguyên quy tắc cho phone
      'email' => 'required|email|max:255', // Thêm kiểm tra độ dài tối đa cho email
      'address' => 'required|string|max:255', // Thêm kiểm tra độ dài tối đa cho address
    ], [
      'name.required' => 'Vui lòng nhập họ và tên.',
      'name.string' => 'Họ và tên phải là chuỗi.', // Thêm thông báo lỗi cho trường hợp không phải chuỗi
      'phone.required' => 'Vui lòng nhập số điện thoại.',
      'phone.digits_between' => 'Số điện thoại phải từ 9 đến 13 chữ số.',
      'email.required' => 'Vui lòng nhập email.',
      'email.email' => 'Email không hợp lệ.',
      'email.max' => 'Email không được vượt quá 255 ký tự.', // Thêm thông báo cho email
      'address.required' => 'Vui lòng nhập địa chỉ.',
      'address.string' => 'Địa chỉ phải là chuỗi.', // Thêm thông báo lỗi cho address
      'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.' // Thêm thông báo cho address
    ]);

    $data['service_id'] = $request->service_id;

    // dd($data);

    Checkout::create($data);

    // $cart = Cart::where('user_id', auth()->user()->id)->get();

    // $data['user_id'] = auth()->user()->id;

    // $checkout = Checkout::create($data);

    // foreach ($cart as $item) {
    //   CheckoutSaveItem::create([
    //     'user_id' => auth()->user()->id,
    //     'checkout_id' => $checkout->id,
    //     'service_name' => $item->service->first()->title,
    //     'service_price' => $item->service->first()->price
    //   ]);
    // }

    // Cart::where('user_id', auth()->user()->id)->delete();

    $alert = [
      "type" => "success",
      "title" => __("Thành công"),
      "body" => __("Đặt thành công,Cảm ơn bạn đã đặt dịch vụ, chúng tôi sẽ phản hồi nhanh nhất có thể!")
    ];

    return redirect()->route('service')->with('alert', $alert);
  }
}