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


route :: group(['prefix'=>'v1'],function(){
    //api/v1/users
    route::post('/users',[app\http\controllers\usercontroller::class,'register']);
    route::post('/users/login',[app\http\controllers\usercontroller::class,'login']);
});
