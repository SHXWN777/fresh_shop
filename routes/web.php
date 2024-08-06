<?php

use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ProductsController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

use App\Models\Product;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

Route::controller(RegisteredUserController::class)->group(function(){
    Route::get('/register', 'create')->name('register')->name('register');
});

Route::controller(AuthenticatedSessionController::class)->group(function(){
    Route::get('/login', 'create')->name('login');
    Route::post('/logout', 'destroy')->name('logout');
});

Route::controller(HomeController::class)->group(function(){
    Route::get('/user/home', 'Index')->name('Home');
    Route::get('/user/about_us', 'About_us')->name('about_us');
    Route::get('/user/contact', 'Contact_us')->name('contact_us');
});

Route::controller(ProductsController::class)->group(function(){
    Route::get('/user/category', 'CategoryPage')->name('category');
    Route::get('/user/gallery', 'Gallery')->name('gallery');
    Route::get('/user/product-details/{id}', 'SingleProduct')->name('singleproduct');
});

Route::middleware(['auth', 'verified'])->group(function(){
    Route::controller(CartController::class)->group(function(){
        Route::get('/user/add-to-cart', 'AddToCart')->name('addtocart');
        Route::get('/user/wishlist', 'Wishlist')->name('wishlist');
    });
    Route::controller(CheckoutController::class)->group(function(){
        Route::get('/user/checkout', 'Checkout')->name('checkout');
    });
    Route::controller(ProfileController::class)->group(function(){
        Route::get('/user/user-profile', 'UserProfile')->name('userprofile');
    }); 
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:user'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function(){
    Route::controller(DashboardController::class)->group(function(){
        Route::get('/admin/dashboard', 'index')->name('admindashboard');
    });
});

Route::controller(CategoryController::class)->group(function(){
    Route::get('admin/all-category', 'Index')->name('allcategory');
    Route::get('admin/add-category', 'AddCategory')->name('addcategory');
    Route::post('/admin/store-category', 'StoreCategory')->name('storecategory');
    Route::get('/admin/edit-category/{id}', 'EditCategory')->name('editcategory');
    Route::post('/admin/update-category', 'UpdateCategory')->name('updatecategory');
    Route::get('/admin/delete-category/{id}', 'DeleteCategory')->name('deletecategory');
});

Route::controller(SubCategoryController::class)->group(function(){
    Route::get('admin/all-subcategory', 'Index')->name('allsubcategory');
    Route::get('admin/add-subcategory', 'AddSubCategory')->name('addsubcategory');
    Route::post('/admin/store-subcategory', 'StoreSubCategory')->name('storesubcategory');
    Route::get('/admin/edit-subcategory/{id}', 'EditSubCategory')->name('editsubcat');
    Route::post('/admin/update-subcategory', 'UpdateSubCategory')->name('updatesubcat');
    Route::get('/admin/delete-subcategory/{id}', 'DeleteSubCategory')->name('deletesubcat');
});

Route::controller(ProductController::class)->group(function(){
    Route::get('admin/all-products', 'Index')->name('allproducts');
    Route::get('admin/add-products', 'AddProduct')->name('addproducts');
    Route::post('/admin/store-product', 'StoreProduct')->name('storeproduct');
    Route::get('/admin/edit-product-img/{id}', 'EditProductImg')->name('editproductimg');
    Route::post('/admin/update-product-img', 'UpdateProductImg')->name('updateproductimg');
    Route::get('/admin/edit-product/{id}', 'EditProduct')->name('editproduct');    
    Route::post('/admin/update-product', 'UpdateProduct')->name('updateproduct');
    Route::get('/admin/delete-product/{id}', 'DeleteProduct')->name('deleteproduct');
});

Route::controller(OrderController::class)->group(function(){
    Route::get('admin/pending-order', 'Index')->name('pendingorder');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
