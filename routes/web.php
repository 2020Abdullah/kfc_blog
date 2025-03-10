<?php

use App\Http\Controllers\BlogCommentController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('category/{id}/view', [HomeController::class, 'categoryView'])->name('categoryView');
Route::get('blog/{id}-{slug}', [HomeController::class, 'blogView'])->name('blogView');
Route::get('allNews/view', [HomeController::class, 'allNews'])->name('allNews');
Route::get('/get-slider-by-code/{code}', [SliderController::class, 'getSliderByCode'])->name('slider.code');
Route::get('page/{id}-{slug}', [HomeController::class, 'pageView'])->name('pageView');
Route::get('/search', [HomeController::class, 'search'])->name('search');


Route::group(['middleware' => 'auth'], function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('data/update', [DashboardController::class, 'updateData'])->name('update.data');

    /* category crud */
    Route::get('category/view', [CategoryController::class, 'index'])->name('category.view');
    Route::post('category/add', [CategoryController::class, 'store'])->name('category.store');
    Route::post('category/update', [CategoryController::class, 'update'])->name('category.update');
    Route::post('category/del', [CategoryController::class, 'delete'])->name('category.del');

    /* blog crud */
    Route::get('blog/view', [BlogsController::class, 'viewBlog'])->name('blog.view');
    Route::get('blog/{id}/show', [BlogsController::class, 'showBlog'])->name('blog.show');
    Route::get('blog/add', [BlogsController::class, 'addBlog'])->name('blog.add');
    Route::post('blog/store', [BlogsController::class, 'storeBlog'])->name('blog.store');
    Route::get('blog/{id}/edit', [BlogsController::class, 'editBlog'])->name('blog.edit');
    Route::post('blog/update', [BlogsController::class, 'updateBlog'])->name('blog.update');
    Route::post('blog/delete', [BlogsController::class, 'deleteBlog'])->name('blog.delete');
    Route::post('/upload-images', [BlogsController::class, 'uploadImages'])->name('upload.images');

    /* page crud */
    Route::get('page/view', [PageController::class, 'pageView'])->name('page.view');
    Route::get('page/{id}/show', [PageController::class, 'showPage'])->name('page.show');
    Route::get('page/add', [PageController::class, 'addPage'])->name('page.add');
    Route::post('page/store', [PageController::class, 'storePage'])->name('page.store');
    Route::get('page/{id}/edit', [PageController::class, 'editPage'])->name('page.edit');
    Route::post('page/update', [PageController::class, 'updateBlog'])->name('page.update');
    Route::post('page/delete', [PageController::class, 'deletePage'])->name('page.delete');

    /* slider */
    Route::get('slider/view', [SliderController::class, 'sliderIndex'])->name('slider.index');
    Route::get('slider/create', [SliderController::class, 'sliderCreate'])->name('slider.create');
    Route::get('slider/{id}/slices', [SliderController::class, 'sliderShow'])->name('slider.show');
    Route::post('slider/slices/update', [SliderController::class, 'sliderSliceUpdate'])->name('slider.slice.update');
  
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
