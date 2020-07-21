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
Auth::routes();
Route::group(['middleware' => ['auth',]], function () {
	
	Route::get('logout', 'HomeController@logout');

	Route::get('cart', 'HomeController@cart');
	Route::post('add-cart', 'HomeController@savecart');
	Route::post('edit-cart/{id}', 'HomeController@editcart');
	Route::get('delete-cart/{id}', 'HomeController@deletecart');

	// Ongkir
	Route::get('/province/{id}/cities', 'HomeController@getCities');
	Route::get('/cost/{city_origin}/{city_destination}/{weight}/{courier}', 'HomeController@submit');
	 //test req

	Route::get('historypembelian', 'HomeController@historypembelian');
	Route::group(['prefix' => 'historypembelian'], function () { 

	Route::get('view-history/{id}', 'HomeController@viewhistory');

	});
	Route::get('invoice', 'HomeController@invoice'); //masukin data ke sesion
	Route::post('/submit', 'HomeController@submit');
	Route::get('payment', 'HomeController@payment');
	Route::post('save-payment', 'HomeController@savepayment');

	
	// custom
	Route::post('customCheckout', 'HomeController@customCheckout');
	Route::post('/customInvoice', 'HomeController@customInvoice');
	Route::get('custompayment', 'HomeController@custompayment');
	Route::post('custom-save-payment', 'HomeController@customsavepayment');
	
	//link admin
	Route::group(['prefix' => 'admin','middleware' => ['admin']], function () {
		Route::get('/', 'AdminHomeController@home');
        Route::get('/product', 'AdminHomeController@product');
		Route::get('/addproduct', 'AdminHomeController@addproduct');
		Route::post('/saveproduct', 'AdminHomeController@saveproduct');
		Route::get('/editproduct/{id}', 'AdminHomeController@editproduct');
		Route::post('/editproductsave/{id}', 'AdminHomeController@editproductsave');
		Route::get('/deletebarang/{id}', 'AdminHomeController@deletebarang');

		// custom
		
        Route::get('/custom', 'AdminHomeController@custom');
		Route::get('/addcustom', 'AdminHomeController@addcustom');
		Route::post('/savecustom', 'AdminHomeController@savecustom');
		Route::get('/editcustom/{id}', 'AdminHomeController@editcustom');
		Route::post('/editcustomsave/{id}', 'AdminHomeController@editcustomsave');
		Route::get('/deletecustom/{id}', 'AdminHomeController@deletecustom');
		// end custom
		
		Route::get('/bank', 'AdminHomeController@bank');
		Route::get('/addbank', 'AdminHomeController@addbank');
		Route::post('/savebank', 'AdminHomeController@savebank');
		Route::get('/editbank/{id}', 'AdminHomeController@editbank');
		Route::post('/editbanksave/{id}', 'AdminHomeController@editbanksave');
		Route::get('/deletebank/{id}', 'AdminHomeController@deletebank');

		Route::get('/transaksi', 'AdminHomeController@transaksi');
		Route::get('/viewtransaksi/{id}', 'AdminHomeController@viewtransaksi');
		Route::post('/saveresi/{id}', 'AdminHomeController@saveresi');
		Route::get('/acctransaksi/{id}', 'AdminHomeController@acctransaksi');
		Route::get('/rejecttransaksi/{id}', 'AdminHomeController@rejecttransaksi');
		
        Route::get('/user', 'AdminHomeController@user');
		Route::get('/edituser/{id}', 'AdminHomeController@edituser');
		Route::post('/editusersave/{id}', 'AdminHomeController@editusersave');
        Route::get('/logout', 'AdminHomeController@logout');
	});
	
	// Route::get('/reset', 'AdminHomeController@reset'); 

});

Route::group(['middleware' => ['web']], function () {
	Route::get('/', 'HomeController@index');
	Route::get('detail/{id}', 'HomeController@detail');

	Route::get('login', 'HomeController@login');
	Route::post('postlogin', 'HomeController@postlogin');

	
	Route::get('custom', 'HomeController@custom');

	//login admin
	Route::get('admin', 'AdminHomeController@login');
	Route::get('admin/login', 'AdminHomeController@login');
	Route::post('admin/ceklogin', 'AdminHomeController@ceklogin'); 

	Route::get('registrasi', 'HomeController@registrasi');
	Route::post('postregistrasi', 'HomeController@postregistrasi');


});

	

    

