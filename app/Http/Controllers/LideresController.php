<?php

namespace SIU\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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
        $combos['llamamientos']=$llamamientos;
        $combos['organizacion']=$organizacion;
        return view('lideres.nuevo',compact('combos'));
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
            'llamamiento'=>'required|numeric',
            'organizacion'=>'required');

        $validacion=$this->validate($request,$rules);


        $request['nombre']=Str::title($request['nombre']);

        $lider=new lideres($request->all());
        $lider->save();


        if($request->ajax()){
            $liderselect=array('id'=>$lider->id,'nombre'=>$lider->conllamamiento);
            return response()->json([
                'error'=>$validacion,'lider'=>$liderselect
            ]);
        }
        else {
            \Session::flash('message','Registro Guardado Correctamente');
            return \Redirect::route('lideres');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function consulta($organizacion,$modo)
    {
        if($organizacion=='todos'){
            if($modo=='activos'){
                $lista =lideres::bybarrio(Auth::user()->idbarrio)->orderBy('nombre')->get();
            }
            else{
                $lista = lideres::bybarrio(Auth::user()->idbarrio)->withTrashed()->orderBy('nombre')->get();
            }
        }
        else{
            $catalogo= catalogos::where('nombre',$organizacion)->firstOrFail();

//            dd($catalogo);
            if ($modo=='activos'){
                $lista =lideres::bybarrio(Auth::user()->idbarrio)->where('organizacion',$catalogo->id)->orderBy('nombre')->get();
            }
            else{
                $lista = lideres::bybarrio(Auth::user()->idbarrio)->withTrashed()->where('organizacion',$catalogo->id)->orderBy('nombre')->get();
            }

        }
        $lideres=array();
//        dd($lista);
        foreach($lista as $lider){
            $lideres[]=array('id'=>$lider->id,'nombre'=>$lider->conllamamiento);
        }


        return response()->json(['combo'=>$lideres]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $combos['llamamientos']=catalogos::bycatalogo('llamamiento')->orderby('nombre')->lists('nombre','id');
        $combos['organizacion']=catalogos::bycatalogo('organizacion')->orderby('nombre')->lists('nombre','id');


        $lider=$lideres=lideres::findorfail($id);

        $this->authorize('update', $lider);

        return view('lideres.editar',compact('lider','combos'));
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


        $rules=array('nombre'=>'required',
            'llamamiento'=>'required',
            'phone'=>'digits:10',
            'organizacion'=>'required');
        $this->validate($request,$rules);

        $lider=lideres::findorfail($id);


        $this->authorize('update', $lider);


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
        $this->authorize('update', $lider);
        $lider->delete();
        \Session::flash('message','El Lider '.$lider->nombre." se borro correctamente");
        return redirect()->route('lideres');
    }

    public function getautocompletarlider(Request $request,$valor)
    {
        $result=array();
        $lideres =lideres::bybarrio($request->user()->idbarrio)
            ->where('nombre','like','%'.$valor.'%')
            ->get();

        foreach ($lideres as $lider)
        {
            $result[]=$lider->nombre." - ".$lider->llamamientonombre;
        }

        echo json_encode($result);


    }
}
