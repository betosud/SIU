<?php

namespace SIU\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use SIU\catalogos;
use SIU\Http\Requests;

use SIU\Http\Controllers\Controller;
use SIU\lideres;

class LideresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lideres=lideres::bybarrio(Auth::user()->idbarrio)->orderby('nombre')->Paginate(10);

        if($request->ajax()){
            return response()->json(view('layouts.lider',compact('lideres'))->render());
        }
        else {
            return view('lideres.lideres', compact('lideres'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $llamamientos=catalogos::bycatalogo('llamamiento')->orderby('nombre')->lists('nombre','id');
        $organizacion=catalogos::bycatalogo('organizacion')->orderby('nombre')->lists('nombre','id');
        $combo['llamamientos']=$llamamientos;
        $combo['organizacion']=$organizacion;
        return view('lideres.nuevo',compact('combo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=array('idbarrio'=>'required',
            'nombre'=>'required',
            'email'=>'email',
            'phone'=>'digits:10',
            'llamamiento'=>'required',
            'organizacion'=>'required');

        $this->validate($request,$rules);

        $lider=new lideres($request->all());
        $lider->save();

        \Session::flash('message','Registro Guardado Correctamente');
        return \Redirect::route('lideres');
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
        $combo['llamamientos']=catalogos::bycatalogo('llamamiento')->orderby('nombre')->lists('nombre','id');
        $combo['organizacion']=catalogos::bycatalogo('organizacion')->orderby('nombre')->lists('nombre','id');


        $lider=$lideres=lideres::findorfail($id);

        return view('lideres.editar',compact('lider','combo'));
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
        $rules=array('idbarrio'=>'required',
            'nombre'=>'required',
            'llamamiento'=>'required',
            'phone'=>'digits:10',
            'organizacion'=>'required');
        $this->validate($request,$rules);
        //
        $lider=lideres::findorfail($id);

        if($request->organizacion==$lider->organizacion) {
            $lider->fill($request->all());
            $lider->save();
            \Session::flash('message','Registro Guardado Correctamente');
        }
        else
        {
            $lider->delete();
            $lidernuevo=new lideres($request->all());
            $lidernuevo->save();
            \Session::flash('message','Se ha creado un nuevo Registro');
        }


        return redirect()->route('lideres');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lider=lideres::withTrashed()->findorfail($id);
        $lider->delete();
        \Session::flash('message','El Lider '.$lider->nombre." se borro correctamente");
        return redirect()->route('lideres');
    }
}
