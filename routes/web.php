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
Route::middleware('auth')->group(function (){
    Route::get('/', 'MainController@index')->name('main');
    Route::get('profile', 'ProfileController@index')->name('profile');
    Route::post('profile', 'ProfileController@update')->name('profile');
    Route::get('session/{id}', 'InvoiceController@score')->name('invoice.score');
    Route::get('reckoning', 'InvoiceController@show')->name('invoice.show');
    Route::post('add', 'InvoiceController@add')->name('invoice.add');
    Route::get('add', 'InvoiceController@add')->name('invoice.add');
    Route::get('setting/{id}', 'InvoiceController@setting')->name('invoice.setting');
    Route::post('setting/{id}', 'InvoiceController@setting')->name('invoice.setting');
    Route::get('article/{id}', 'ArtController@show')->name('art.show');
    Route::post('crud', 'ArtController@crud')->name('art.crud');
    Route::get('income/{id}','RunController@income')->name('run.income');
    Route::get('expenditure/{id}','RunController@expenditure')->name('run.expenditure');
    Route::post('setMain','RunController@setMain')->name('run.setMain');
    Route::post('transfer','RunController@transfer')->name('run.transfer');
    Route::delete('delRow','RunController@delRow')->name('run.delRow');
    Route::get('setPeriod/{pr}','PeriodController@setPeriod')->name('period.set');
    Route::post('setRange','PeriodController@setRange')->name('period.range');
    Route::get('summary','SummaryController@index')->name('summary');
    Route::post('summary','SummaryController@index')->name('summary');

    Route::prefix('ajax')->namespace('Ajax')->name('ajax.')->group(function (){
        Route::post('editMain','AjaxController@editMainRow')->name('editMain');
        Route::post('saveMain','AjaxController@saveMainRow')->name('saveMain');
    });
});





Route::get('/home', 'HomeController@index')->name('home');
Route::get('/default ','DefaultController@table')->name('tableSql');
