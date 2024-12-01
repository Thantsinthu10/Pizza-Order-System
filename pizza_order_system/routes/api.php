<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//GET
Route::get('category/list',[RouteController::class,'categoryList']);
Route::get('category/details/{id}',[RouteController::class,'detailsCategory']);
Route::get('product/list',[RouteController::class,'productList']);
Route::get('user/list',[RouteController::class,'userList']);
Route::get('order/list',[RouteController::class,'orderList']);


//POST
Route::post('category/create',[RouteController::class,'categoryCreate']);
Route::post('category/delete',[RouteController::class,'deleteCategory']);
Route::post('category/update',[RouteController::class,'categoryUpdate']);
Route::post('contact/create',[RouteController::class,'contactCreate']);


/*
*
*
*product list
*localhost:8000/api/product/list(GET)
*
*
*category list
*localhost:8000/api/category/list(GET)
*
*create category
*localhost:8000/api/category/create(POST)
*body{
*      name : ''
*    }
*
*localhost:8000/api/category/delete(POST)
*
*localhost:8000/api/category/details/{id}  (GET)
*
*localhost:8000/api/category/update (POST)
*key=> category_name , category_id
*
*create contact
*localhost:8000/api/contact/create(POST)
*
*
*user list
*localhost:8000/api/user/list(GET)
*
*order list
*localhost:8000/api/order/list(GET)
*
*/

