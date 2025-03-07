<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Brick;
use App\Models\Category;
use App\Models\Contact;
use App\Models\ContactInfo;
use App\Models\Feedback;
use App\Models\PartnerLogo;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        $logos = PartnerLogo::all();
        $bricks = Brick::orderBy('id', 'desc')->get();
        $blogs = Blog::orderBy('id', 'desc')->take(3)->get();
        $contact = ContactInfo::first();
        $feedbacks = Feedback::latest()->take(5)->get();
        return view('frontend.home', compact('logos', 'bricks', 'blogs', 'contact', 'feedbacks'));
    }

    public function about()
    {
        $logos = PartnerLogo::all();
        return view('frontend.about', compact('logos'));
    }

    public function shop()
    {
        $bricks = Brick::orderBy('id', 'Desc')->paginate(10);
        return view('frontend.shop', compact('bricks'));
    }

    public function shopDetail($id)
    {
        $brick = Brick::find($id);
        $categories = Category::all();
        return view('frontend.shop-detail', compact('brick', 'categories'));
    }

    public function blog()
    {
        $blogs = Blog::orderBy('id', 'desc')->paginate(10);
        return view('frontend.blog', compact('blogs'));
    }

    public function blogDetail($id)
    {
        $blog = Blog::find($id);
        $blogs = Blog::orderBy('id', 'desc')->take(3)->get();
        $categories = Category::all();

        return view('frontend.blog-detail', compact('blog', 'blogs', 'categories'));
    }

    public function contact()
    {
        $contact = ContactInfo::first();
        return view('frontend.contact', compact('contact'));
    }

    public function checkout()
    {
        return view('frontend.checkout');
    }
}
