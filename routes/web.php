<?php

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
use Illuminate\Support\Facades\Route;
use function foo\func;

Route::get('/', 'Frontendcontroller@index')->name('homepage');
//Route::get('/page/{slug}', 'PagesController@show')->name('page');
Route::get('/help-and-faq', 'PagesController@gethelpandfaq')->name('help-faq');
Route::get('/Privacy-policy', 'PagesController@getprivacypolicy')->name('privacy-policy');
Route::get('/delivery-charges', 'PagesController@getdeliverycharges')->name('delivery-charges');
Route::get('/aboutandus', 'PagesController@aboutandus')->name('aboutandus');
Route::get('/contact', 'PagesController@contact')->name('contact-slug');
Route::get('/about_us', 'PagesController@getreturnpolicy')->name('return-policy');
Route::get('/terms-and-conditions', 'PagesController@gettermsandconditions')->name('terms-and-conditions');
Route::get('/is_featured', 'ProductController@isandfeatures')->name('is-featured');


Route::get('/registration','UserController@showRegisterform')->name('user-register');
Route::post('/registration-submit','UserController@submitVendor')->name('vendor-register');
Route::post('/registration-usersubmit','UserController@submitUser')->name('userr-register');
Route::get('/product-list','ProductController@showallproduct')->name('product-list');
Route::get('/product-detail/{slug}.html','ProductController@show')->name('product-detail');
Route::get('/category/{cat_slug}/{sub_cat}','CategoryController@getsubcategoryProduct')->name('sub-category-detail');
Route::get('/category/{slug}','CategoryController@getcategoryProduct')->name('category-detail');
Route::post('/submit-review/{product_id}','FrontendController@submitreview')->name('submit-review');
Route::post('/cart/','ProductController@addtocart')->name('add-to-cart');
Route::post('/remove/cart/','ProductController@removefromcart')->name('remove-from-cart');
Route::get('/cart',function(){
   return view('home.cart');
})->name('view-cart');
Route::get('/checkout','ProductController@checkout')->name('checkout')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function (){
    Route::get('/','HomeController@admin')->name('admin');
    Route::group(['prefix' => 'banner', 'middleware' => ['auth', 'admin']], function () {
        Route::get('/', 'BannerController@getBanner')->name('banner-list');
        Route::get('/add', 'BannerController@showBannerForm')->name('banner-add');

        Route::post('/submit', 'BannerController@submitPost')->name('banner-post');
        Route::post('/{id}', 'BannerController@submitPost')->name('banner-update');
        Route::delete('/{id}', 'BannerController@deletebanner')->name('delete-banner');
        Route::get('/{id}', 'BannerController@showBannerForm')->name('banner-edit');
    });
    Route::resource('category','CategoryController');
    Route::resource('product','ProductController');
    Route::resource('pages','PagesController')->except(['create','store','destroy']);
    Route::get('category/child/{id}','CategoryController@getChildCats')->name('get-child');

});



Route::group(['prefix' => 'vendor', 'middleware' => ['auth', 'vendor']], function (){
    Route::get('/vendorpanel/','HomeController@vendor')->name('vendor');
    Route::get('/productvendor/{id}','ProductController@getproductbyvendor')->name('getproductbyvendor');
    Route::get('/product/add','ProductController@getproductbyvendorforadd')->name('getproductbyvendorforadd');
    Route::get('/product/edit/{id}','ProductController@getproductbyvendorforedit')->name('getproductbyvendorforedit');
    Route::put('/product/update/{id}','ProductController@getproductbyvendorforupdate')->name('getproductbyvendorforupdate');
    Route::post('/product/store/{id}','ProductController@getproductbyvendorforstore')->name('getproductbyvendorforstore');
    Route::delete('/product/destroy/{id}','ProductController@getproductbyvendorfordestroy')->name('getproductbyvendorfordestroy');
    Route::get('category/child/{id}','CategoryController@getChildCats')->name('get-child');
});





Route::group(['prefix' => 'customer', 'middleware' => ['auth', 'customer']], function (){
    Route::get('/','HomeController@customer')->name('customer');
});

