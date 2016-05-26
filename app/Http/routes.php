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


//Route::get('/', function () {
//
//    return view('welcome');
//});
//
//Route::get('/home', function () {
//
//    return view('welcome');
//});

Route::get('/',['uses'=>'HomeController@index','as'=>'/']);
Route::get('/home',['uses'=>'HomeController@index','as'=>'/home']);
//capcha

Route::post('registrosolicitud', function () {
    $rules =  array('captcha' => ['required', 'captcha']);
    $validator = Validator::make([ 'captcha' => Input::get('captcha') ],
    $rules, [ 'captcha' => 'El captcha ingresado es incorrecto.' ]);
    if ($validator->passes()) {
        $request = Request::create('guardarsolicitud', 'POST', $_REQUEST);
        return Route::dispatch($request)->getContent();
    }
    else {
        return redirect()->back()->withInput($_REQUEST)->withErrors($validator);

    }
});






//sacramental
Route::get('nuevosacramental',['uses'=>'SacramentalController@create','as'=>'nuevosacramental','middleware'=>'auth']);
Route::post('guardarsacramental',['uses'=>'SacramentalController@store','as'=>'guardarsacramental']);

//api
Route::get('eventosestaca/{eventos}',['uses'=>'ApiCalendarioController@eventosestaca','as'=>'eventosestaca']);

//sit
Route::get('solicitudgasto',['uses'=>'SolicitudesController@create','as'=>'solicitudgasto']);
Route::post('guardarsolicitud',['uses'=>'SolicitudesController@store','as'=>'guardarsolicitud']);
Route::get('solicitudpdf/{id}/{evento}',['uses'=>'SolicitudesController@pdf','as'=>'solicitudpdf']);

Route::post('guardararchivo',['uses'=>'SitController@uploadfile','as'=>'guardararchivo','middleware'=>'auth']);
Route::get('sits',['uses'=>'SitController@index','as'=>'sits','middleware'=>'auth','middleware' => 'permission:add.sit|view.sit']);
Route::get('nuevosit/{id}',['uses'=>'SitController@create','as'=>'nuevosit','middleware'=>'auth','middleware' => 'permission:add.sit']);
Route::post('guardarsit',['uses'=>'SitController@store','as'=>'guardarsit','middleware'=>'auth','middleware' => 'permission:add.sit']);
Route::get('editarsit/{id}', ['uses' => 'SitController@edit', 'as' => 'editarsit','middleware'=>'auth','middleware' => 'permission:edit.sit']);
Route::put('actualizarsit/{id}', ['uses' => 'SitController@update', 'as' => 'actualizarsit','middleware'=>'auth','middleware' => 'permission:edit.sit']);

Route::get('eliminararchivosit/{id}',['uses'=>'SitController@destroyfile','as'=>'eliminararchivosit','middleware'=>'auth','middleware' => 'permission:delete.filesit']);
Route::get('barriosbyestaca/{idestaca}',['uses'=>'SolicitudesController@barrios','as'=>'barriosbyestaca']);

Route::get('pdfsit/{id}/{tipo}/{modo}', ['uses' => 'SolicitudesController@pdf', 'as' => 'pdfsit']);
Route::get('solicitud/{id}/show', ['uses' => 'SolicitudesController@show', 'as' => 'solicitud','middleware'=>'auth']);

//agregar permisos
Route::get('solicitudes',['uses'=>'SolicitudesController@index','as'=>'solicitudes','middleware'=>'auth','middleware' => 'permission:view.solicitudes|edit.solicitudes']);
Route::get('editarsolicitud/{id}', ['uses' => 'SolicitudesController@edit', 'as' => 'editarsolicitud','middleware'=>'auth','middleware' => 'permission:edit.solicitudes']);
Route::put('actualizarsolicitud/{id}', ['uses' => 'SolicitudesController@update', 'as' => 'actualizarsolicitud', 'middleware'=>'auth','middleware' => 'permission:edit.solicitudes']);




