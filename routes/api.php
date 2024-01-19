<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


use App\Http\Controllers\Api\AttributeController;
use App\Http\Controllers\Api\BranchController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CartItemController;
use App\Http\Controllers\Api\CategoryAttributeController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CmsController;
use App\Http\Controllers\Api\CmsTypeController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ContactDetailController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\ExpenseTypeController;

use App\Http\Controllers\Api\ImageController;

use App\Http\Controllers\Api\OperationController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderItemController;
use App\Http\Controllers\Api\ProductAttributeController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductLoadController;
use App\Http\Controllers\Api\ProductTypeController;
use App\Http\Controllers\Api\ProductTypesAttributeController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\RoleOperationController;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserRoleController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'attribute'], function (){
    Route::get('/', [AttributeController::class, 'index']);
    Route::get('/data', [AttributeController::class, 'data']);
    Route::post('/', [AttributeController::class, 'store']);
    Route::put('/{id}', [AttributeController::class, 'update']);
    Route::delete('/{id}', [AttributeController::class, 'destroy']);
});
Route::group(['prefix'=>'branch'], function (){
    Route::get('/', [BranchController::class, 'index']);
    Route::get('/data', [BranchController::class, 'data']);
    Route::post('/', [BranchController::class, 'store']);
    Route::put('/{id}', [BranchController::class, 'update']);
    Route::delete('/{id}', [BranchController::class, 'destroy']);
});
Route::group(['prefix'=>'brand'], function (){
    Route::get('/', [BrandController::class, 'index']);
    Route::get('/data', [BrandController::class, 'data']);
    Route::post('/', [BrandController::class, 'store']);
    Route::put('/{id}', [BrandController::class, 'update']);
    Route::delete('/{id}', [BrandController::class, 'destroy']);
});
Route::group(['prefix'=>'cart'], function (){
    Route::get('/', [CartController::class, 'index']);
    Route::get('/data', [CartController::class, 'data']);
    Route::post('/', [CartController::class, 'store']);
    Route::put('/{id}', [CartController::class, 'update']);
    Route::delete('/{id}', [CartController::class, 'destroy']);
});
Route::group(['prefix'=>'cart-item'], function (){
    Route::get('/', [CartItemController::class, 'index']);
    Route::get('/data', [CartItemController::class, 'data']);
    Route::post('/', [CartItemController::class, 'store']);
    Route::put('/{id}', [CartItemController::class, 'update']);
    Route::delete('/{id}', [CartItemController::class, 'destroy']);
});
Route::group(['prefix'=>'category-attribute'], function (){
    Route::get('/', [CategoryAttributeController::class, 'index']);
    Route::get('/data', [CategoryAttributeController::class, 'data']);
    Route::post('/', [CategoryAttributeController::class, 'store']);
    Route::put('/{id}', [CategoryAttributeController::class, 'update']);
    Route::delete('/{id}', [CategoryAttributeController::class, 'destroy']);
});
Route::group(['prefix'=>'category'], function (){
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/data', [CategoryController::class, 'data']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::put('/{id}', [CategoryController::class, 'update']);
    Route::delete('/{id}', [CategoryController::class, 'destroy']);
});
Route::group(['prefix'=>'cms'], function (){
    Route::get('/', [CmsController::class, 'index']);
    Route::get('/data', [CmsController::class, 'data']);
    Route::post('/', [CmsController::class, 'store']);
    Route::put('/{id}', [CmsController::class, 'update']);
    Route::delete('/{id}', [CmsController::class, 'destroy']);
});
Route::group(['prefix'=>'cms-type'], function (){
    Route::get('/', [CmsTypeController::class, 'index']);
    Route::get('/data', [CmsTypeController::class, 'data']);
    Route::post('/', [CmsTypeController::class, 'store']);
    Route::put('/{id}', [CmsTypeController::class, 'update']);
    Route::delete('/{id}', [CmsTypeController::class, 'destroy']);
});
Route::group(['prefix'=>'contact'], function (){
    Route::get('/', [ContactController::class, 'index']);
    Route::get('/data', [ContactController::class, 'data']);
    Route::post('/', [ContactController::class, 'store']);
    Route::put('/{id}', [ContactController::class, 'update']);
    Route::delete('/{id}', [ContactController::class, 'destroy']);
});
Route::group(['prefix'=>'contact-detail'], function (){
    Route::get('/', [ContactDetailController::class, 'index']);
    Route::get('/data', [ContactDetailController::class, 'data']);
    Route::post('/', [ContactDetailController::class, 'store']);
    Route::put('/{id}', [ContactDetailController::class, 'update']);
    Route::delete('/{id}', [ContactDetailController::class, 'destroy']);
});
Route::group(['prefix'=>'contact-us'], function (){
    Route::get('/', [ContactUsController::class, 'index']);
    Route::get('/data', [ContactUsController::class, 'data']);
    Route::post('/', [ContactUsController::class, 'store']);
    Route::put('/{id}', [ContactUsController::class, 'update']);
    Route::delete('/{id}', [ContactUsController::class, 'destroy']);
});
Route::group(['prefix'=>'expense'], function (){
    Route::get('/', [ExpenseController::class, 'index']);
    Route::get('/data', [ExpenseController::class, 'data']);
    Route::post('/', [ExpenseController::class, 'store']);
    Route::put('/{id}', [ExpenseController::class, 'update']);
    Route::delete('/{id}', [ExpenseController::class, 'destroy']);
});
Route::group(['prefix'=>'expense-type'], function (){
    Route::get('/', [ExpenseTypeController::class, 'index']);
    Route::get('/data', [ExpenseTypeController::class, 'data']);
    Route::post('/', [ExpenseTypeController::class, 'store']);
    Route::put('/{id}', [ExpenseTypeController::class, 'update']);
    Route::delete('/{id}', [ExpenseTypeController::class, 'destroy']);
});

