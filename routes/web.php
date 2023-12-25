<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SizeController;

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

// <------------------------------------ Back ENd ------------------------------------------>

                // <-------------------Sử dụng------------------>
                Route::group(['middleware' => ['checkUserStatus']], function () {
                    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
                });

                Auth::routes();

                Route::group(['middleware' => ['role:admin']], function () {
                    Route::resource('brand', BrandController::class);
                    Route::resource('user', UserController::class);
                    Route::resource('person', PersonController::class);
                    Route::resource('role', RoleController::class);
                    Route::resource('permission', PermissionsController::class);
                    Route::resource('product', ProductController::class);
                    Route::resource('library', LibraryController::class);
                    Route::resource('category', CategoryController::class);
                    Route::resource('genre', GenreController::class);
                    Route::resource('color', ColorController::class);
                    Route::resource('storage', StorageController::class);
                    Route::resource('size', SizeController::class);

                    Route::get('/assign-role/{id}', [UserController::class, 'assign_role'])->name('assign-role');
                    Route::post('/insert-role/{id}', [UserController::class, 'insert_role'])->name('insert-role');
                    Route::get('/assign-permissions/{id}', [RoleController::class, 'assign_permissions'])->name('assign-permissions');
                    Route::post('/insert-permissions/{id}', [RoleController::class, 'insert_permissions'])->name('insert-permissions');

                    // <-------------------Sắp Xếp bằng Ajax------------------>
                    Route::post('resorting_cate', [\App\Http\Controllers\CategoryController::class, 'resorting_cate'])->name('resorting_cate');

                    // <-------------------Update thuộc tính bằng Ajax------------------>

                    // <-------------------Update Hình Ảnh bằng Ajax------------------>
                    Route::post('/store-image-library-ajax', [LibraryController::class, 'store_image_library_ajax'])->name('store-image-library-ajax');
                    Route::post('/update-image-brand-ajax', [BrandController::class, 'update_image_brand_ajax'])->name('update-image-brand-ajax');
                    Route::post('/update-image-user-ajax', [UserController::class, 'update_image_user_ajax'])->name('update-image-user-ajax');

                    // <-------------------Hiển thị khi thêm Hình Ảnh bằng Ajax------------------>
                    Route::post('/show-image-genre', [GenreController::class, 'show_image_genre'])->name('show-image-genre');
                    Route::post('/show-image-category', [CategoryController::class, 'show_image_category'])->name('show-image-category');
                    Route::post('/show-image-brand', [BrandController::class, 'show_image_brand'])->name('show-image-brand');
                    Route::post('/show-image-post', [PostController::class, 'show_image_post'])->name('show-image-post');
                    Route::post('/show-image-product', [ProductController::class, 'show_image_product'])->name('show-image-product');
                    Route::post('/show-image-user', [UserController::class, 'show_image_user'])->name('show-image-user');

                });

                Route::group(['middleware' => ['role:admin|writer', 'checkUserStatus']], function () {
                    Route::get('/edit-user/{id}', [UserController::class, 'edit_user'])->name('edit-user');
                    Route::put('/update-user/{id}', [UserController::class, 'update_user'])->name('update-user');
                    Route::get('/profile-user/{id}', [UserController::class, 'profile_user'])->name('profile-user');
                    Route::get('/edit-password/{id}', [UserController::class, 'edit_password'])->name('edit-password');
                    Route::put('/update-password/{id}', [UserController::class, 'update_password'])->name('update-password');
                    Route::resource('post', PostController::class);

                });
// <------------------------------------ Front ENd ------------------------------------------>
                Route::get('/', [IndexController::class, 'home'])->name('homepage');
                Route::get('/danh-muc/{slug}', [IndexController::class, 'category'])->name('category');
                Route::get('/san-pham/{slug}', [IndexController::class, 'product'])->name('product');