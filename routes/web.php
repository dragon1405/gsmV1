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

Route::get('/', function () {
	return view('welcome');
});
Auth::routes([
  'register' => false, // Registration Routes...
  'reset'=>false, // Password Reset Routes...
  'verify' => false, // Email Verification Routes...
]);

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function(){


	///***********CREAR PERMISOS DE DEPARTAMENTO Y DE TIME ***
	//TimeSheet
	Route::get('times', 'TimeController@index')->name('times.index')->middleware('can:times.index');
	Route::get('times/list', 'TimeController@list')->name('times.list');
	Route::get('times/listR', 'TimeController@listR')->name('times.listR');

	Route::get('times/listAll', 'TimeController@listAll')->name('times.listAll');

	Route::get('times/times/reportT', 'TimeController@reportT')->name('times.reportT');

	Route::post('times/store', 'TimeController@store')->name('times.store')->middleware('can:times.create');
	Route::delete('times/destroy/{time}', 'TimeController@destroy')->name('times.destroy')->middleware('can:times.destroy');

	//Buscador
	Route::get('times/search', 'TimeController@search')->name('times.search');
	//PDF
	Route::get('times/Rpdf', 'TimeController@Rpdf')->name('times.Rpdf');
	//Excel
	Route::get('times/Rexcel', 'TimeController@Rexcel')->name('times.Rexcel');



	//Roles
	Route::post('roles/store', 'RoleController@store')->name('roles.store')->middleware('can:roles.create');
	Route::get('roles/create', 'RoleController@create')->name('roles.create')->middleware('can:roles.create');
	Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit')->middleware('can:roles.edit');
	Route::put('roles/{role}', 'RoleController@update')->name('roles.update')->middleware('can:roles.edit');
	Route::get('roles', 'RoleController@index')->name('roles.index')->middleware('can:roles.index');
	Route::get('roles/{role}', 'RoleController@show')->name('roles.show')->middleware('can:roles.show');
	Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy')->middleware('can:roles.destroy');

	//Proyectos
	Route::get('projects', 'ProjectController@index')->name('projects.index')->middleware('can:projects.index');
	Route::get('projects/list', 'ProjectController@list')->name('projects.list');

	//Route::get('projects/listnameM', 'ProjectController@listnameM')->name('projects.listnameM');

	Route::post('projects/store', 'ProjectController@store')->name('projects.store')->middleware('can:projects.create');
	Route::delete('projects/destroy/{project}', 'ProjectController@destroy')->name('projects.destroy')->middleware('can:projects.destroy');
	Route::get('projects/create', 'ProjectController@create')->name('projects.create')->middleware('can:projects.create');
	Route::get('projects/{role}/edit', 'ProjectController@edit')->name('projects.edit')->middleware('can:projects.edit');
	Route::put('projects/{role}', 'ProjectController@update')->name('projects.update')->middleware('can:projects.edit');
	Route::get('projects/{role}', 'ProjectController@show')->name('projects.show')->middleware('can:projects.show');

/*
	Route::get("empresas/list", "EmpresaController@list");
	Route::get("empresas", "EmpresaController@index")->name('empresas.index');
	Route::post("empresas/store", "EmpresaController@store")->name('empresas.store');
	Route::delete("empresas/destroy/{empresa}", "EmpresaController@destroy")->name('empresas.destroy');
	Route::put("empresas/update/{empresa}", "EmpresaController@update")->name('empresas.update');
*/
	//usuarios
	Route::get('users', 'UserController@index')->name('users.index')->middleware('can:users.index');
	Route::get('users/list', "UserController@list")->name('users.list');
	Route::post('users/store', 'UserController@store')->name('users.store')->middleware('can:users.create');
	Route::get('users/listD', "UserController@listD")->name('users.listD');



	Route::get('users/create', 'UserController@create')->name('users.create')->middleware('can:users.create');
	Route::get('users/{role}/edit', 'UserController@edit')->name('users.edit')->middleware('can:users.edit');
	Route::put('users/{role}', 'UserController@update')->name('users.update')->middleware('can:users.edit');
	Route::get('users/{role}', 'UserController@show')->name('users.show')->middleware('can:users.show');
	Route::delete('users/{role}', 'UserController@destroy')->name('users.destroy')->middleware('can:users.destroy');
/*
	Route::get("usuarios", "UserController@index")->name('usuarios.index');
	Route::get("usuarios/list", "UserController@list")->name('usuarios.list');
	Route::post("usuarios/store", "UserController@store")->name('usuarios.store');
	Route::delete("usuarios/destroy/{usuario}", "UserController@destroy")->name('usuarios.destroy');
	Route::put("usuarios/update/{usuario}", "UserController@update")->name('usuarios.update');
	*/

	//Departamentos

	////&&&& crear permisos de departamento

	Route::get('departments', 'DepartmentController@index')->name('departments.index')->middleware('can:departments.index');
	Route::get('departments/list', 'DepartmentController@list')->name('departments.list');
	Route::post('departments/store', 'DepartmentController@store')->name('departments.store')->middleware('can:departments.create');
	Route::delete("departments/destroy/{department}", "DepartmentController@destroy")->name('departments.destroy')->middleware('can:departments.destroy');



});
