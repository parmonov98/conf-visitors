<?php

use App\Http\Controllers\VisitorController;
use App\Http\Middleware\AfterJson;
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

Route::group(['middleware' => [AfterJson::class]], function () {
    Route::delete('visitors/bulk', [VisitorController::class, 'bulkDelete'])->name('visitors.bulkDelete');
    Route::resource('visitors', VisitorController::class);
});
