<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TCG\Voyager\Models\User;
use App\Branch;
use App\Lineage;
use TCG\Voyager\Models\Page;
use Carbon\Carbon;
use App\Template;
use App\FamilyLandingPage;

class LoginController extends Controller
{
  /**
   * Form Login 
   */
  public function index()
  {
    if (Auth::user()) {
      $lineage = Lineage::where('user_id', Auth::user()->id)->first();

      $slug_gia_pha = $lineage->slug;
      $lineage_id = $lineage->id;
      //      return redirect(route('home', compact('lineage_id', 'slug_gia_pha')));
      return redirect(route('second.home'));
    }
    return view('pages.Auth.login');
  }


  public function register()
  {
    return view('pages.Auth.register');
  }


  public function register_store(Request $request)
  {
    $data = $request->validate([
      'email' => 'required|unique:users|max:255',
      'name' => 'required|max:255',
      'phone' => 'required|numeric|digits_between:10,13',
      'lineages' => 'required|max:255',
      'branches' => 'required|max:255',
      'location' => 'required|max:255',
      'password' => 'required|min:8|max:255',
      'rewrite' => 'required|same:password|max:255'
    ]);

    $data['password'] = Hash::make($data['password']);

    $lineage_slug = Str::slug($data['lineages'], "-");

    $lineage = Lineage::create([
      'name' => $data['lineages'],
      'slug' => $lineage_slug
    ]);

    $data['lineage_id'] = $lineage->id;

    $branch = Branch::create([
      'name' => $data['branches'],
      'lineage_id' => $data['lineage_id'],
      'data' => '[{"id":1,"pids":[2,0],"name":"Ph\u1ea1m Gia B\u1ea3o","img":"https:\/\/giaphaviet.kennatech.vn\/\/storage\/members\/Li1zjvgxkn0uGy4Tp5NORa4qi0LnBQfHnC8hXgj0.jpg","gender":"male","date_of_birth":null,"date_of_death":null,"status":"dm","address_old":null,"address":null,"level":null,"job":null,"fid":"_6mcx","mid":"_6jnd","generation":"1","head_of_the_clan":false,"branch_leader":false,"position":null,"achievement":null,"cementary":"Thanh L\u01b0\u01a1ng, Ngh\u1ec7 An","house":null,"branch_head":false,"cementary_address":"https:\/\/maps.app.goo.gl\/Cw4giwYppHTaysL56"},{"id":1,"pids":[2,0],"name":"King George VI","img":"https:\/\/giaphaviet.kennatech.vn\/\/storage\/users\/businessman.png","gender":"male","date_of_birth":null,"date_of_death":null,"status":null,"address_old":null,"address":null,"level":null,"job":null},{"id":2,"pids":[1],"name":"Nguy\u1ec5n Th\u1ecb Thi\u1ec7n","title":"The Queen Mother","img":"https:\/\/giaphaviet.kennatech.vn\/\/storage\/members\/tbnTu10bXGN9qP92rGBS4b0w2PsQaisrArFcx8Kt.jpg","gender":"female","date_of_birth":null,"date_of_death":null,"status":"dm","address_old":null,"address":null,"level":null,"job":null,"generation":"1","head_of_the_clan":false,"branch_leader":false,"position":null,"achievement":null,"cementary":null},{"id":3,"pids":["_ly84"],"mid":2,"fid":1,"name":"Ph\u1ea1m H\u1ea3i An","img":"https:\/\/giaphaviet.kennatech.vn\/\/storage\/members\/GGxnEcpFyrR8L40VvHZPvHXmdVxFPxBviRXH5Fcb.jpg","gender":"female","date_of_birth":null,"date_of_death":null,"status":"dm","address_old":null,"address":null,"level":null,"job":null,"generation":"2","head_of_the_clan":false,"branch_leader":false,"position":null,"achievement":null,"cementary":null},{"id":6,"mid":3,"pids":[7,8],"name":"Ph\u1ea1m Gia Minh","title":"Prince of Wales","img":"https:\/\/giaphaviet.kennatech.vn\/\/storage\/members\/Emwy4NEAyj8vPDr3cVH9n2VrwzKxV0oHOqMa9gKR.jpg","gender":"male","date_of_birth":null,"date_of_death":null,"status":"cs","address_old":null,"address":null,"level":null,"job":null,"generation":"3","head_of_the_clan":true,"branch_leader":false,"position":null,"achievement":null,"cementary":null,"house":"Con C\u1ea3","branch_head":false},{"id":7,"pids":[6],"name":"Tr\u1ea7n An Kh\u00e1nh","title":"Princess of Wales","img":"https:\/\/giaphaviet.kennatech.vn\/\/storage\/members\/9494haHW9ygGv6ivjqe3FdlwcKYejA34gDRTY1VK.jpg","gender":"female","date_of_birth":null,"date_of_death":null,"status":"cs","address_old":null,"address":null,"level":null,"job":null,"generation":"3","head_of_the_clan":false,"branch_leader":false,"position":null,"achievement":null,"cementary":null},{"id":8,"pids":[6],"name":"Ph\u1ea1m Gia H\u00e2n","title":"Duchess of Cornwall","img":"https:\/\/giaphaviet.kennatech.vn\/\/storage\/members\/uMvTIqtoqQlWsxI6vIwP51hsGjWdc6tvRidcyJ5Z.jpg","gender":"female","date_of_birth":null,"date_of_death":null,"status":"cs","address_old":null,"address":null,"level":null,"job":null,"generation":"3","head_of_the_clan":false,"branch_leader":false,"position":null,"achievement":null,"cementary":null},{"id":9,"mid":3,"name":"Ph\u1ea1m Gia Kh\u00e1nh","title":"Princess Royal","img":"https:\/\/giaphaviet.kennatech.vn\/\/storage\/members\/2koaRSBDF0Mwb7urZs1eC2dMraqkhJ1JSmybEFmK.jpg","gender":"female","date_of_birth":null,"date_of_death":null,"status":"cs","address_old":null,"address":null,"level":null,"job":null,"pids":[],"generation":"3","head_of_the_clan":false,"branch_leader":false,"position":null,"achievement":null,"cementary":null,"house":null},{"id":10,"mid":3,"name":"Ph\u1ea1m Gia H\u01b0ng","title":"Duke of York","img":"https:\/\/giaphaviet.kennatech.vn\/\/storage\/members\/Hy0pzoJWZqaS5G8SSQ4yzPimccOZBklXBpdLVVsI.jpg","gender":"male","date_of_birth":null,"date_of_death":null,"status":"cs","address_old":null,"address":null,"level":null,"job":null,"pids":[],"generation":"3","head_of_the_clan":false,"branch_leader":true,"position":null,"achievement":null,"cementary":null,"house":"Con th\u1ee9","branch_head":true},{"id":11,"mid":3,"name":"Ph\u1ea1m Gia Th\u00e0nh","title":"Earl of Wessex","img":"https:\/\/giaphaviet.kennatech.vn\/\/storage\/members\/iMqezaG3DlWjrjcS7amztjhfCRxfuaNaPOI3T1ma.jpg","gender":"male","date_of_birth":null,"date_of_death":null,"status":"cs","address_old":null,"address":null,"level":null,"job":null,"pids":[],"generation":"3","head_of_the_clan":false,"branch_leader":false,"position":null,"achievement":null,"cementary":null,"house":null,"branch_head":false,"cementary_address":null},{"id":12,"fid":6,"mid":7,"pids":[14],"name":"Ph\u1ea1m B\u00ecnh Minh","title":"Duch of Cambridge","img":"https:\/\/giaphaviet.kennatech.vn\/\/storage\/members\/0j9O2FithM9I0yrvSKsZZzps5beWBxh8PFqTLb4Z.jpg","gender":"male","date_of_birth":null,"date_of_death":null,"status":"cs","address_old":null,"address":null,"level":null,"job":null,"generation":"4","head_of_the_clan":false,"branch_leader":false,"position":null,"achievement":null,"cementary":null},{"id":13,"fid":6,"mid":7,"pids":[15],"name":"Ph\u1ea1m B\u1ea3o Long","img":"https:\/\/giaphaviet.kennatech.vn\/\/storage\/members\/UvgSyPdtWfLxGuN02c0IdGlE4I5Qzunmhmy9nBqS.jpg","gender":"male","date_of_birth":null,"date_of_death":null,"status":"cs","address_old":null,"address":null,"level":null,"job":null,"generation":"4","head_of_the_clan":false,"branch_leader":false,"position":null,"achievement":null,"cementary":null},{"id":14,"pids":[12],"name":"\u0110\u1ed7 Th\u1ecb H\u1ed3ng","title":"Duchess of Cambridge","img":"https:\/\/giaphaviet.kennatech.vn\/\/storage\/members\/JRTAfGEydGIkFmCadmwhLwIUv7ykeTkCYCAhETjA.jpg","gender":"female","date_of_birth":null,"date_of_death":null,"status":"cs","address_old":null,"address":null,"level":null,"job":null,"generation":"4","head_of_the_clan":false,"branch_leader":false,"position":null,"achievement":null,"cementary":null},{"id":15,"pids":[13],"name":"Ph\u1ea1m B\u1ea3o Minh","img":"https:\/\/giaphaviet.kennatech.vn\/\/storage\/members\/KBhNLDtietPgcmDH3N89171dzrco5W5VsRlQyQY4.jpg","gender":"female","date_of_birth":null,"date_of_death":null,"status":"cs","address_old":null,"address":null,"level":null,"job":null,"generation":"4","head_of_the_clan":false,"branch_leader":false,"position":null,"achievement":null,"cementary":null},{"id":16,"fid":12,"mid":14,"name":"Ph\u1ea1m Duy B\u00e1ch","img":"https:\/\/giaphaviet.kennatech.vn\/\/storage\/members\/fZS0aaliIxPeMctVmcHv7dubWEShioqPn2t80d5q.jpg","gender":"male","date_of_birth":null,"date_of_death":null,"status":"cs","address_old":null,"address":null,"level":null,"job":null,"pids":[],"generation":"5","head_of_the_clan":false,"branch_leader":false,"position":null,"achievement":null,"cementary":null},{"id":17,"fid":12,"mid":14,"name":"Ph\u1ea1m Thi\u00ean An","img":"https:\/\/giaphaviet.kennatech.vn\/\/storage\/members\/1jaC3QOWi7ZEoEmOe3udK5AUqTqip2bYpGoKvfjs.jpg","gender":"female","date_of_birth":null,"date_of_death":null,"status":"cs","address_old":null,"address":null,"level":null,"job":null,"pids":[],"generation":"5","head_of_the_clan":false,"branch_leader":false,"position":null,"achievement":null,"cementary":null},{"id":18,"fid":12,"mid":14,"name":"Ph\u1ea1m Duy Khang","img":"https:\/\/giaphaviet.kennatech.vn\/\/storage\/members\/sgCqXB8HeK5NDTayBNNPeTKsCE4r7MPnnSyCysxX.jpg","gender":"male","date_of_birth":null,"date_of_death":null,"status":"cs","address_old":null,"address":null,"level":null,"job":null,"pids":["_718p"],"generation":"5","head_of_the_clan":false,"branch_leader":false,"position":null,"achievement":null,"cementary":null},{"mid":"_718p","fid":18,"gender":"male","id":"_tw7j","name":"Ph\u1ea1m M\u1ea1nh C\u01b0\u1eddng","img":"https:\/\/giaphaviet.kennatech.vn\/\/storage\/members\/jLM1dKfbokQV6WrBEp0oGnWhHLrgWT0RxTHrykzc.jpg","date_of_birth":"2024-03-28","status":"cs","date_of_death":null,"address_old":"Ninh B\u00ecnh","address":"Ninh B\u00ecnh","level":"\u0110\u1ea1i H\u1ecdc","job":"Coder","pids":["_rzhe","_azld"],"generation":"6","head_of_the_clan":false,"branch_leader":false,"position":null,"achievement":null,"cementary":null},{"pids":["18"],"gender":"female","id":"_718p","name":"V\u0169 H\u1ed3ng B\u00e1ch","img":"https:\/\/giaphaviet.kennatech.vn\/\/storage\/members\/fbiDIGxeLHUWxe0Etf9WBIOiDz0cwdJ2ONzj0RWr.jpg","date_of_birth":"1981-06-07","status":"cs","date_of_death":null,"address_old":"Ninh B\u00ecnh","address":"Ninh B\u00ecnh","level":"C\u1ea5p 3","job":"T\u1ef1 do","generation":"5","head_of_the_clan":false,"branch_leader":false,"position":null,"achievement":null,"cementary":null},{"pids":["_tw7j"],"gender":"female","id":"_rzhe","name":"Ho\u00e0ng Nh\u01b0 Qu\u1ef3nh","img":"https:\/\/giaphaviet.kennatech.vn\/\/storage\/members\/N4QGAJprbH2pdJErDjmzAcugIsqVvHkG5LF5qMlI.jpg","date_of_birth":null,"status":"cs","date_of_death":null,"address_old":null,"address":null,"level":null,"job":null,"generation":"6","head_of_the_clan":false,"branch_leader":false,"position":null,"achievement":null,"cementary":null},{"mid":"_tw7j","fid":"_rzhe","gender":"male","id":"_rmig","name":"Ph\u1ea1m Ho\u00e0ng Anh","img":"https:\/\/giaphaviet.kennatech.vn\/\/storage\/members\/8WmLDYo11yV0Afc3YiwbVCLyvyFvajfDpLj9xA4E.jpg","date_of_birth":null,"status":"cs","date_of_death":null,"address_old":null,"address":null,"level":null,"job":null,"pids":[],"generation":"7","head_of_the_clan":false,"branch_leader":false,"position":null,"achievement":null,"cementary":null},{"pids":["_tw7j"],"gender":"female","id":"_azld","name":"Nguy\u1ec5n Minh Ch\u00e2u","img":"https:\/\/giaphaviet.kennatech.vn\/\/storage\/members\/FBeGL9okaUB0AnOk8YZs0VHr4r8DvoaKv9gX2aqJ.jpg","date_of_birth":"2024-03-28","status":"cs","date_of_death":null,"address_old":"Th\u00e1i Nguy\u00ean","address":"Th\u00e1i Nguy\u00ean","level":"\u0110\u1ea1i H\u1ecdc","job":"T\u1ef1 do","generation":"6","head_of_the_clan":false,"branch_leader":false,"position":null,"achievement":null,"cementary":null},{"mid":"_azld","fid":"_tw7j","gender":"female","id":"_6cu1","name":"Ph\u1ea1m Ng\u1ecdc Minh","img":"https:\/\/giaphaviet.kennatech.vn\/\/storage\/members\/NfhUuoKb2ooNFKpbKf2XAwibzH7dZuD4UXHMB7HZ.jpg","date_of_birth":"2024-03-28","status":"cs","date_of_death":"2024-03-28","address_old":"Th\u00e1i Nguy\u00ean","address":"Th\u00e1i Nguy\u00ean","level":null,"job":null,"pids":[],"generation":"7","head_of_the_clan":false,"branch_leader":false,"position":null,"achievement":null,"cementary":null},{"gender":"male","id":"_6mcx"},{"pids":["3"],"gender":"male","id":"_ly84","name":"Ph\u1ea1m Gia Huy","img":"https:\/\/giaphaviet.kennatech.vn\/\/storage\/members\/SDLk0oTgq3xXs2umSUsxwNemOvazlS2bmdifpJwq.png","date_of_birth":"1955-07-20","status":"dm","date_of_death":"2018-07-26","address_old":"Th\u00e1i Nguy\u00ean","address":"T\u1ed5 1, ph\u01b0\u1eddng T\u00e2n Th\u1ecbnh, th\u00e0nh ph\u1ed1 Th\u00e1i Nguy\u00ean","level":"Ti\u1ebfn s\u0129","job":null,"generation":"2","head_of_the_clan":false,"branch_leader":false,"position":null,"achievement":null,"cementary":null}]'
    ]);

    $data['branch_id'] = $branch->id;

    $data['ngay_gia_han'] = Carbon::now()->toDateString();

    $data['so_ngay_han'] = setting('site.test_time');

    $data['role_id'] = 2;

    $data['template'] = 1;

    Arr::forget($data, ['branches', 'lineages', 'rewrite']);

    $user = User::create($data);

    $lineage->update(['user_id' => $user->id]);

    // Page::insert([
    //   [
    //     'title' => 'Tộc Ước',
    //     'author_id' => $user->id,
    //     'excerpt' => 'Tộc Ước',
    //     'body' => '
    //                 <p style="text-align:center">Thông tin Tộc Ước của bạn</p>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <p style="text-align:center">Cảm ơn bạn đã dùng dịch vụ của chúng tôi</p>
    //             ',
    //     'slug' => 'toc-uoc',
    //     'status' => 'ACTIVE',
    //     'branch_id' => $branch->id,
    //     'created_at' => $user->created_at
    //   ],
    //   [
    //     'title' => 'Từ Đường',
    //     'author_id' => $user->id,
    //     'excerpt' => 'Từ Đường',
    //     'body' => '
    //                 <p style="text-align:center">Thông tin Từ Đường của bạn</p>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <p style="text-align:center">Cảm ơn bạn đã dùng dịch vụ của chúng tôi</p>
    //             ',
    //     'slug' => 'tu-duong',
    //     'status' => 'ACTIVE',
    //     'branch_id' => $branch->id,
    //     'created_at' => $user->created_at
    //   ],
    //   [
    //     'title' => 'Phả Ký',
    //     'author_id' => $user->id,
    //     'excerpt' => 'Phả Ký',
    //     'body' => '
    //                 <p style="text-align:center">Thông tin Phả Ký của bạn</p>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <br>
    //                 <p style="text-align:center">Cảm ơn bạn đã dùng dịch vụ của chúng tôi</p>
    //             ',
    //     'slug' => 'pha-ky',
    //     'status' => 'ACTIVE',
    //     'branch_id' => $branch->id,
    //     'created_at' => $user->created_at
    //   ]
    // ]);

    Page::insert([
      [
        'title' => 'Giới thiệu Gia Tộc',
        'author_id' => $user->id,
        'excerpt' => 'Giới thiệu Gia Tộc',
        'body' => '
                      <p style="text-align:center">Thông tin Gia Tộc của bạn</p>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <p style="text-align:center">Cảm ơn bạn đã dùng dịch vụ của chúng tôi</p>
                  ',
        'slug' => 'gioi-thieu',
        'status' => 'ACTIVE',
        'branch_id' => $branch->id,
        'created_at' => $user->created_at
      ],
    ]);

    FamilyLandingPage::create([
      'about' => 'Thông tin về gia tộc',
      'address' => 'Thông tin địa chỉ',
      'telephone' => 'Thông tin địa chỉ',
      'email' => 'Thông tin địa chỉ',
      'user_id' => $user->id
    ]);

    $alert = [
      "type" => "success",
      "title" => __("Thành công"),
      "body" => __("Đăng kí thành công!")
    ];

    return redirect()->route('login')->with('alert', $alert);
  }

