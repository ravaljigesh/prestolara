<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('custom/slug', 'App\Controllers\AdminControllers\JigeshravalController@test');

Route::any('{slug}', function () {
  return redirect(AdminURL('index.php?controller=AdminDashboard&token=' . \Tools::getAdminToken('admin')));
});
Route::any('', function () {
  return redirect(AdminURL('index.php?controller=AdminDashboard&token=' . \Tools::getAdminToken('admin')));
});
