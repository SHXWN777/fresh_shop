<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function AddToCart(){
        return view('user.cart');
    }

    public function Wishlist(){
        return view('user.wishlist');
    }
}
