<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\PengaduanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Auth
Route::post('sign-up', [AuthController::class, 'signUp']);
Route::post('sign-in', [AuthController::class, 'signIn']);

Route::group(['middleware' => ['auth:sanctum', 'ability:user']], function () {

    //User
    Route::get('user', [UserController::class, 'user']);

    //Pengaduan
    Route::post('create-pengaduan', [PengaduanController::class, 'create']);

    //Auth
    Route::post('sign-out/{tokenId}', [AuthController::class, 'signOut']);
});