<?php

use App\Http\Controllers\Productscontroller;
use App\Models\Products;
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
use App\Http\Controllers\AuthController;
use App\Http\Controllers\categoriecontroller;
use App\Http\Controllers\commandecontroller;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\fileController;
use App\Http\Controllers\paniercontroller;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::group(['middleware'=>['auth:sanctum']], function () {
Route::post('/logout', [AuthController::class, 'logout']);

});
Route::get('Products',[ProductsController::class,'getProducts']);

Route::get('Product/{id}',[ProductsController::class,'getProductByid']);
Route::post('Addproduct',[ProductsController::class,'Addproduct']);
Route::post('updateProduct/{id}',[ProductsController::class,'UpdateProduct']);
Route::delete('delete/{id}',[ProductsController::class,'delete']);
Route::get('Products/search/{name}',[ProductsController::class,'search']);



Route::get('categories',[categoriecontroller::class,'getcategories']);
Route::get('productde/{id}',[Productscontroller::class,'getProductsbycategorie']);
Route::get('categories/{id}',[categoriecontroller::class,'getcategoriesByid']);
Route::post('Addcategories',[categoriecontroller::class,'Addcategories']);
Route::put('updatecategories/{id}',[categoriecontroller::class,'Updatecategories']);
Route::delete('deletecategories/{id}',[categoriecontroller::class,'deletecategories']);


Route::post('AddFile',[fileController::class,'AddFile']);

Route::post('AddComment/{id}',[CommentaireController::class,'StoreReview'])->middleware('auth:sanctum');
Route::get('Comments/{id}',[CommentaireController::class,'getComments']);

Route::delete('deletepanier/{id}',[paniercontroller::class,'deletecart']);
Route::delete('deleteallpanier/{id}',[paniercontroller::class,'deleteall']);
Route::post('addtopanier',[paniercontroller::class,'addcart']);
Route::get('listepanier/{id}',[paniercontroller::class,'showcart']);


Route::get('showcommande/{id}',[commandecontroller::class,'showcommande']);
Route::post('addcommande',[commandecontroller::class,'addcommande']);

