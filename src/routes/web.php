<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RatingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/logout',[LogoutController::class, 'logout']);
Route::get('/admin/login',[LoginController::class, 'login'])->middleware('locale')->name('login_admin');
Route::get('/redirect/{provider}', [SocialController::class,'redirect']);
Route::get('/callback/{provider}', [SocialController::class,'callback']);

Route::group(['middleware' => 'locale'], function() {
    # Change language
    Route::get('change-language/{language}', [LocaleController::class, 'changeLanguage'])
        ->name('change-language');

    # Home page
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    # Route Auth
    Auth::routes();

    # Admin page
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin');
    });

    # Search Products
    Route::get('/search', [SearchController::class, 'getSearchProducts'])->name('search_products');

    # Search Category Type
    Route::get('/{slug}/category-type', [SearchController::class, 'getCategoryType'])->name('search_category_type')
        ->where('slug', '[A-Za-z]+');
    # Search Category
    Route::get('/{slug}/category', [SearchController::class, 'getCategory'])->name('search_categories')
        ->where('slug', '[0-9A-Za-z]+');

    # Product Detail
    Route::get('/{slug}', [ProductController::class, 'getProductDetail'])->name('product_detail');

    # Rating
    Route::post('/rating', [RatingController::class, 'ratingProduct'])->name('rating');
});
