<?php

use App\Http\Controllers\NewsController;
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

$link = "https%3A%2F%2Fwww.cnnindonesia.com%2Fhiburan%2F20220719173158-234-823490%2Fkorban-ungkap-kronologi-buluk-lakukan-penipuan-beras-bulog";
$source = "CNN Indonesia";
Route::apiResource('news', NewsController::class);
Route::get('getnews', [NewsController::class, 'getNews']);
Route::get('getcnn', [NewsController::class, 'getCnnNews']);
Route::get('detdetik', [NewsController::class, 'getDetikNews_']);
Route::get('readnews/{link}/{source}', [NewsController::class, 'readNews']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});