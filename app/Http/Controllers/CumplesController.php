<?php

namespace SIU\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Excel;


use SIU\cumples;
use SIU\Http\Requests;




class CumplesController extends Controller
{
    public function index(Request $request){



        return view('cumples.cumples');

    }
    public function listar(Request $request){
        $cumples=cumples::bybarrio(Auth::user()->idbarrio)->raw('order by MONTH(fecha)')->Paginate(30);
        return view('cumples.listacumples',compact('cumples'));
    }

    public function store(Request $request){
        $request['idbarrio']=$request->user()->idbarrio;
        $rules=array('idbarrio'=>'required',
            'fecha'=>'required',
            'nombre'=>'required');
        $this->validate($request,$rules);

        $request['nombre']=Str::title($request['nombre']);
        $cumple=new cumples($request->all());
        $cumple->save();
//        dd($cumple);

        \Session::flash('message','Registro Guardado Correctamente');
        return \Redirect::route('cumples');
    }


    public function addmasiva(){
        return view('cumples.masiva');
    }


    public function show($id){
        $cumple=cumples::findorfail($id);
        return response()->json($cumple->toArray()
        );

    }

    public function update(Request $request,$id){

        $rules=array('nombre'=>'required',
            'fecha'=>'required');
        $validacion=$this->validate($request,$rules);

        $cumple=cumples::findorfail($id);
        $this->authorize('updatebarrio', $cumple);
        $request['nombre']=Str::title($request['nombre']);

        $cumple->fill($request->all());
        $cumple->save();

        \Session::flash('message','El registro se actualizo ');
        return response()->json([
            'error'=>$validacion,'salida'=>'exito'
        ]);


    }

    public function Destroy($id){
        $cumple=cumples::findorfail($id);
        $this->authorize('updatebarrio', $cumple);

        $cumple->delete();
        \Session::flash('message','Se Borro el Cumpleaños de '.$cumple->nombre);

        return response()->json([
            'error'=>'error','salida'=>'exito'
        ]);
    }

    public function uploadfile(Request $request){
        $request['idbarrio']=$request->user()->idbarrio;
        $rules=array('idbarrio'=>'required',
            'archivo'=>'required');


        $validate=$this->validate($request,$rules);




        $fecha = Carbon::now();
        $fecha = $fecha->format('Ymd_Hms');


        //obtenemos el campo file definido en el formulario
        $file = $request->file('archivo');

//        dd($file);

        //obtenemos el nombre del archivo

        $extension=$file->getClientOriginalExtension();
        $fileName =$fecha.".".$extension; // renameing image
        $destino=public_path('importarcumples');
        $upload_success = $file->move($destino, $fileName);
        if($upload_success) {
            Excel::load($upload_success->getPathname(),
                function  ($reader){
                $registros=array();
                $errores=array();
                foreach ($reader->get() as $item){
                        if(isset($item['nombre']) && isset($item['fecha_de_nacimiento']) && isset($item['idbarrio'])) {

                            if(is_numeric(substr( $item['fecha_de_nacimiento'],0,4)) && is_numeric(substr( $item['fecha_de_nacimiento'],5,2))&& is_numeric(substr( $item['fecha_de_nacimiento'],8,2))){


                                $fecha=Carbon::createFromDate(substr( $item['fecha_de_nacimiento'],0,4),substr( $item['fecha_de_nacimiento'],5,2),substr( $item['fecha_de_nacimiento'],8,2));
                                $cumple=cumples::create(['nombre'=>$item['nombre'],'fecha'=>$fecha,'idbarrio'=> $item['idbarrio']]);
//                                $cumple->save();
//dd($cumple);
                                $registros[]=$cumple;
                                \Session::flash('errors',$cumple);

                            }
                            else{
                                $errores[]="Error en Formato de fecha ".$item['nombre'];
                            }


                        }
                }



            });






        }

        return view('cumples.masiva');
    }
}
