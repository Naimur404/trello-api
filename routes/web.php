<?php

use App\Http\Controllers\trello;
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

Route::get('/',function(){
    return view('auth');
});
Route::get('/tokenview',function(){
    return view('token');
});

Route::get('/auth',[trello::class,'test'])->name('auth');
Route::get('/token',[trello::class,'token'])->name('token');
Route::get('/board',[trello::class,'getboard'])->name('getboard');
Route::get('/boarddelete/{id}',[trello::class,'boarddelete'])->name('boarddelete');
Route::get('/createboardview',[trello::class,'createboardview'])->name('createboardview');
Route::get('/createboard',[trello::class,'createboard'])->name('createboard');
Route::get('/editview/{id}',[trello::class,'editview'])->name('editview');
Route::get('/updateboard/{id}',[trello::class,'updateboard'])->name('updateboard');
Route::get('/getboadlist/{id}',[trello::class,'getboadlist'])->name('getboadlist');
Route::get('/createlistview/{id}',[trello::class,'createlistview'])->name('createlistview');
Route::get('/addlist',[trello::class,'addlist'])->name('addlist');
Route::get('/getcardlist/{id}',[trello::class,'getcardlist'])->name('getcardlist');
Route::get('/addcard',[trello::class,'addcard'])->name('addcard');
Route::get('/addcardview/{id}',[trello::class,'addcardview'])->name('addcardview');

