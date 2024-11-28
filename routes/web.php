<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Models\Position;
Route::get('/', function () {
    $positions=Position::query()->orderBy("name","asc")->get();
    return view('home',compact('positions'));
});

Route::get('/positions/{id}',function(string $id){
    $position=Position::find($id);
    $positions=Position::query()->orderBy("name","asc")->where('id','!=',$id)->get();
    return view('org_chart.show',compact('position','positions'));
});
