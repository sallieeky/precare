<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get("/getuserdata/{user}", [ApiController::class, "getUserData"]);
Route::get("/get-user-cekin-cekout/{user}", [ApiController::class, "getUserCekinCekout"]);
Route::get("/get-cekin-status/{user}", [ApiController::class, "getCekinStatus"]);
Route::get("/get-cekout-status/{user}", [ApiController::class, "getCekoutStatus"]);
Route::get("/get-user-report/{user}", [ApiController::class, "report"]);

Route::post("/login", [ApiController::class, "login"]);
Route::post("/edit-alamat", [ApiController::class, "editAlamat"]);
Route::post("/edit-notelp", [ApiController::class, "editNoTelp"]);

Route::post("/cekin", [ApiController::class, "cekin"]);
Route::post("/cekout", [ApiController::class, "cekout"]);
Route::post("/absent", [ApiController::class, "absent"]);

Route::post("/gambar", [ApiController::class, "gambar"]);
