<?php
use Illuminate\Support\Facades\Auth;
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





Route::get('/', function () {
    
    if (Auth::check()) {

        if(Auth::user()->user_type == "admin"){

            return redirect()->route('admin-dashboard');
            
        }
        
        return redirect()->route('user-dashboard');
    }

    return view('auth.login');

});

Auth::routes();

Route::get('/login', function () {
    
    if (Auth::check()) {

        if(Auth::user()->user_type == "admin"){

            return redirect()->route('admin-dashboard');
            
        }
        
        return redirect()->route('user-dashboard');
    }

    return view('auth.login');

});

Route::get('/register', function () {
    
    if (Auth::check()) {

        if(Auth::user()->user_type == "admin"){

            return redirect()->route('admin-dashboard');
            
        }
        
        return redirect()->route('user-dashboard');
    }

    return view('auth.login');

});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/print/{id}/{requestor}', 'PrintController@view_print')->name('view.pdf');


//User Dashboard
Route::get('/user/dashboard', 'User\UserDashboardController@index')->name('user-dashboard');
Route::post('/user/dashboard', 'User\UserDashboardController@store')->name('insert.products');

//User Request
Route::get('/search/request', 'User\UserRequestController@search')->name('search-request');
Route::get('/user/request', 'User\UserRequestController@index')->name('user-request');
Route::put('/user/delete', 'User\UserRequestController@delete')->name('request.delete');

//User Send
Route::get('/user/{id}/{requestor}', 'User\UserSendController@index')->name('user-send');
Route::post('/user/insert', 'User\UserSendController@addProduct')->name('add.product');
Route::put('/user/approval'. 'User\UserSendController@approval')->name('request.approval');
Route::put('/user/pr', 'User\UserSendController@savePR')->name('save.pr');
Route::put('/user/save_product', 'User\UserSendController@saveProduct')->name('save.product');
Route::put('/user/requested', 'User\UserSendController@requested')->name('requested.pr');
Route::delete('/user/delete', 'User\UserSendController@destroy')->name('delete.product');

//User Requested
Route::get('/user/requested', 'User\UserRequestedController@index')->name('user-requested');
Route::get('/search/requested', 'User\UserRequestedController@search')->name('search-requested');


Route::group(['middleware' => ['auth', 'admin']], function(){

    Route::get('/admin/dashboard', 'Admin\AdminDashboardController@index')->name('admin-dashboard');
    
});



