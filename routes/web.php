<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\addNewUserController;

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
    return view('auth/login');
});

Route::resource('product', ProductsController::class);

Auth::routes();
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');


/*---------------- start routes Add new users---------------------------------
==========================================================*/

Route::get('/showusers', [App\Http\Controllers\addNewUserController::class, 'showusers'])->name('addNewUser.showusers');

Route::get('/createNewUser', [App\Http\Controllers\addNewUserController::class, 'create'])->name('addNewUser.create');

Route::post('/AddUser', [App\Http\Controllers\addNewUserController::class, 'store'])->name('addNewUser.store');

Route::delete('/destroy/{id}', [App\Http\Controllers\addNewUserController::class, 'destroy'])->name('showuser.destroy');


/*----------------End routes Add new users---------------------------------
==========================================================*/


/*---------------- start routes cart---------------------------------
==========================================================*/
Route::post('/addcart/{id}', [App\Http\Controllers\DashboardController::class, 'addcart'])->name('addcart');
/*----------------increment decrement---------------------------------*/

Route::put('/updateIncre/{id}', [App\Http\Controllers\DashboardController::class, 'updateIncre'])->name('cart.updateIncre');
Route::put('/updateDecre/{id}', [App\Http\Controllers\DashboardController::class, 'updateDecre'])->name('cart.updateDecre');

/*-----------destroy cart-------------*/
Route::delete('/cartdestroy/{id}', [App\Http\Controllers\DashboardController::class, 'cartdestroy'])->name('cart.destroy');
/*---------------- End routes cart---------------------------------
==========================================================*/




/*----------------confirm order---------------------------------*/
Route::post('/confirm', [App\Http\Controllers\OrdersController::class, 'store'])->name('confirm');
    /*--==============================-all orders Admin-==============================
    ==============================================================================-------*/
Route::get('/allorders', [App\Http\Controllers\OrdersController::class, 'index'])->name("orders.allorders");

/*----------add status for order---------------*/
Route::put('/allorders/{id}', [App\Http\Controllers\OrdersController::class, 'updatestatus'])->name("orders.updateStatus");

Route::post('/myorders/{id}', [App\Http\Controllers\OrdersController::class, 'index'])->name("orders.myorders_ch");
Route::delete('/myorders/{id}', [App\Http\Controllers\OrdersController::class, 'destroy'])->name("orders.destroy");
    /*-==============================--all orders Admin----=======================----
    =================================================================================
    */

    /*---start orders for one user--------*/
Route::get('/myorders', [App\Http\Controllers\OrdersController::class, 'myorders'])->name("orders.myorders");
Route::delete('/destroyOrderUser/{id}', [App\Http\Controllers\OrdersController::class, 'destroyOrderUser'])->name("orders.destroyOrderUser");
    /*--- end orders for one user--------*/



/*----------------confirm order---------------------------------*/
