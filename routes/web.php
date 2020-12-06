<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WaterController;
use App\Http\Controllers\MemberController;

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
    return view('home');
});


Route::group(['prefix'=>'waters'],function(){
    
    Route::middleware(['auth:sanctum', 'verified'])->
    get('/',[WaterController::class,'index'])->name('waters.index');

    Route::middleware(['auth:sanctum', 'verified'])->
    get('/create',[WaterController::class,'create'])->name('waters.create');

    Route::middleware(['auth:sanctum', 'verified'])->
    post('/store',[WaterController::class,'store'])->name('waters.store');

    Route::middleware(['auth:sanctum', 'verified'])->
    get('/edit/{water}',[WaterController::class,'edit'])->name('waters.edit');

    Route::middleware(['auth:sanctum', 'verified'])->
    post('/update/{water}',[WaterController::class,'update'])->name('waters.update');

    Route::middleware(['auth:sanctum', 'verified'])->
    post('/destroy/{water}',[WaterController::class,'destroy'])->name('waters.destroy');
    
    
});
Route::group(['prefix'=>'members'],function(){
    
    Route::middleware(['auth:sanctum', 'verified'])->
    get('/',[MemberController::class,'index'])->name('member.index');

    Route::middleware(['auth:sanctum', 'verified'])->
    get('/create',[MemberController::class,'create'])->name('member.create');

    Route::middleware(['auth:sanctum', 'verified'])->
    post('/store',[MemberController::class,'store'])->name('member.store');

    Route::middleware(['auth:sanctum', 'verified'])->
    get('/edit/{member}',[MemberController::class,'edit'])->name('member.edit');

    Route::middleware(['auth:sanctum', 'verified'])->
    get('/sort',[MemberController::class,'sort'])->name('member.sort');

    Route::middleware(['auth:sanctum', 'verified'])->
    post('/update/{member}',[MemberController::class,'update'])->name('member.update');

    Route::middleware(['auth:sanctum', 'verified'])->
    post('/destroy/{member}',[MemberController::class,'destroy'])->name('member.destroy');
    
   
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
