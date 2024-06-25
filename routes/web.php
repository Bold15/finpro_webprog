<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CartController as AdminCartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ApiProductController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ConfirmController;

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

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

//user login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/authenticate',[LoginController::class, 'authenticate']);
Route::get('/register', [LoginController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [LoginController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//admin login
Route::get('/loginAdmin', [LoginController::class, 'showLoginFormAdmin'])->name('admin.login');
Route::post('/authenticateAdmin',[LoginController::class, 'authenticateAdmin']);
Route::get('/registerAdmin', [LoginController::class, 'showRegistrationFormAdmin'])->name('admin.register');
Route::post('/registerAdmin', [LoginController::class, 'registerAdmin']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::resource('categories', CategoryController::class);
Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::get('profile', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth');
Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::post('profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('cart', [CartController::class, 'store'])->name('cart.store');
    Route::patch('cart/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('cart/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/cart/add', [CartController::class, 'addItem'])->name('cart.add');
Route::post('/cart/addItem', [CartController::class, 'addItem'])->name('cart.addItem');
});

Route::post('cart/items', [CartItemController::class, 'store'])->name('cart.items.store');
Route::patch('cart/items/{cartItem}', [CartItemController::class, 'update'])->name('cart.items.update');
Route::delete('cart/items/{cartItem}', [CartItemController::class, 'destroy'])->name('cart.items.destroy');

Route::prefix('orders/{order}/items')->group(function () {
    Route::get('/', [OrderItemController::class, 'index'])->name('order_items.index');
    Route::get('create', [OrderItemController::class, 'create'])->name('order_items.create');
    Route::post('/', [OrderItemController::class, 'store'])->name('order_items.store');
    Route::get('{orderItem}/edit', [OrderItemController::class, 'edit'])->name('order_items.edit');
    Route::put('{orderItem}', [OrderItemController::class, 'update'])->name('order_items.update');
    Route::delete('{orderItem}', [OrderItemController::class, 'destroy'])->name('order_items.destroy');
});

Route::resource('users', UserController::class);

Route::prefix('admin')->name('admin.')->namespace('App\Http\Controllers\Admin')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('carts', CartController::class);
});

// Route::get('/admin', function () {
//     return view('admin.dashboard');
// })->name('admin.dashboard');
// // Rute untuk manajemen admin
// Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    

//     // Rute untuk produk
//     Route::resource('products', AdminProductController::class);

//     // Rute untuk kategori
//     Route::resource('categories', AdminCategoryController::class);

//     // Rute untuk keranjang
//     Route::resource('carts', AdminCartController::class)->only(['index', 'destroy']);
// });

// Rute untuk produk yang dapat diakses oleh pengguna biasa (misalnya, untuk menampilkan daftar produk)
Route::resource('products', ProductController::class)->only(['index', 'show']);


//admin login
// Route::prefix('admin')->name('admin.')->group(function () {
// Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
// Route::post('/authenticate',[AdminController::class, 'authenticate']);
// Route::post('/login', [LoginController::class, 'login']);
// Route::get('/register', [AdminController::class, 'showRegistrationForm'])->name('register');
// Route::post('/register', [AdminController::class, 'register']);
// Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
// });


Route::get('/admin', function () {
    return view('admin.dashboard');
    })->name('admin.dashboard');

// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::get('products', [ProductController::class, 'create'])->name('products.create');
//     Route::get('carts', [CartController::class, 'index'])->name('carts.index');
//     Route::get('login', [AdminController::class, 'showLoginForm'])->name('admin.login');
//     Route::post('login', [AdminController::class, 'login']);
//     Route::get('register', [AdminController::class, 'showRegistrationForm'])->name('admin.register');
//     Route::post('register', [AdminController::class, 'register']);
//     Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');
// });

Route::post('/purchase', [PurchaseController::class, 'store'])->name('purchase.store');

Route::get('/purchase', function () {
    return view('purchase.index');
    })->name('purchase.index');

    Route::middleware(['auth'])->group(function () {
        Route::get('/addresses', [AddressController::class, 'index'])->name('addresses.index');
        Route::get('/addresses/create', [AddressController::class, 'create'])->name('addresses.create');
        Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store');
    });

//     Route::get('/products', [ApiProductController::class, 'index'])->name('products.index');
// Route::post('/products', [ApiProductController::class, 'store'])->name('products.store');

Route::get('/purchase/confirm', [PurchaseController::class, 'confirm'])->name('purchase.confirm');
Route::post('/purchase/finalize', [PurchaseController::class, 'finalize'])->name('purchase.finalize');


Route::get('/confirm', [ConfirmController::class, 'index'])->name('confirm.index');
    Route::post('/confirm/{purchase}', [ConfirmController::class, 'confirm'])->name('confirm.confirm');

// Route::get('/admin', [AdminController::class, 'index'])->middleware(AdminMiddleware::class)->name('admin.index');