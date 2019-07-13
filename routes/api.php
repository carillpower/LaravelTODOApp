<?php

use Illuminate\Http\Request;

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

//Shahril //
//Make sure /opt/Laravel_TODO_App/LaravelTODOApp/app/Http/Controllers/TaskController.php exists
//When URL http://10.124.12.131/api/tasks will go to TaskController.php -> function index()
Route::resource('/tasks', 'TaskController', [

  'except' => ['edit', 'show']

]);

