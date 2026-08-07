<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\FamilyLandingPageController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LibaryController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CartController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['prefix' => 'admin'], function () {
  Voyager::routes();
});

// Landing Page Route
Route::get('/', [LandingPageController::class, 'index'])->name('index');

Route::get('/chinh-sach-thanh-toan', [LandingPageController::class, 'payment_policy'])->name('payment.policy');

Route::get('/huong-dan-thanh-toan', [LandingPageController::class, 'payment'])->name('payment');

Route::get('/dang-nhap', [LoginController::class, 'index'])->name('login');

Route::get('/dang-ki', [LoginController::class, 'register'])->name('register');

Route::post('/tao-tai-khoan', [LoginController::class, 'register_store'])->name('register.store');

Route::post('auth/login', [LoginController::class, 'authenticate'])->name('authenticate');

Route::get('/huong-dan-su-dung', [LandingPageController::class, 'instruction'])->name('instruction');

Route::get('/bao-mat-va-quyen-rieng-tu', [LandingPageController::class, 'security_and_privacy'])->name('security_and_privacy');

Route::get('/danh-muc/{slug}', [LandingPageController::class, 'categoryPost'])->name('post.category');

Route::get('/bai-viet', [LandingPageController::class, 'post_list'])->name('blog');

Route::get('/bai-viet/{slug}', [LandingPageController::class, 'post'])->name('post');

Route::get('/dich-vu', [ServiceController::class, 'index'])->name('service');

Route::get('/dich-vu/{slug}', [ServiceController::class, 'show'])->name('service.detail');

Route::get('/lien-he', [LandingPageController::class, 'contacts'])->name('contacts');

Route::post('/lien-he/luu', [LandingPageController::class, 'create'])->name('contacts.save');

Route::get('/404', [LandingPageController::class, 'notFound'])->name('notfound');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//Checkout
Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');

// Gia Pha Route
Route::middleware(['auth', 'checkDateTime', 'check.announcement'])->group(function () {
  //Các Route trang ngoài
  Route::get('/home', [PageController::class, 'secondHome'])->name('second.home');

  //Album ảnh & Diễn đàn
  Route::post('album_anh/store_category', [PageController::class, 'album_category_store'])->name('album.category.store');
  Route::post('album_anh/image_store', [PageController::class, 'album_image_store'])->name('album.image.store');
  Route::post('album_anh/image_delete', [PageController::class, 'album_image_delete'])->name('album.image.delete');
  Route::post('album_anh/delete_category', [PageController::class, 'album_category_delete'])->name('album.category.delete');
  Route::get('{branch_id}/{slug_gia_pha}/album_anh/{category_slug?}', [PageController::class, 'album'])->name('temple');

  Route::get('{lineage_id}/{slug_gia_pha}/home', '\App\Http\Controllers\BranchController@index')->name('home');
  Route::get('{branch_id}/{slug_gia_pha}/dien_dan', [PageController::class, 'dien_dan'])->name('dien_dan');
  Route::get('{branch_id}/{slug_gia_pha}/{slug_bai_viet}', [PageController::class, 'index'])->name('page');

  //Các route bảo mật kiểm tra gói dịch vụ (CheckBuy)
  Route::middleware(['checkBuy'])->group(function () {
    Route::post('branch/{id}', '\App\Http\Controllers\BranchController@update')->name('branch.update');
    Route::post('/upload-photo', 'App\Http\Controllers\LineageController@uploadImage')->name('upload.photo');

    Route::get('/profile', [LoginController::class, 'profile'])->name('profile');
    Route::get('/clan-info', [LoginController::class, 'clanInfo'])->name('clan_info');

    // Route xuất file PDF gia phả in ấn khổ lớn
    Route::get('/export-pdf-preview', [LoginController::class, 'exportPdfPreview'])->name('export.pdf.preview');
    Route::get('/export-pdf-download', [LoginController::class, 'exportPdfDownload'])->name('export.pdf.download');

    // Lịch sử và sự kiện
    Route::get('/library', [LibaryController::class, 'index'])->name('library');
    Route::get('/library/add', [LibaryController::class, 'add'])->name('library.add');
    Route::post('/library/delete/{id}', [LibaryController::class, 'delete'])->name('library.delete');
    Route::post('/library/store', [LibaryController::class, 'store'])->name('library.store');
    Route::get('/library_view/{id}', [LibaryController::class, 'view'])->name('library.view');
    Route::get('/library_edit/{id}', [LibaryController::class, 'edit'])->name('library.edit');
    Route::post('/library/update/{id}', [LibaryController::class, 'update'])->name('library.save');

    //Document
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents');
    Route::get('/document/add', [DocumentController::class, 'add'])->name('document.add');
    Route::post('/document/store', [DocumentController::class, 'store'])->name('document.store');
    Route::get('/documents/download/{id}', [DocumentController::class, 'download'])->name('document.download');
    Route::delete('/documents/delete/{id}', [DocumentController::class, 'delete'])->name('document.delete');

    //Sửa trang giới thiệu ngoài
    Route::get('/about', [PageController::class, 'edit'])->name('about.edit');
    Route::post('/about/update', [PageController::class, 'update'])->name('about.update');

    //Thông báo
    Route::get('/announcement', [AnnouncementController::class, 'index'])->name('announcement');
    Route::get('/announcement/add', [AnnouncementController::class, 'add'])->name('announcement.add');
    Route::post('/announcement/store', [AnnouncementController::class, 'store'])->name('announcement.store');
    Route::post('/announcement/delete/{id}', [AnnouncementController::class, 'delete'])->name('announcement.delete');

    Route::get('edit-home-account', [FamilyLandingPageController::class, 'editCustom'])->name('edit.family-landing-pages');
    Route::post('update-home-account', [FamilyLandingPageController::class, 'update'])->name('update.family-landing-pages');

    //Ajax xử lý gallery
    Route::post('/gallery/add', [GalleryController::class, 'addImage'])->name('gallery.add');
    Route::post('/gallery/remove', [GalleryController::class, 'removeImage'])->name('gallery.remove');
    Route::post('/gallery/moveUp', [GalleryController::class, 'moveImageUp'])->name('gallery.moveUp');
    Route::post('/gallery/moveDown', [GalleryController::class, 'moveImageDown'])->name('gallery.moveDown');

    Route::post('/remove-notifications', function () {
      session()->forget('shown_notifications');
      session()->forget('notifications');
      return response()->json(['success' => true]);
    })->name('remove.notifications');
  });
});

Route::group(['middleware' => 'locale'], function () {
  Route::get('/change-language/{language}', [LandingPageController::class, 'change_lang'])->name('change-lang');
});