Route::group(['prefix'=>'image'], function (){
    Route::get('/', [ImageController::class, 'index']);
    Route::get('/data', [ImageController::class, 'data']);
    Route::post('/', [ImageController::class, 'store']);
    Route::put('/{id}', [ImageController::class, 'update']);
    Route::delete('/{id}', [ImageController::class, 'destroy']);
});

Route::group(['prefix'=>'operation'], function (){
    Route::get('/', [OperationController::class, 'index']);
    Route::get('/data', [OperationController::class, 'data']);
    Route::post('/', [OperationController::class, 'store']);
    Route::put('/{id}', [OperationController::class, 'update']);
    Route::delete('/{id}', [OperationController::class, 'destroy']);
});
Route::group(['prefix'=>'order'], function (){
    Route::get('/', [OrderController::class, 'index']);
    Route::get('/data', [OrderController::class, 'data']);
    Route::post('/', [OrderController::class, 'store']);
    Route::put('/{id}', [OrderController::class, 'update']);
    Route::delete('/{id}', [OrderController::class, 'destroy']);
});
Route::group(['prefix'=>'order-item'], function (){
    Route::get('/', [OrderItemController::class, 'index']);
    Route::get('/data', [OrderItemController::class, 'data']);
    Route::post('/', [OrderItemController::class, 'store']);
    Route::put('/{id}', [OrderItemController::class, 'update']);
    Route::delete('/{id}', [OrderItemController::class, 'destroy']);
});
Route::group(['prefix'=>'product-attribute'], function (){
    Route::get('/', [ProductAttributeController::class, 'index']);
    Route::get('/data', [ProductAttributeController::class, 'data']);
    Route::post('/', [ProductAttributeController::class, 'store']);
    Route::put('/{id}', [ProductAttributeController::class, 'update']);
    Route::delete('/{id}', [ProductAttributeController::class, 'destroy']);
});
Route::group(['prefix'=>'product'], function (){
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/data', [ProductController::class, 'data']);
    Route::post('/', [ProductController::class, 'store']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});
Route::group(['prefix'=>'product-load'], function (){
    Route::get('/', [ProductLoadController::class, 'index']);
    Route::get('/data', [ProductLoadController::class, 'data']);
    Route::post('/', [ProductLoadController::class, 'store']);
    Route::put('/{id}', [ProductLoadController::class, 'update']);
    Route::delete('/{id}', [ProductLoadController::class, 'destroy']);
});
Route::group(['prefix'=>'product-type'], function (){
    Route::get('/', [ProductTypeController::class, 'index']);
    Route::get('/data', [ProductTypeController::class, 'data']);
    Route::post('/', [ProductTypeController::class, 'store']);
    Route::put('/{id}', [ProductTypeController::class, 'update']);
    Route::delete('/{id}', [ProductTypeController::class, 'destroy']);
});
Route::group(['prefix'=>'product-types-attribute'], function (){
    Route::get('/', [ProductTypesAttributeController::class, 'index']);
    Route::get('/data', [ProductTypesAttributeController::class, 'data']);
    Route::post('/', [ProductTypesAttributeController::class, 'store']);
    Route::put('/{id}', [ProductTypesAttributeController::class, 'update']);
    Route::delete('/{id}', [ProductTypesAttributeController::class, 'destroy']);
});
Route::group(['prefix'=>'role'], function (){
    Route::get('/', [RoleController::class, 'index']);
    Route::get('/data', [RoleController::class, 'data']);
    Route::post('/', [RoleController::class, 'store']);
    Route::put('/{id}', [RoleController::class, 'update']);
    Route::delete('/{id}', [RoleController::class, 'destroy']);
});
Route::group(['prefix'=>'role-operation'], function (){
    Route::get('/', [RoleOperationController::class, 'index']);
    Route::get('/data', [RoleOperationController::class, 'data']);
    Route::post('/', [RoleOperationController::class, 'store']);
    Route::put('/{id}', [RoleOperationController::class, 'update']);
    Route::delete('/{id}', [RoleOperationController::class, 'destroy']);
});
Route::group(['prefix'=>'status'], function (){
    Route::get('/', [StatusController::class, 'index']);
    Route::get('/data', [StatusController::class, 'data']);
    Route::post('/', [StatusController::class, 'store']);
    Route::put('/{id}', [StatusController::class, 'update']);
    Route::delete('/{id}', [StatusController::class, 'destroy']);
});
Route::group(['prefix'=>'user'], function (){
    Route::get('/', [UserController::class, 'index']);
    Route::get('/data', [UserController::class, 'data']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});
Route::group(['prefix'=>'user-role'], function (){
    Route::get('/', [UserRoleController::class, 'index']);
    Route::get('/data', [UserRoleController::class, 'data']);
    Route::post('/', [UserRoleController::class, 'store']);
    Route::put('/{id}', [UserRoleController::class, 'update']);
    Route::delete('/{id}', [UserRoleController::class, 'destroy']);
});
