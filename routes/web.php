<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
// 	$page = 'dashboard';
// 	return view('index', compact('page'));
// });

// Route::get('/profile', function () {
// 	$page = 'dashboard';
// 	return view('profile', compact('page'));
// });

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TransactionController;


Route::get('/', [UserController::class, 'landing'])->middleware('auth')->name('landing');
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/product', function () {
	return view('pages.product');
});

Route::group(['prefix' => 'store', 'middleware' => ['auth', 'storeAuth']], function () {
	Route::get('/', [StoreController::class, 'index'])->name('store');
	Route::get('/product', [StoreController::class, 'product'])->name('store.products');
	Route::get('/product/new', [StoreController::class, 'createProduct'])->name('store.product.add');
	Route::post('/product/new', [StoreController::class, 'storeProduct'])->name('store.product.store');
	Route::get('/product/{id}', [StoreController::class, 'editProduct'])->name('store.product.edit');
	Route::post('/product/{id}', [StoreController::class, 'updateProduct'])->name('store.product.update');
	Route::get('/category', [CategoryController::class, 'index'])->name('store.category');
	Route::get('/category/new', [CategoryController::class, 'createCategory'])->name('store.category.create');
	Route::post('/category/new', [CategoryController::class, 'storeCategory'])->name('store.category.store');
	Route::get('/category/{id}', [CategoryController::class, 'editCategory'])->name('store.category.edit');
	Route::post('/category/{id}', [CategoryController::class, 'updateCategory'])->name('store.category.update');
	Route::get('/transaction', [TransactionController::class, 'indexStore'])->name('store.transaction');
	Route::get('/transaction/{id}', [TransactionController::class, 'editStore'])->name('store.transaction.edit');
	Route::post('/transaction/{id}', [TransactionController::class, 'updateStore'])->name('store.transaction.update');
});

Route::group(['prefix' => 'open', 'middleware' => 'auth'], function () {
	Route::get('/', [StoreController::class, 'createStore'])->name('store.create');
});

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
	Route::get('/', function () { return redirect()->route('user.profile'); });
	Route::get('/review', [ReviewController::class, 'index'])->name('user.review');
	Route::post('/review', [ReviewController::class, 'update'])->name('user.review.update');
	Route::get('/store/new', [StoreController::class, 'createStore'])->name('user.store.open');
	Route::post('/store/new', [StoreController::class, 'storeStore'])->name('user.store.store');
	Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
	Route::get('/address', [UserController::class, 'address'])->name('user.address');
	Route::get('/address/new', [UserController::class, 'createAddress'])->name('user.address.add');
	Route::post('/address/new', [UserController::class, 'storeAddress'])->name('user.address.store');
	Route::get('/address/{id}', [UserController::class, 'address'])->name('user.address.edit');
	Route::post('/address/{id}', [UserController::class, 'address'])->name('user.address.update');
	Route::get('/shopping-cart', [UserController::class, 'shoppingcart'])->name('user.shoppingcart');
	Route::get('/shopping-cart/{cart_id}/{variant_id}', [UserController::class, 'deleteCartItem'])->name('user.shoppingcart.remove');
	Route::post('/shopping-cart/checkout', [UserController::class, 'checkout'])->name('user.checkout');
	Route::post('/shopping-cart/checkout/store', [UserController::class, 'storeTransaction'])->name('user.checkout.store');
	Route::get('/transaction', [TransactionController::class, 'indexUser'])->name('user.transaction');
	Route::get('/transaction/{transaction_id}', [TransactionController::class, 'editUser'])->name('user.transaction.detail');
	Route::post('/transaction/{transaction_id}', [TransactionController::class, 'updateUser'])->name('user.transaction.update');
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('store-notfound');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('store/{store_domain}/product/{product_id}', [ProductController::class, 'index'])->middleware(['auth'])->name('store.product');
Route::post('store/{store_domain}/product/{product_id}/', [ProductController::class, 'addToCart'])->middleware(['auth'])->name('store.product.addtocart');
Route::get('store/{store_domain}', [StoreController::class, 'store'])->middleware(['auth'])->name('user.store');