//usuarios
Route::get('usuarios',['uses'=>'UserController@Index','as'=>'usuarios','middleware'=>'auth','middleware' => 'role:admin']);
Route::get('nuevousuario',['uses'=>'UserController@create','as'=>'nuevousuario','middleware'=>'auth','middleware' => 'role:admin']);
Route::post('guardarusuario',['uses'=>'UserController@Store','as'=>'guardarusuario','middleware'=>'auth','middleware' => 'role:admin']);
Route::get('editarusuario/{userid}/edit', ['uses' => 'UserController@edit', 'as' => 'editarusuario','middleware'=>'auth','middleware' => 'role:admin']);
Route::put('actualizarusuario/{userid}', ['uses' => 'UserController@update', 'as' => 'actualizarusuario', 'middleware'=>'auth','middleware' => 'role:admin']);
Route::delete('eliminarusuario/{userid}',['uses'=>'UserController@Destroy','as'=>'eliminarusuario','middleware'=>'auth','middleware' => 'role:admin']);
Route::get('activarusuario/{userid}', ['uses' => 'UserController@restore', 'as' => 'activarusuario','middleware'=>'auth','middleware' => 'role:admin']);

Route::get('permisos/{userid}', ['uses' => 'UserController@permisos', 'as' => 'permisos','middleware'=>'auth','middleware' => 'role:admin']);


Route::put('cambiarpermiso', ['uses' => 'UserController@cambiarpermiso', 'as' => 'cambiarpermiso','middleware'=>'auth','middleware' => 'role:admin']);


//enviar correo
Route::put('enviarcorreo/{id}/{modulo}',['uses'=>'EnviarCorreoController@enviarcorreo','as'=>'enviarcorreo','middleware'=>'auth']);



//asignaciones
Route::get('asignaciones', ['uses' => 'AsignacionesController@index', 'as' => 'asignaciones','middleware'=>'auth','middleware' => 'permission:view.asignacion|add.asignacion']);
Route::get('nuevaasignacion', ['uses' => 'AsignacionesController@create', 'as' => 'nuevaasignacion','middleware'=>'auth','middleware' => 'permission:add.asignacion']);
Route::post('guardarasignacion',['uses'=>'AsignacionesController@store','as'=>'guardarasignacion','middleware'=>'auth','middleware' => 'permission:add.asignacion']);
Route::get('editarasignacion/{id}/edit', ['uses' => 'AsignacionesController@edit', 'as' => 'editarasignacion','middleware'=>'auth','middleware' => 'permission:edit.asignacion']);
Route::get('asignacion/{id}/show', ['uses' => 'AsignacionesController@show', 'as' => 'asignacion','middleware'=>'auth']);
Route::put('actualizarasignacionstatus/{id}', ['uses' => 'AsignacionesController@updatestatus', 'as' => 'actualizarasignacionstatus', 'middleware'=>'auth']);
Route::put('actualizarasignacion/{id}', ['uses' => 'AsignacionesController@update', 'as' => 'actualizarasignacion', 'middleware'=>'auth','middleware' => 'permission:edit.asignacion']);
Route::get('pdfasignacion/{id}/{evento}', ['uses' => 'AsignacionesController@pdf', 'as' => 'pdfasignacion']);


//entrevistas
Route::get('entrevistas', ['uses' => 'EntrevistasController@index', 'as' => 'entrevistas','middleware'=>'auth','middleware' => 'permission:view.entrevista|add.entrevista']);
Route::get('nuevaentrevista', ['uses' => 'EntrevistasController@create', 'as' => 'nuevaentrevista','middleware'=>'auth','middleware' => 'permission:add.entrevista']);
Route::post('guardarentrevista',['uses'=>'EntrevistasController@store','as'=>'guardarentrevista','middleware'=>'auth','middleware' => 'permission:add.entrevista']);
Route::get('editarentrevista/{id}/edit', ['uses' => 'EntrevistasController@edit', 'as' => 'editarentrevista','middleware'=>'auth','middleware' => 'permission:edit.entrevista']);
Route::get('entrevista/{id}/show', ['uses' => 'EntrevistasController@show', 'as' => 'entrevista','middleware'=>'auth']);
Route::put('actualizarentrevistastatus/{id}', ['uses' => 'EntrevistasController@updatestatus', 'as' => 'actualizarentrevistastatus', 'middleware'=>'auth']);
Route::put('actualizarentrevista/{id}', ['uses' => 'EntrevistasController@update', 'as' => 'actualizarentrevista', 'middleware'=>'auth','middleware' => 'permission:edit.entrevista']);
Route::get('pdfentrevista/{id}/{evento}', ['uses' => 'EntrevistasController@pdf', 'as' => 'pdfentrevista']);

