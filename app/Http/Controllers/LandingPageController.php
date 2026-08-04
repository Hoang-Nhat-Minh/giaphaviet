<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Post;
use TCG\Voyager\Models\Category;
use App\LandingPage;
use App\Contact;
use App\Service;
use Illuminate\Support\Facades\App;

class LandingPageController extends Controller
{
  public function index()
  {
    $content = LandingPage::find(1);

//    $services = Service::limit(3)->get();
      $services1 = Service::where('type', 'quan-ly-gia-pha')->where('status', 'hoat-dong')->orderBy('sort', 'DESC')->limit(6)->get();
      $services2 = Service::where('type', 'truyen-thong-thiet-ke')->where('status', 'hoat-dong')->orderBy('sort', 'DESC')->limit(3)->get();

    // dd($services);

    $posts = Post::where('featured', 1)->where('status', 'published')->orderBy('created_at', 'desc')->limit(3)->get();

    $content->demo_image = json_decode($content->demo_image);

    return view('pages.landingpage.home', compact('content', 'posts', 'services1', 'services2'));
  }

  public function instruction()
  {
    return view('pages.landingpage.instruction');
  }

  public function categoryPost($slug)
  {
    $blog_page = LandingPage::where('id', 2)->first();

    $category = Category::where('slug', $slug)->first();
    if ($category) {
      $posts = Post::where('category_id', $category->id)->where('status', 'published')->orderBy('created_at', 'desc')->paginate(12);
      return view('pages.landingpage.category_post', compact('category', 'posts', 'blog_page'));
    }
    return redirect()->route('notfound');
  }

  public function post_list()
  {
    $blog_page = LandingPage::where('id', 2)->first();
    $posts = Post::where('status', 'published')->orderBy('created_at', 'desc')->paginate(9);

    return view('pages.landingpage.post-list', compact('posts', 'blog_page'));
  }

  public function post($slug)
  {
    $post = Post::where('status', 'published')->where('slug', $slug)->first();
    // dd($post);
    return view('pages.landingpage.post', compact('post'));
  }

  public function contacts()
  {
    $contacts_page = LandingPage::where('id', 3)->first();

    return view('pages.landingpage.contacts', compact('contacts_page'));
  }

  public function create(Request $request)
  {
    $data = $request->validate([
      'name' => 'required|max:255',
      'email' => 'required|email|max:255',
      'title' => 'required|max:255',
      'content' => 'required|max:255',
    ], [
      'name.required' => 'Nhập họ tên',
      'name.max' => 'Họ tên không được vượt quá 255 ký tự',
      'email.required' => 'Nhập địa chỉ email',
      'email.email' => 'Địa chỉ email không hợp lệ',
      'email.max' => 'Địa chỉ email không được vượt quá 255 ký tự',
      'title.required' => 'Nhập tiêu đề',
      'title.max' => 'Tiêu đề không được vượt quá 255 ký tự',
      'content.required' => 'Nhập nội dung',
      'content.max' => 'Nội dung không được vượt quá 255 ký tự',
    ]);

    Contact::create($data);

    $alert = [
      "type" => "success",
      "title" => __("Thành công"),
      "body" => __("Cảm ơn bạn, chúng tôi sẽ sớm phản hồi cho bạn!")
    ];

    return redirect()->back()->with('alert', $alert);
  }

  public function change_lang($language)
  {
    \Session::put('website_language', $language);

    return redirect()->back();
  }

  public function payment_policy()
  {
    $payment = LandingPage::where('id', 4)->first();

    return view('pages.landingpage.payment', compact('payment'));
  }

  public function payment()
  {
    $payment = LandingPage::where('id', 5)->first();

    return view('pages.landingpage.payment', compact('payment'));
  }

  public function notFound()
  {
    return view('errors.404');

  }
  public function security_and_privacy()
  {
    $payment = LandingPage::where('id', 6)->first();
    return view('pages.landingpage.payment', compact('payment'));
  }

}
