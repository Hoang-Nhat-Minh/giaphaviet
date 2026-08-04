<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Service;
use App\LandingPage;


class ServiceController extends Controller
{
    public function index()
    {
        $blog_page = LandingPage::where('id', 2)->first();
        $services1 = Service::where('type', 'quan-ly-gia-pha')->where('status', 'hoat-dong')->orderBy('sort', 'DESC')->get();
        $services2 = Service::where('type', 'truyen-thong-thiet-ke')->where('status', 'hoat-dong')->orderBy('sort', 'DESC')->get();
        return view('pages.landingpage.service')->with(compact('services1', 'services2', 'blog_page'));
    }

    public function show($slug)
    {
        $service = Service::where('status', 'hoat-dong')->where('slug', $slug)->first();
        if ($service) {
            return view('pages.landingpage.service-detail', compact('service'));
        }
        return redirect()->route('notfound');
    }

}
