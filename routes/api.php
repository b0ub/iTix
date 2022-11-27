<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tiketController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\transaksiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post("/logout",[adminController::class,'logout']);
});
Route::resource('tiket', tiketController::class)->except(
    ['create','edit']
);

Route::post('/register',[adminController::class, 'register']);
Route::post('/login',[adminController::class, 'login']);

Route::delete("/user/{id}",[adminController::class, 'delete']);


Route::resource('transaksis', transaksiController::class)->except([
    'create', 'edit'
]);