//discursos
Route::get('discursos', ['uses' => 'DiscursosController@index', 'as' => 'discursos','middleware'=>'auth','middleware' => 'permission:view.discurso|add.discurso']);
Route::get('nuevodiscurso', ['uses' => 'DiscursosController@create', 'as' => 'nuevodiscurso','middleware'=>'auth','middleware' => 'permission:add.discurso']);
Route::post('guardardiscurso',['uses'=>'DiscursosController@store','as'=>'guardardiscurso','middleware'=>'auth','middleware' => 'permission:add.discurso']);
Route::get('editardiscurso/{id}/edit', ['uses' => 'DiscursosController@edit', 'as' => 'editardiscurso','middleware'=>'auth','middleware' => 'permission:edit.discurso']);
Route::get('discurso/{id}/show', ['uses' => 'DiscursosController@show', 'as' => 'discurso','middleware'=>'auth']);
Route::put('actualizardiscursostatus/{id}', ['uses' => 'DiscursosController@updatestatus', 'as' => 'actualizardiscursostatus', 'middleware'=>'auth']);
Route::put('actualizardiscurso/{id}', ['uses' => 'DiscursosController@update', 'as' => 'actualizardiscurso', 'middleware'=>'auth','middleware' => 'permission:edit.discurso']);
Route::get('pdfdiscurso/{id}/{evento}', ['uses' => 'DiscursosController@pdf', 'as' => 'pdfdiscurso']);



//lideres
Route::get('lideres', ['uses' => 'LideresController@index', 'as' => 'lideres','middleware'=>'auth','middleware' => 'permission:view.lider|add.lider']);
Route::get('editarlider/{id}/edit', ['uses' => 'LideresController@edit', 'as' => 'editarlider','middleware'=>'auth','middleware' => 'permission:edit.lider']);
Route::put('actualizarlider/{id}', ['uses' => 'LideresController@update', 'as' => 'actualizarlider', 'middleware'=>'auth','middleware' => 'permission:edit.lider']);
Route::delete('eliminarlider/{id}',['uses'=>'LideresController@Destroy','as'=>'eliminarlider','middleware'=>'auth','middleware' => 'permission:edit.lider']);
Route::get('nuevolider', ['uses' => 'LideresController@create', 'as' => 'nuevolider','middleware'=>'auth','middleware' => 'permission:add.lider']);
Route::post('guardarlider',['uses'=>'LideresController@store','as'=>'guardarlider','middleware'=>'auth','middleware' => 'permission:edit.lider']);


//authenticathe
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', ['uses' => 'Auth\AuthController@postLogin', 'as' =>'auth/login']);
Route::get('auth/logout', ['uses' => 'Auth\AuthController@getLogout', 'as' => 'auth/logout']);


// Password reset link request routes...
Route::get('password/email',['uses'=>'Auth\PasswordController@getEmail','as'=>'password/email'] );
Route::post('password/email',['uses'=>'Auth\PasswordController@postEmail','as'=>'password/email']);

// Password reset routes...
Route::get('password/reset/{token}',['uses'=>'Auth\PasswordController@getReset', 'as'=>'/password/reset/{token}'] );
Route::post('password/reset',['uses'=>'Auth\PasswordController@postReset','as'=>'/password/reset'] );



//indicadores
Route::get('indicadoresbarrio', ['uses' => 'IndicadoresBarriosController@indexvalores', 'as' => 'indicadoresbarrio','middleware'=>'auth','middleware' => 'permission:view.indicadores']);
Route::put('actualizaindicador/{id}', ['uses' => 'IndicadoresBarriosController@update', 'as' => 'actualizaindicador', 'middleware'=>'auth','middleware' => 'permission:edit.indicadores']);




Route::get('download', function() {
    return Response::download(Input::get('path'));
});