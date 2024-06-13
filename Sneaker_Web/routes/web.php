<?php
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DetailProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\UserMainController;
use App\Http\Controllers\UserMenuController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;


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


Route::get('admin/users/login', [LoginController::class,'index'])->name('login');

Route::post('admin/users/login/store', [LoginController::class,'store']);

Route::middleware(['auth'])->group(function () {

    Route::prefix('admin')->group(function () {
        Route::get('/', [MainController::class,'index'])->name('admin');
        Route::get('/main', [MainController::class,'index']);
    
    
        Route::prefix('menus')->group(function () {
            Route::get('add', [MenuController::class,'create']);
            Route::post ('add', [MenuController::class,'store']);
            Route::get ('list', [MenuController::class,'index']);
            Route::get ('edit/{menu}', [MenuController::class,'show']);
            Route::post ('edit/{menu}', [MenuController::class,'update']);
            Route::delete ('destroy', [MenuController::class,'destroy']);
        });

        Route::prefix('product')->group(function () {
            Route::get('add', [ProductController::class,'create']);
            Route::post ('add', [ProductController::class,'store']);
            Route::get ('list', [ProductController::class,'index']);
            Route::get ('edit/{product}', [ProductController::class,'show']);
            Route::post ('edit/{product}', [ProductController::class,'update']);
            Route::delete ('destroy', [ProductController::class,'destroy']);
        });

        #upload
        Route::post('upload/services',[UploadController::class,'store']);

    });
});

Route::get('index', [UserMainController::class, 'index']);
Route::post('services/load-product',[UserMainController::class,'loadProduct']);

Route::get('danh-muc/{id}-{slug}.html',[UserMenuController::class,'index']);
Route::get('san-pham/{id}-{slug}.html',[DetailProductController::class,'index']);

Route::post('add-cart',[CartController::class,'index']);
