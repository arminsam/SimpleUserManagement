<?php
/* Dashboard route */
Route::get('/', ['uses' => 'DashboardController@index', 'as' => 'dashboard.index', 'before'=> 'auth']);

/* Auth related routes */
Route::get('login', ['uses' => 'AuthController@indexLogin', 'as' => 'login.index', 'before'=> 'guest']);
Route::post('login', ['uses' => 'AuthController@login', 'as' => 'login', 'before'=> 'guest']);
Route::get('logout', ['uses' => 'AuthController@indexLogout', 'as' => 'logout.index', 'before'=> 'auth']);
Route::get('password/forgot', ['uses' => 'RemindersController@indexForgotPassword', 'as' => 'forgot.password.index', 'before'=> 'guest']);
Route::post('password/forgot', ['uses' => 'RemindersController@forgotPassword', 'as' => 'forgot.password', 'before'=> 'guest']);
Route::get('password/reset/{hash}', ['uses' => 'RemindersController@indexResetPassword', 'as' => 'reset.password.index', 'before'=> 'guest']);
Route::post('password/reset/{hash}', ['uses' => 'RemindersController@resetPassword', 'as' => 'reset.password', 'before'=> 'guest']);

/* User related routes */
Route::match(['get', 'post'], 'users', ['uses' => 'UserController@index', 'as' => 'user.index', 'before'=> 'auth']);
Route::get('users/create', ['uses' => 'UserController@create', 'as' => 'user.create', 'before'=> 'auth']);
Route::post('users/create', ['uses' => 'UserController@store', 'as' => 'user.store', 'before'=> 'auth']);
Route::get('users/{userId}/update', ['uses' => 'UserController@edit', 'as' => 'user.edit', 'before'=> 'auth']);
Route::post('users/{userId}/update', ['uses' => 'UserController@update', 'as' => 'user.update', 'before'=> 'auth']);
Route::get('users/{userId}/delete', ['uses' => 'UserController@destroy', 'as' => 'user.destroy', 'before'=> 'auth']);
Route::get('users/{userId}/restore', ['uses' => 'UserController@restore', 'as' => 'user.restore', 'before'=> 'auth']);
Route::get('users/delete', ['uses' => 'UserController@destroyMultiple', 'as' => 'user.destroy.multiple', 'before'=> 'auth']);
Route::get('users/{userId}/password/update', ['uses' => 'UserController@editPassword', 'as' => 'user.edit.password', 'before'=> 'auth']);
Route::post('users/{userId}/password/update', ['uses' => 'UserController@updatePassword', 'as' => 'user.update.password', 'before'=> 'auth']);
Route::get('users/{userId}', ['uses' => 'UserController@show', 'as' => 'user.show', 'before'=> 'auth']);

/* Role related routes */
Route::match(['get', 'post'], 'roles', ['uses' => 'RoleController@index', 'as' => 'role.index', 'before'=> 'auth']);
Route::match(['get', 'post'], 'roles/{roleId}/users', ['uses' => 'RoleController@indexUsers', 'as' => 'role.user.index', 'before'=> 'auth']);
Route::get('roles/create', ['uses' => 'RoleController@create', 'as' => 'role.create', 'before'=> 'auth']);
Route::post('roles/create', ['uses' => 'RoleController@store', 'as' => 'role.store', 'before'=> 'auth']);
Route::get('roles/{roleId}/update', ['uses' => 'RoleController@edit', 'as' => 'role.edit', 'before'=> 'auth']);
Route::post('roles/{roleId}/update', ['uses' => 'RoleController@update', 'as' => 'role.update', 'before'=> 'auth']);
Route::get('roles/{roleId}/delete', ['uses' => 'RoleController@destroy', 'as' => 'role.destroy', 'before'=> 'auth']);
Route::get('roles/delete', ['uses' => 'RoleController@destroyMultiple', 'as' => 'role.destroy.multiple', 'before'=> 'auth']);
Route::get('roles/{roleId}', ['uses' => 'RoleController@show', 'as' => 'role.show', 'before'=> 'auth']);