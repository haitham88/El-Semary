<?php

use App\SubCategory;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});


//Route::get('get_subCategory', array('as' => 'getSC', 'uses' => 'OrderController@getSubCategory'));

Route::group(['prefix' => 'admin'], function () {
    Route::get('orders/getSC', function () {
        $result = SubCategory::all();
        return $result;
    });
    Route::get('invoice_export_pdf', ['uses' => 'InvoiceController@export_pdf', 'as' => 'invoice_export_pdf']);

    Voyager::routes();

});
