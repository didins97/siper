<?php

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Rute untuk Admin
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    # Item
    Route::resource('/products', App\Http\Controllers\ProductController::class);

    # User
    Route::resource('/users', App\Http\Controllers\UserController::class);

    # Dashboard
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'adminDashboard'])->name('admin.dashboard');

    Route::get('products/pdf', [App\Http\Controllers\ProductController::class, 'exportToPDF'])->name('admin.products-pdf');
    Route::get('products/excel', [App\Http\Controllers\ProductController::class, 'exportToExcel'])->name('admin.products-excel');
    Route::get('products/print', [App\Http\Controllers\ProductController::class, 'print'])->name('admin.products-print');

    # Order
    Route::get('/orders/pdf', [App\Http\Controllers\OrderController::class, 'exportToPDF'])->name('admin.orders-pdf');
    Route::get('/orders/excel', [App\Http\Controllers\OrderController::class, 'exportToExcel'])->name('admin.orders-excel');
    Route::get('orders', [App\Http\Controllers\OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('orders/{id}', [App\Http\Controllers\OrderController::class, 'show'])->name('admin.orders.show');
    Route::put('orders/{id}', [App\Http\Controllers\OrderController::class, 'updateStatus'])->name('admin.orders.update.status');
    Route::delete('orders/{id}', [App\Http\Controllers\OrderController::class, 'destroy'])->name('admin.orders.destroy');

    # Job
    Route::get('/jobs/pdf', [App\Http\Controllers\PrintingJobController::class, 'exportToPDF'])->name('admin.jobs-pdf');
    Route::get('/jobs/excel', [App\Http\Controllers\PrintingJobController::class, 'exportToExcel'])->name('admin.jobs-excel');
    Route::get('jobs', [App\Http\Controllers\PrintingJobController::class, 'index'])->name('admin.jobs.index');
    Route::get('jobs/{id}', [App\Http\Controllers\PrintingJobController::class, 'show'])->name('admin.jobs.show');
    Route::put('/jobs/{id}', [App\Http\Controllers\PrintingJobController::class, 'update'])->name('operator.jobs.update');
    Route::put('jobs/status/{id}', [App\Http\Controllers\PrintingJobController::class, 'updateStatus'])->name('admin.jobs.update.status');
    Route::delete('jobs/{id}', [App\Http\Controllers\PrintingJobController::class, 'destroy'])->name('admin.jobs.destroy');

    # Report
    Route::get('reports', [App\Http\Controllers\ReportController::class, 'index'])->name('admin.reports.index');
    Route::post('reports', [App\Http\Controllers\ReportController::class, 'getReport'])->name('admin.reports.getReport');

    # Chart
    Route::get('/job-pie-chart', [App\Http\Controllers\DashboardController::class, 'jobPieChart'])->name('admin.job-pie-chart');
    Route::get('/order-area-chart', [App\Http\Controllers\DashboardController::class, 'orderAreaChart'])->name('admin.order-area-chart');

    #Offline Order
    Route::get('/choose-items', [App\Http\Controllers\ProductController::class, 'chooseItemsIndex'])->name('admin.choose-items.index');
    Route::get('/choose-items/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('admin.choose-items.show');
    Route::get('/choose-items/sizes-prices/{id}', [App\Http\Controllers\ProductController::class, 'GetSizesPrices'])->name('admin.sizes-prices');
    Route::post('create-order/{productId}', [App\Http\Controllers\OrderController::class, 'createOrder'])->name('admin.create-order');
});

// Rute untuk Operator
Route::prefix('operator')->middleware(['auth', 'role:operator'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'operatorDashboard'])->name('operator.dashboard');

    Route::get('/jobs', [App\Http\Controllers\PrintingJobController::class, 'index'])->name('operator.jobs.index');
    Route::get('/jobs/{id}', [App\Http\Controllers\PrintingJobController::class, 'show'])->name('operator.jobs.show');
    Route::put('/jobs/status/{id}', [App\Http\Controllers\PrintingJobController::class, 'updateStatus'])->name('operator.jobs.update.status');
    Route::delete('/jobs/{id}', [App\Http\Controllers\PrintingJobController::class, 'destroy'])->name('operator.jobs.destroy');

    Route::get('/job-pie-chart', [App\Http\Controllers\DashboardController::class, 'jobPieChart'])->name('operator.job-pie-chart');

    Route::get('reports', [App\Http\Controllers\ReportController::class, 'index'])->name('operator.reports.index');
    Route::post('reports', [App\Http\Controllers\ReportController::class, 'getReport'])->name('operator.reports.getReport');
});

// Rute untuk User
Route::prefix('user')->middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'userDashboard'])->name('user.dashboard');

    Route::get('/items', [App\Http\Controllers\ProductController::class, 'index'])->name('user.items.index');
    Route::get('/items/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('user.items.show');
    Route::get('/items/sizes-prices/{id}', [App\Http\Controllers\ProductController::class, 'GetSizesPrices'])->name('user.sizes-prices');

    Route::get('orders', [App\Http\Controllers\OrderController::class, 'index'])->name('user.orders.index');
    Route::get('orders/{id}', [App\Http\Controllers\OrderController::class, 'show'])->name('user.orders.show');
    Route::post('create-order/{productId}', [App\Http\Controllers\OrderController::class, 'createOrder'])->name('user.create-order');
    Route::put('orders/{id}', [App\Http\Controllers\OrderController::class, 'cancel'])->name('user.orders.cancel');

    Route::put('/profile/{id}', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('user.profile.update');
    Route::put('/password/{id}', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('user.password.update');
});
