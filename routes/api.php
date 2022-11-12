<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PembelianController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     // return $request->user();
//     Route::get('/form', [FormController::class, 'index']);
// });

// Route::group(['middleware' => 'auth:sanctum'], function(){
//     Route::post('/create', [FormController::class, 'create']);

//     Route::get('/logout', [FormController::class, 'logout']);
// });

// Route::post('users', [AuthController::class, 'users']);

Route::get('produk/{id}', [PembelianController::class, 'show']);
Route::get('barang-satuan/{id}', [PembelianController::class, 'barangSatuan']);