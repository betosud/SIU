<?php

namespace SIU\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use SIU\bautizmal;
use SIU\Http\Requests;
use SIU\lideres;
use SIU\oradores_bautizmal;
use Illuminate\Support\Str;

class BautizmalController extends Controller
{


    function listalideres ($status){
        if ($status =='todos'){
            $lista = lideres::bybarrio(Auth::user()->idbarrio)->withTrashed()->orderBy('nombre')->get();
        }
        elseif($status=='activos') {
            $lista = lideres::bybarrio(Auth::user()->idbarrio)->orderBy('nombre')->get();
        }
        $lideres=array();
//        dd($lista);
        foreach($lista as $lider){
            $lideres[$lider->id]=$lider->conllamamiento;
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
        if($request->user()->is('admin|sec_barrio|obispado|sec_estaca|pcia_estaca')){
            $bautizmales=bautizmal::bybarrio($request->user()->idbarrio)->orderBy('fecha','desc')->orderBy('hora','desc')->paginate(10);
        }
        elseif($request->user()->is('lider_estaca|aux_lider')){
            $bautizmales= bautizmal::byuser($request->user()->id)->orderBy('fecha','desc')->orderBy('hora','desc')->paginate(10);
        }



        if($request->ajax()){
            return response()->json(view('layouts.bautizmal',compact('bautizmales'))->render());
        }
        else {
            return view('bautizmal.bautizmales', compact('bautizmales'));
        }
    }


    public function create(){
        return view('bautizmal.nuevo');
    }

    public function store(Request $request){
        $totaloradores=0;


        $rules=array('bautizmode'=>'required',
            'fecha'=>'required',
            'hora'=>'required',
            'dirigidopor'=>'required',
            'direccion_himnos'=>'required',
            'pianista'=>'required',
            'himno_inicial'=>'required',
            'oracion_inicial'=>'required',
            'testigo1'=>'required',
            'testigo2'=>'required',
            'ordenanzapor'=>'required',
            'himno_final'=>'required',
            'oracion_final'=>'required',
            'actividades'=>'required',
            'bienvenida'=>'required',
            'tbxnombre_orador1'=>'required',
            'tbxtema_orador1'=>'required'
        );
//        foreach($request->all() as $key => $value) {
//
//            if (strpos($key, "nombre_orador",1) !== false) {
//                $totaloradores++;
//                $rules['tbxnombre_orador'.$totaloradores]='required';
//                $rules['tbxtema_orador'.$totaloradores]='required';
//            }
//        }
//        dd($request->all());
        $this->validate($request,$rules);

        $request['bautizmode']=Str::title($request['bautizmode']);
        $request['dirigidopor']=Str::title($request['dirigidopor']);
        $request['direccion_himnos']=Str::title($request['direccion_himnos']);
        $request['pianista']=Str::title($request['pianista']);
        $request['oracion_inicial']=Str::title($request['oracion_inicial']);
        $request['testigo1']=Str::title($request['testigo1']);
        $request['testigo2']=Str::title($request['oracion_inicial']);
        $request['ordenanzapor']=Str::title($request['ordenanzapor']);
        $request['oracion_final']=Str::title($request['oracion_final']);
        $request['actividades']=Str::title($request['actividades']);
        $request['bienvenida']=Str::title($request['bienvenida']);


        $bautizmal=new bautizmal($request->all());

$bautizmal->save();

        foreach($request->all() as $key => $value) {
            if (strpos($key, "nombre_orador",1) !== false) {
                //results here
                $oradores[]=Str::title($value);
            }
            if (strpos($key, "tema_orador",1) !== false) {
                //results here
                $temas[]=Str::title($value);
            }
        }


        $countoradores=count($oradores);
        for($i=0;$i<$countoradores;$i++){

            $orador=array('idprograma'=>$bautizmal->id,'nombre'=> $oradores[$i],'tema'=>$temas[$i]);
            $speck=new oradores_bautizmal($orador);
            $speck->save();

        }

        return redirect('bautizmales');
    }
    public function edit($id){
        $bautizmal=bautizmal::findorfail($id);

        $this->authorize('updatebarriobautizmal', $bautizmal);

        $oradores=oradores_bautizmal::where('idprograma',$bautizmal->id)->get();
//        dd($oradores);
        return view('bautizmal.editar',compact('bautizmal','oradores'));
    }


    public function update(Request $request,$id){
        $bautizmal=bautizmal::findorfail($id);
$totaloradores=0;
        $rules=array('bautizmode'=>'required',
            'fecha'=>'required',
            'hora'=>'required',
            'dirigidopor'=>'required',
            'direccion_himnos'=>'required',
            'pianista'=>'required',
            'himno_inicial'=>'required',
            'oracion_inicial'=>'required',
            'testigo1'=>'required',
            'testigo2'=>'required',
            'ordenanzapor'=>'required',
            'himno_final'=>'required',
            'oracion_final'=>'required',
            'actividades'=>'required',
            'bienvenida'=>'required',
            'tbxnombre_orador1'=>'required',
            'tbxtema_orador1'=>'required'
        );
//        foreach($request->all() as $key => $value) {
//
//            if (strpos($key, "nombre_orador",1) !== false) {
//                $totaloradores++;
//                $rules['tbxnombre_orador'.$totaloradores]='required';
//                $rules['tbxtema_orador'.$totaloradores]='required';
//            }
//        }
//        dd($request->all());

        $this->validate($request,$rules);
        $fecha=Carbon::createFromFormat('Y-m-d',$request['fecha']);
        $hora=Carbon::createFromFormat('H:i A',$request['hora']);
        $request['fecha']=$fecha->format('Y-m-d');
        $request['hora']=$hora->format('H:i');

        $request['bautizmode']=Str::title($request['bautizmode']);
        $request['dirigidopor']=Str::title($request['dirigidopor']);
        $request['direccion_himnos']=Str::title($request['direccion_himnos']);
        $request['pianista']=Str::title($request['pianista']);
        $request['oracion_inicial']=Str::title($request['oracion_inicial']);
        $request['testigo1']=Str::title($request['testigo1']);
        $request['testigo2']=Str::title($request['oracion_inicial']);
        $request['ordenanzapor']=Str::title($request['ordenanzapor']);
        $request['oracion_final']=Str::title($request['oracion_final']);
        $request['actividades']=Str::title($request['actividades']);
        $request['bienvenida']=Str::title($request['bienvenida']);
        $bautizmal->fill($request->all());
        $bautizmal->save();
        $oradorsave=oradores_bautizmal::where('idprograma',$id)->get();
        foreach($oradorsave as $orador){
            oradores_bautizmal::destroy($orador->id);
        }
        foreach($request->all() as $key => $value) {
            if (strpos($key, "nombre_orador",1) !== false) {
                //results here
                $oradores[]=Str::title($value);
            }
            if (strpos($key, "tema_orador",1) !== false) {
                //results here
                $temas[]=Str::title($value);
            }
        }
        $countoradores=count($oradores);
        for($i=0;$i<$countoradores;$i++){
            $orador=array('idprograma'=>$bautizmal->id,'nombre'=> $oradores[$i],'tema'=>$temas[$i]);
            $speck=new oradores_bautizmal($orador);
            $speck->save();
        }



        \Session::flash('message','Registro Guardado Correctamente');

        return redirect()->route('bautizmales');




    }
}
