<?php

namespace SIU\Http\Controllers;

use Bican\Roles\Models\Permission;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use SIU\barrios;
use SIU\catalogos;
use SIU\estacas;
use SIU\Http\Requests;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

use SIU\roles;
use SIU\User;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $usuarios = User::withTrashed()->paginate(10);


        if($request->ajax()){
            return response()->json(view('layouts.usuario',compact('usuarios'))->render());
        }





        return view('auth.users',compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $combos['estacas']= estacas::orderBy('nombre')->lists('nombre','id');
        $combos['barrios']= barrios::orderBy('nombreunidad')->lists('nombreunidad','id');
        $combos['llamamiento']= catalogos::where('combo','llamamiento')->orderby('nombre')->lists('nombre','id');
        $combos['perfil']=roles::orderby('name')->lists('name','id');

        return view('auth.nuevousuario',compact('combos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=array('idestaca'=>'required',
            'idbarrio'=>'required',
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'password'=>'required|min:6',
            'llamamiento'=>'required',
            'perfil'=>'required');
        $this->validate($request,$rules);
        $request['name']=Str::title($request['name']);

        $usuario= User::create ($request->all());

//dd($request->perfil);

        $resp=$usuario->save();
        //guardar rol
        $usuario->attachRole($request->perfil);


        if($resp) {
            $response = Password::sendResetLink($request->only('email'), function (Message $message) {
                $message->subject("Bienvenido a SIU");
            });



            switch ($response) {
                case  Password::RESET_LINK_SENT: {
                    \Session::flash('message', 'Se registro al usuario ' . $request['name']);
                    return \Redirect::route('usuarios');
                }
                case Password::INVALID_USER: {
                    return redirect()->back()->withErrors(['email' => trans($response)]);
                }
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $combos['estacas']=estacas::lists('nombre','id');
        $combos['barrios']=barrios::lists('nombreunidad','id');
        $combos['llamamiento']=catalogos::where('combo','llamamiento')->orderby('nombre')->lists('nombre','id');
        $combos['perfil']= roles::orderby('name')->lists('name','id');
        $usuario=User::withTrashed()->where('id', '=', $id)->first();

        return view('auth.editar',compact('usuario','combos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules=array('idestaca'=>'required',
            'idbarrio'=>'required',
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$id,
//            'password'=>'required|min:6',
            'llamamiento'=>'required',
            'perfil'=>'required');
        $this->validate($request,$rules);



        $user=User::withTrashed()->where('id', '=', $id)->first();
        $request['name']=Str::title($request['name']);
        $user->fill($request->all());
        $user->save();

        $user->detachAllRoles();

        $user->attachRole($request->perfil);


        \Session::flash('message','Registro Guardado Correctamente');
        return redirect()->route('usuarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user= User::FindorFail($id);

        $user->delete();
        \Session::flash('message','Se Borro al Usuario '.$user->name);

        return redirect()->route('usuarios');
    }
    public function restore($id)
    {
        //
        $user=User::withTrashed()->where('id', '=', $id)->first();

        $user->restore($id);
        \Session::flash('message','Se activo al Usuario '.$user->name);

        return redirect()->route('usuarios');
    }

    public function permisos($id)
    {
        //
        $usuario=User::withTrashed()->where('id', $id)->first();

//dd($usuario);
        $permisos=Permission::query('select * from permissions order by model')->paginate(10);
//        dd($permisos);

        return view('auth.permisos',compact('usuario','permisos'));

    }


    public function cambiarpermiso(Request $request)
    {


        $user=User::findorfail($request->usuario);
//        dd($user);

//        dd($request->permiso);
        if($request->evento=='quitar'){
            $user->detachPermission($request->permiso);
        }
        elseif($request->evento=='agregar'){
            $user->attachPermission($request->permiso);
        }

        $error="";
        $mensaje="";


        return response()->json([
            'error'=>$error,'mensaje'=>$mensaje
        ]);

    }
}
