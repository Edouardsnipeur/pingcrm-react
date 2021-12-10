<?php

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Http\Resources\PhotoCollection;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Cette route permettra d'avoir une pagination sur les photos d'une secteur et d'une categorie specifique
Route::namespace('Api')->group(function () { 
    Route::middleware('api')->get('photos/{secteur_slug}/{category_slug}')->uses('PhotoController@photoSecteurCategory');
});