<?php

use App\Http\Controllers\PreviousSolutionsController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\TestController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['checkauth']], function (){

});


Route::post('/save_solution', [PreviousSolutionsController::class, 'saveSolution'])->name('save_solution');
Route::post('/set_solution_result', [PreviousSolutionsController::class, 'setSolutionResult'])->name('set_solution_result');


Route::get('/test', [TestController::class, 'test']);

Route::get('/tasks/{id}', [TasksController::class, 'getTests']);
