<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PreviousSolutionsController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/test', [TestController::class, 'test'])->name('test');

Route::get('/info', function () {
    return view('info');
})->name('info');

Route::get('/review', function () {
    return view('review');
})->name('review');


//---------------- LOGIN ----------------
// Login
Route::get('/login', function () {
    if (Auth::check()){
        return redirect()->to(route('tasks'));
    }
    return view('login.login');
})->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Register
Route::get('/register', function () {
    if (Auth::check()){
        return redirect()->to(route('tasks'));
    }
    return view('login.register');
})->name('register');
Route::post('/register', [LoginController::class, 'register']);

# Logout
Route::get('/logout', function (){
    Auth::logout();
    return redirect()->to(route('login'));
})->name('logout');
//---------------------------------------

//---------------- Tasks ----------------
Route::group(['middleware' => ['check-auth']], function (){
    // Admin
    Route::group(['middleware' => ['check-admin']], function (){
        Route::get('/cache-clear', [AdminController::class, 'cacheClear'])->name('cacheClear');
    });

    Route::controller(TasksController::class)->group(function (){
        // Задания
        Route::prefix('tasks')->group(function (){
            // Задание
            Route::get('/{id}', 'task')
                ->where('id', '[0-9]+')
                ->name('task');
            // Список заданий
            Route::get('/', 'tasksGroupList')->name('tasks');
        });

        Route::group(['middleware' => ['check-admin']], function (){
            // Редактор заданий
            Route::prefix('editor')->group(function (){
                // Главная страница редактора
                Route::get('/{task_group?}/{task_id?}', 'tasksEditor')
                    ->where('task_group', '[0-9]+')
                    ->where('task_id', '[0-9]+')
                    ->name('tasks_editor');

                // Редактировать группу
                Route::put('/tasks_groups/{id}', 'saveTasksGroup')
                    ->where('id', '[0-9]+')
                    ->name('tasks_groups');
                // Редактировать задание
                Route::post('/tasks/{id}', 'saveTasks')
                    ->where('id', '[0-9]+')
                    ->name('edit_task');
                // Новое задание
                Route::post('/tasks/new', 'newTask')->name('newTask');
                // Новая группа
                Route::post('/tasks_groups/new', 'newTasksGroup')->name('newTasksGroup');
                // Удалить задание
                Route::post('/tasks/delete/{id}', 'deleteTask')
                    ->where('id', '[0-9]+')
                    ->name('deleteTask');
                // Удалить группу
                Route::post('/tasks_groups/delete/{id}', 'deleteTasksGroup')
                    ->where('id', '[0-9]+')
                    ->name('deleteTasksGroups');
            });

            // PDF
            Route::get('/tasks/{id}/pdf', 'taskPdf')
                ->where('id', '[0-9]+')
                ->name('taskPdf');
        });
    });

    Route::controller(PreviousSolutionsController::class)->group(function (){
        // Tasks
        Route::get('/get_solution_result/{id}', 'getSolutionResult')
            ->where('id', '[0-9]+')
            ->name('get_solution_result');
        Route::post('/send_solution', 'sendSolution')->name('send_solution');
    });
});
//---------------------------------------
