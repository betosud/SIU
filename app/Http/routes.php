<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(['middleware'=>'auth'],function (){
        Route::resource('task','TaskController');
});

Route::get('/',['uses'=>'HomeController@index','as'=>'/']);
Route::get('/home',['uses'=>'HomeController@index','as'=>'/home']);


//authenticathe
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', ['uses' => 'Auth\AuthController@postLogin', 'as' =>'auth/login']);
Route::get('auth/logout', ['uses' => 'Auth\AuthController@getLogout', 'as' => 'auth/logout','middleware'=>'auth']);


// Password reset link request routes...
Route::get('password/email',['uses'=>'Auth\PasswordController@getEmail','as'=>'password/email'] );
Route::post('password/email',['uses'=>'Auth\PasswordController@postEmail','as'=>'password/email']);

// Password reset routes...
Route::get('password/reset/{token}',['uses'=>'Auth\PasswordController@getReset', 'as'=>'/password/reset/{token}'] );
Route::post('password/reset',['uses'=>'Auth\PasswordController@postReset','as'=>'/password/reset'] );



//usarios
Route::get('usuarios',['uses'=>'UserController@Index','as'=>'usuarios','middleware'=>'auth','middleware' => 'role:admin']);
Route::get('nuevousuario',['uses'=>'UserController@create','as'=>'nuevousuario','middleware'=>'auth','middleware' => 'role:admin']);
Route::post('guardarusuario',['uses'=>'UserController@Store','as'=>'guardarusuario','middleware'=>'auth','middleware' => 'role:admin']);
Route::get('editarusuario/{userid}/edit', ['uses' => 'UserController@edit', 'as' => 'editarusuario','middleware'=>'auth','middleware' => 'role:admin']);
Route::put('actualizarusuario/{userid}', ['uses' => 'UserController@update', 'as' => 'actualizarusuario', 'middleware'=>'auth','middleware' => 'role:admin']);
Route::delete('eliminarusuario/{userid}',['uses'=>'UserController@Destroy','as'=>'eliminarusuario','middleware'=>'auth','middleware' => 'role:admin']);
Route::get('activarusuario/{userid}', ['uses' => 'UserController@restore', 'as' => 'activarusuario','middleware'=>'auth','middleware' => 'role:admin']);

Route::get('permisos/{userid}', ['uses' => 'UserController@permisos', 'as' => 'permisos','middleware'=>'auth','middleware' => 'role:admin']);





//permisos
Route::put('cambiarpermiso', ['uses' => 'UserController@cambiarpermiso', 'as' => 'cambiarpermiso','middleware'=>'auth','middleware' => 'role:admin']);

Route::auth();

//Route::get('/home', 'HomeController@index');

Route::get('asignaciones', ['uses' => 'AsignacionesController@index', 'as' => 'asignaciones','middleware'=>'auth','middleware' => 'permission:view.asignacion|add.asignacion']);
Route::get('nuevaasignacion', ['uses' => 'AsignacionesController@create', 'as' => 'nuevaasignacion','middleware'=>'auth','middleware' => 'permission:add.asignacion']);
Route::post('guardarasignacion',['uses'=>'AsignacionesController@store','as'=>'guardarasignacion','middleware'=>'auth','middleware' => 'permission:add.asignacion']);
Route::get('editarasignacion/{id}/edit', ['uses' => 'AsignacionesController@edit', 'as' => 'editarasignacion','middleware'=>'auth','middleware' => 'permission:edit.asignacion']);
Route::get('asignacion/{id}/show', ['uses' => 'AsignacionesController@show', 'as' => 'asignacion','middleware'=>'auth']);
Route::put('actualizarasignacionstatus/{id}', ['uses' => 'AsignacionesController@updatestatus', 'as' => 'actualizarasignacionstatus', 'middleware'=>'auth']);
Route::put('actualizarasignacion/{id}', ['uses' => 'AsignacionesController@update', 'as' => 'actualizarasignacion', 'middleware'=>'auth','middleware' => 'permission:edit.asignacion']);
Route::get('pdfasignacion/{id}/{evento}', ['uses' => 'AsignacionesController@pdf', 'as' => 'pdfasignacion']);


//enviar correo
Route::put('enviarcorreo/{id}/{modulo}',['uses'=>'EnviarCorreoController@enviarcorreo','as'=>'enviarcorreo','middleware'=>'auth']);


//autocompletar lideres
Route::get('lideres/{valor}',['uses'=>'LideresController@getautocompletarlider', 'as'=>'lideres']);