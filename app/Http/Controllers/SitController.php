<?php

namespace SIU\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use SIU\archivossit;
use SIU\catalogos;
use SIU\Http\Requests;
use SIU\Http\Controllers\Controller;
use SIU\lideres;
use SIU\sit;
use SIU\solicitudes;
use Illuminate\Support\Facades\Input;


class SitController extends Controller
{

    function listalideres ($status)
    {
        if ($status == 'todos') {
            $lista = lideres::bybarrio(Auth::user()->idbarrio)->withTrashed()->orderBy('nombre')->get();
        } elseif ($status == 'activos') {
            $lista = lideres::bybarrio(Auth::user()->idbarrio)->orderBy('nombre')->get();
        } elseif ($status == 'obispado') {
            $lista = lideres::whereraw("idbarrio=" . Auth::user()->idbarrio . " and organizacion in (9)")->orderBy('nombre')->get();
        }
        $lideres = array();
//        dd($lista);
        foreach ($lista as $lider) {
            $lideres[$lider->id] = $lider->conllamamiento;
        }
        return $lideres;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sits=solicitudes::bybarrio(auth()->user()->idbarrio)->where('status','=','66')->orderBy('fecha','desc')->orderby('id','DESC')->paginate(10);

        if($request->ajax()){
            return response()->json(view('layouts.sit',compact('sits'))->render());
        }
        else {
            return view('gastos.sits',compact('sits'));
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idsolicitud)
    {
        $obispado=$this->listalideres('obispado');
        $lideres=$this->listalideres('activos');
        $solicitud=solicitudes::findorfail($idsolicitud);
        $categoria=catalogos::bycatalogo('categoria')->orderby('nombre')->lists('nombre','id');
//        dd($solicitud);
        return view('gastos.nuevosit',compact('lideres','obispado','solicitud','categoria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=array('id'=>'required|digits:12|unique:sit,id',
            'idsolicitud'=>'required',
            'categoria'=>'required',
            'pteorganizacion'=>'required',
            'obispo'=>'required',
            'status'=>'required',
        'statuscomprobantes'=>'required',
            'enviooficinas'=>'required',
            'user_id'=>'required');

        $this->validate($request,$rules);
        $fecha=Carbon::createFromFormat('l d F Y',$request['fecha']);
        $request['fecha']=$fecha->format('Y-m-d');
        $sit=new sit($request->all());
        $solicitud=solicitudes::findorfail($request->idsolicitud);
        $solicitud['status']=66;

        $sit->save();
        $solicitud->save();
        \Session::flash('message','Registro Guardado Correctamente');
        return \Redirect::route('sits');
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
        $solicitud=solicitudes::findorfail($id);
        $obispado=$this->listalideres('obispado');
        $lideres=$this->listalideres('todos');
        $categoria=catalogos::bycatalogo('categoria')->orderby('nombre')->lists('nombre','id');
        $status=catalogos::bycatalogo('statussit')->where('id','<>','29')->where('id','<>','30')->orderby('nombre')->lists('nombre','id');
        $archivossit=archivossit::where('idsolicitud',$id)->get();

        return view('gastos.editarsit',compact('solicitud','obispado','lideres','categoria','status','archivossit'));
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
        $rules=array('id'=>'required|digits:12|unique:sit,id,'.$id,
            'categoria'=>'required',
            'pteorganizacion'=>'required',
            'obispo'=>'required',
            'status'=>'required',
            'statuscomprobantes'=>'required',
            'enviooficinas'=>'required',
            'user_id'=>'required');
        $this->validate($request,$rules);

        $fecha=Carbon::createFromFormat('l d F Y',$request['fecha']);
        $request['fecha']=$fecha->format('Y-m-d');

        $sit=sit::findorfail($id);
        $sit->fill($request->all());
        $sit->save();
        \Session::flash('message','Registro Guardado Correctamente');
        return redirect(route('editarsit',$sit->idsolicitud));
    }

public function  destroyfile($id){
    $archivosit=archivossit::findorfail($id);
    $archivosit->delete();

    return redirect()->back();
}
    public function uploadfile(Request $request)
    {
        $rules=array('idsolicitud'=>'required',
            'nombre'=>'required',
            'descripcion'=>'required',
            'archivo'=>'required');
        $this->validate($request,$rules);

        $solicitud=solicitudes::findorfail($request->idsolicitud);
        $nombre=$request->nombre;
        $nombre=str_replace(" ","_",$nombre);

        $fecha = Carbon::now();
        $fecha = $fecha->format('Ymd_Hms');


        //obtenemos el campo file definido en el formulario
        $file = $request->file('archivo');

        //obtenemos el nombre del archivo

        $extension=$file->getClientOriginalExtension();

        $fileName =$request->idsolicitud."_".$solicitud->datossit->id."_".$nombre."_".$fecha.".".$extension; // renameing image


        $destino=public_path('archivos');

        //indicamos que queremos guardar un nuevo archivo en el disco local
//        Input::file('archivo')->move($destino, $fileName); // uploading file to given path
        $upload_success = $file->move($destino, $fileName);
        if($upload_success){

            $request['nombre']=$nombre;
            $request['tipo']=$extension;
            $request['rutaarchivo']=$fileName;
            $request['user_id']=Auth::user()->id;


            $archivosit=new archivossit($request->all());


            $archivosit->save();

            \Session::flash('message','el Archivo se Guardo Correctamente');
            return redirect()->route('editarsit',$archivosit->idsolicitud);
        }
        else{
            \Session::flash('error','No se subio el archivo');
            return redirect()->route('editarsit',$request->idsolicitud);
        }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
