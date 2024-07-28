<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function CategoryPage(){
        //$category = Category::findOrFail($id);
        //$products = Product::where('product_category_id', $id)->latest()->get();
        $allproducts = Product::latest()->get();
        return view('user.shop', compact('allproducts'));
    }

    public function SingleProduct($id){
        $product = Product::findOrFail($id);
        //$subcat_id = Product::where('id', $id)->value('product_subcategory_id');
        //$related_products = Product::where('product_subcategory_id', $subcat_id)->latest()->get();
        return view('user.shop_details', compact('product'));
    }

    public function Gallery(){
        $allproducts = Product::latest()->get();
        return view('user.gallery', compact('allproducts'));
    }
}
