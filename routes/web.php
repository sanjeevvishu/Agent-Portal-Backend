<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Middleware\IsAdmin;
 

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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
Route::prefix('admin')->middleware(['auth',IsAdmin::class])->name('admin.')->group( function () {

	// Admin Dashboard
	Route::get('dashboard',[App\Http\Controllers\Admin\DashboardController::class,'index'])->name('dashboard.index');	

    Route::resource('projects', App\Http\Controllers\Admin\ProjectsController::class);
    Route::resource('projects.units', App\Http\Controllers\Admin\UnitsController::class)->shallow();
    Route::resource('projects.media', App\Http\Controllers\Admin\ProjectMediaController::class)->shallow();
    Route::resource('projects.vagonapps', App\Http\Controllers\Admin\VagonAppsController::class)->shallow();

    Route::get('projects/media/getImage/{media}', [App\Http\Controllers\Admin\ProjectMediaController::class,'getImage'])->name('projects.media.getImage');
    Route::get('projects/{project}/media/list', [App\Http\Controllers\Admin\ProjectMediaController::class,'list'])->name('projects.media.list');
    Route::delete('projects/{project}/media/delete/{projectMedia?}', [App\Http\Controllers\Admin\ProjectMediaController::class,'delete'])->name('projects.media.delete');
    
    Route::resource('amenities', App\Http\Controllers\Admin\AmenitiesController::class);
    Route::resource('cuEvents', App\Http\Controllers\Admin\CuEventsController::class);
    Route::resource('cuSocials', App\Http\Controllers\Admin\CuSocialsController::class);
    Route::resource('cuVerseCategories', App\Http\Controllers\Admin\CuVerseCategoriesController::class);
   // Route::resource('cuVerses', App\Http\Controllers\Admin\CuVersesController::class);
    
    Route::get('cuVerses', [App\Http\Controllers\Admin\CuVersesController::class,'index'])->name('cuVerses.index');
    Route::get('cuVerses/{project}', [App\Http\Controllers\Admin\CuVersesController::class,'show'])->name('cuVerses.show');
    Route::post('cuVerses/store/{project}', [App\Http\Controllers\Admin\CuVersesController::class,'store'])->name('cuVerses.store');
    Route::get('cuVerses/list/{project}', [App\Http\Controllers\Admin\CuVersesController::class,'list'])->name('cuVerses.list');
    Route::get('cuVerses/mediaList', [App\Http\Controllers\Admin\CuVersesController::class,'medialist'])->name('cuVerses.showMediaList');
    Route::delete('cuVerses/delete/{project}/{cuVerse?}', [App\Http\Controllers\Admin\CuVersesController::class,'delete'])->name('cuVerses.delete');
   
});