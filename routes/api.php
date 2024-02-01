<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;

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

Route::get('/customers', [CustomerController::class, 'list']);

Route::post('/createCustomers', [CustomerController::class, 'create']);

Route::get('/showCustomers/{id}', [CustomerController::class, 'show']);

Route::post('/updateCustomers/{id}', [CustomerController::class, 'update']);

Route::delete('/deleteCustomers/{id}', [CustomerController::class, 'delete']);


Route::get('/orders', [OrderController::class, 'list']);

Route::post('/createOrders', [OrderController::class, 'create']);

Route::get('/showOrders/{id}', [OrderController::class, 'show']);

Route::post('/updateOrders/{id}', [OrderController::class, 'update']);

Route::delete('/deleteOrders/{id}', [OrderController::class, 'delete']);


Route::get('/products', [ProductController::class, 'list']);

Route::post('/createProducts', [ProductController::class, 'create']);

Route::get('/showProducts/{id}', [ProductController::class, 'show']);

Route::post('/updateProducts/{id}', [ProductController::class, 'update']);

Route::delete('/deleteProducts/{id}', [ProductController::class, 'delete']);


Route::get('/categories', [CategoryController::class, 'list']);

Route::post('/createCategories', [CategoryController::class, 'create']);

Route::get('/showCategories/{id}', [CategoryController::class, 'show']);

Route::post('/updateCategories/{id}', [CategoryController::class, 'update']);

Route::delete('/deleteCategories/{id}', [CategoryController::class, 'delete']);


Route::get('/instructors', [InstructorController::class, 'list']);

Route::post('/createInstructors', [InstructorController::class, 'create']);

Route::get('/showInstructors/{id}', [InstructorController::class, 'show']);

Route::post('/updateInstructors/{id}', [InstructorController::class, 'update']);

Route::delete('/deleteInstructors/{id}', [InstructorController::class, 'delete']);


Route::get('/orderitems', [OrderItemController::class, 'list']);

Route::post('/createOrderItems', [OrderItemController::class, 'create']);

Route::get('/showOrderItems/{id}', [OrderItemController::class, 'show']);

Route::post('/updateOrderItems/{id}', [OrderItemController::class, 'update']);

Route::delete('/deleteOrderItems/{id}', [OrderItemController::class, 'delete']);