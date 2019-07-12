<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//
//Route::get('/', function () {
//    return view('tasks');
//});

Route::get('/', "FrontEnd\HomeController@index");



Auth::routes();
Route::get('/welcome', 'FrontEnd\HomeController@welcome')->name('welcome');
Route::get('/login', 'FrontEnd\HomeController@login')->name('login');
Route::get('/home', 'FrontEnd\HomeController@index')->name('home');
Route::get('/profile', 'FrontEnd\ProfileController@index')->name('profile');

Route::get('/user/myprofile','UserController@myprofile')->name("user/myprofile");
Route::post('/user/update','UserController@updateuser')->name("user/update");

Route::get('group/list',"GroupController@list")->name('group.list');
Route::get('group/form',"GroupController@form")->name('group.form');
Route::post('group/save',"GroupController@save")->name('group.save');
Route::get('group/edit/{group_id}',"GroupController@edit")->name('group.edit');
Route::post('group/update',"GroupController@update")->name('group.update');
Route::get('group/removeMember/{group_id}/{user_id}',"GroupController@removeMember")->name('group.removeMember');
Route::get('group/addMember/{group_id}/{user_id}',"GroupController@addMember")->name('group.addMember');

//Route::get('group/delete/{award_id}',"AwardController@delete")->name('award/delete');



Route::get('task/list',"TaskController@list")->name('task/list');
Route::get('task/form',"TaskController@form")->name('task/form');
Route::post('task/save',"TaskController@save")->name('task/save');
Route::get('task/delete/{task_id}',"TaskController@delete")->name('task/delete');
Route::get('task/pick/{task_id}',"TaskController@pick")->name('task/pick');
Route::get('task/edit/{task_id}',"TaskController@edit")->name('task.edit');
Route::post('task/update',"TaskController@update")->name('task.update');
Route::get('task/assign/{task_id}',"TaskController@assign")->name('task.assign');
Route::post('task/doAssign',"TaskController@doAssign")->name('task.doAssign');



Route::get('award/list',"AwardController@list")->name('award/list');
Route::get('award/form',"AwardController@form")->name('award/form');
Route::post('award/save',"AwardController@save")->name('award/save');
Route::get('award/delete/{award_id}',"AwardController@delete")->name('award/delete');
Route::get('award/edit/{award_id}',"AwardController@edit")->name('award.edit');
Route::post('award/update',"AwardController@update")->name('award.update');



Route::get('request/form/{aid}',"RequestController@form")->name('request.form');
Route::post('request/save', "RequestController@save")->name('request.save');
Route::get('request/list/user',"RequestController@list_user")->name('request.list.user');
Route::get('request/list/audit',"RequestController@list_audit")->name('request.list.audit');
Route::get('request/delete/{id}',"RequestController@delete")->name('request.delete');
Route::get('request/audit/{rid}/{c}',"RequestController@audit")->name('request.audit');



Route::get('assignment/list',"AssignmentController@list")->name('assignment.list');
Route::get('assignment/acknowledge/{aid}/{c}',"AssignmentController@acknowledge")->name('assignment.acknowledge');

Route::get('assignment/schedule/{id}',"AssignmentController@schedule")->name('assignment.schedule');

Route::post('util/upload',"UtilController@upload")->name('util.upload');






Route::get("test",function (){
   return view("frontend/home");
})->name('test');