  /**
   * Handle an authentication attempt.
   */
  public function authenticate(Request $request): RedirectResponse
  {
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);
    // dd($credentials,$request->remember);
    if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']], $request->remember == 'on' ? true : false)) {
      $request->session()->regenerate();

      return redirect()->route('login');
    }
    return back()->withErrors([
      'email' => 'Tài khoản mật khẩu không hợp lệ.',
    ])->onlyInput('email');
  }

  /**
   * Log the user out of the application.
   */
  public function logout(Request $request): RedirectResponse
  {
    $request->session()->forget('shown_notifications');

    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route('index');
  }

  public function edit()
  {
    return view('vendor.voyager.pages.edit-add');
  }

  public function profile()
  {
    return view('screens.auth.profile');
  }

  public function clanInfo()
  {
    // $templates = Template::all();

    $string_json = Branch::where('id', Auth::user()->branch_id)->first()->data;
    $json = json_decode($string_json, true);

    $totalMember = count($json);
    $countCs = 0;
    $countDm = 0;
    $male = 0;
    $female = 0;
    $headOfClan = [];
    $branch_head = [];

    // Tìm ai là trưởng tộc, trưởng chi
    foreach ($json as $obj) {
      if (isset($obj['head_of_the_clan']) && $obj['head_of_the_clan'] === true) {
        $headOfClan[] = $obj['name'] ?? 'Unknown';
      }
      if (isset($obj['branch_head']) && $obj['branch_head'] === true) {
        $branch_head[] = $obj['name'] ?? 'Unknown';
      }
    }

    // Đếm người sống, người mất
    $countCs = $countDm = 0;
    foreach ($json as $obj) {
      if (isset($obj['status'])) {
        if ($obj['status'] === 'cs') {
          $countCs++;
        } elseif ($obj['status'] === 'dm') {
          $countDm++;
        }
      }
    }

    // Đếm giới tính
    $male = $female = 0;
    foreach ($json as $obj) {
      if (isset($obj['gender'], $obj['status']) && $obj['status'] === 'cs') {
        if ($obj['gender'] === 'male') {
          $male++;
        } elseif ($obj['gender'] === 'female') {
          $female++;
        }
      }
    }

    // Tính tỷ lệ nam và nữ
    $maleRatio = $femaleRatio = 0;
    if ($male + $female > 0) {
      $maleRatio = round(($male / ($male + $female)) * 100, 0);
      $femaleRatio = round(($female / ($male + $female)) * 100, 0);
    }

    // Đưa các biến vào một mảng
    $clanInfo = [
      'totalMember' => $totalMember,
      'countCs' => $countCs,
      'countDm' => $countDm,
      'headOfClan' => $headOfClan,
      'branch_head' => $branch_head,
      'male' => $male,
      'female' => $female,
      'maleRatio' => $maleRatio,
      'femaleRatio' => $femaleRatio,
    ];

    // Truyền biến ra view
    return view('screens.auth.clan_info', compact('clanInfo'));

    // dd("Tổng số thành viên: {$totalMember} \nSố thành viên còn sống: {$countCs} \nSố thành viên đã mất: {$countDm}\nTrưởng tộc: {$headOfClan}\nTrưởng chi: {$branchLeader} \nSố nam: {$male} \nSố nữ: {$female} \nTỷ lệ nam: " . round($male / ($male + $female), 2) . " \nTỷ lệ nữ: " . round($female / ($male + $female), 2));
  }
}