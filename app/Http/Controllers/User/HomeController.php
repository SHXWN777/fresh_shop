<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function Index(){
        $allproducts = Product::latest()->get();
        return view('user.home', compact('allproducts'));
    }

    public function About_us(){
        return view('user.about_us');
    }

    public function Contact_us(){
        return view('user.contact_us');
    }
}
