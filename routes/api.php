<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//API GET
//Route::get('ordersystem/list',[RouteController::class,'ordersystemList']);
Route::get('product/list',[RouteController::class,'productList']);
Route::get('category/list',[RouteController::class,'categoryList']); //read

//create
Route::post('create/category',[RouteController::class,'categoryCreate']);
Route::post('create/contact',[RouteController::class,'createContact']); //create

//delete
Route::get('category/delete/{id}',[RouteController::class,'deleteCategory']); //delete

Route::get('category/list/{id}',[RouteController::class,'categoryDetails']); //read

Route::post('category/update',[RouteController::class,'categoryUpdate']); //update
/*
*   api for product lis
*   localhost:8000/api/product/list(GET)

*   api for category list
*   localhost:8000/api/category/list(GET)

*   create category
*   localhost:8000/api/create/category (POST)
*   body { at postman
    name : ''
}
*/
