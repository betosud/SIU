<?php

namespace SIU\Http\Controllers;

use Carbon\Carbon;
use fpdf\FPDF;
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
    public function pdf($id,$evento)
    {
        setlocale(LC_ALL, "es_ES");
        date_default_timezone_set("America/Mexico_City");
        $bautizmal =bautizmal::findorfail($id);

        $fecha = strftime("%A %e de %B de %Y", strtotime($bautizmal->fecha));

        $hora = $bautizmal->horahm;
        $pdf=new FPDF();
        $pdf->AddPage("P", "letter");
        $pdf->SetFont("helvetica", "B", 16);
        $pdf->Image("imagenes/LOGO_LDS" . ".png", 10, 7, 45, 20);
        $y=$pdf->GetY();
        $pdf->Image("imagenes/logo" . ".png", 170, 7, 25, 25);
        $pdf->ln(25);
        $pdf->Cell(200, 5, "Programa Bautizmal", 0, 1, "C");
        $pdf->ln(5);
        $pdf->SetFont("helvetica", "B", 18);
        $pdf->Cell(200, 5, utf8_decode($bautizmal->bautizmode), 0, 1, "C");
        $pdf->ln(8);
        $pdf->SetFont("helvetica", "", 12);
        $pdf->Cell(200, 5, utf8_decode($fecha." ".$hora), 0, 1, "R");
        $pdf->ln(8);
        $pdf->Cell(62, 5, utf8_decode("Direccion del Programa"), 0, 0, "l");
        $pdf->Cell(7, 5, utf8_decode(""), 0, 0, "l");
        $pdf->Cell(62, 5, utf8_decode("Director Himnos"), 0, 0, "");
        $pdf->Cell(7, 5, utf8_decode(""), 0, 0, "l");
        $pdf->Cell(62, 5, utf8_decode("Pianista"), 0, 1, "");
        $pdf->SetFont("helvetica", "B", 12);
        $pdf->Cell(62, 5, utf8_decode($bautizmal->dirigidopor), "B", 0, "l");
        $pdf->Cell(7, 5, utf8_decode(""), 0, 0, "l");
        $pdf->Cell(62, 5, utf8_decode($bautizmal->direccion_himnos), "B", 0, "");
        $pdf->Cell(7, 5, utf8_decode(""), 0, 0, "l");
        $pdf->Cell(62, 5, utf8_decode($bautizmal->pianista), "B", 1, "l");
        $pdf->ln(8);
        $pdf->SetFont("helvetica", "", 12);
        $pdf->Cell(95, 5, utf8_decode("Himno Inicial"), 0, 0, "l");
        $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "l");
        $pdf->Cell(100, 5, utf8_decode("Oracion Inicial"), 0, 1, "");
        $pdf->SetFont("helvetica", "B", 12);
        $pdf->Cell(95, 5, utf8_decode($bautizmal->himno_inicial), "B", 0, "l");
        $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "l");
        $pdf->Cell(100, 5, utf8_decode($bautizmal->oracion_inicial), "B", 1, "");
        $totaloradores=0;
        $pdf->ln(5);
        $pdf->SetFont("helvetica", "B", 14);
        $pdf->Cell(200, 5, utf8_decode("Oradores"), 0, 1, "C");
        $pdf->ln(5);
        foreach ($bautizmal->oradores as $orador){
            $totaloradores++;
            $pdf->SetFont("helvetica", "", 12);
            $pdf->Cell(95, 5, utf8_decode($totaloradores." Orador"), 0, 0, "l");
            $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "l");
            $pdf->Cell(100, 5, utf8_decode("Tema Mensaje"), 0, 1, "l");
            $pdf->SetFont("helvetica", "B", 12);
            $pdf->Cell(95, 5, utf8_decode($orador->nombre), "B", 0, "l");
            $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "l");
            $pdf->Cell(100, 5, utf8_decode($orador->tema), "B", 1, "l");
            $pdf->ln(5);
        }

        $pdf->ln(5);
        $pdf->SetFont("helvetica", "B", 14);
        $pdf->Cell(200, 5, utf8_decode("Ordenanza"), 0, 1, "C");
        $pdf->ln(5);
        $pdf->SetFont("helvetica", "", 12);
        $pdf->Cell(95, 5, utf8_decode("bautizmo de"), 0, 0, "l");
        $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "l");
        $pdf->Cell(100, 5, utf8_decode("Ordenanza Por"), 0, 1, "");
        $pdf->SetFont("helvetica", "B", 12);
        $pdf->Cell(95, 5, utf8_decode($bautizmal->bautizmode), "B", 0, "l");
        $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "l");
        $pdf->Cell(100, 5, utf8_decode($bautizmal->ordenanzapor), "B", 1, "");

        $pdf->ln(5);
        $pdf->SetFont("helvetica", "", 12);
        $pdf->Cell(95, 5, utf8_decode("Testigo"), 0, 0, "l");
        $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "l");
        $pdf->Cell(100, 5, utf8_decode("Testigo"), 0, 1, "");
        $pdf->SetFont("helvetica", "B", 12);
        $pdf->Cell(95, 5, utf8_decode($bautizmal->testigo1), "B", 0, "l");
        $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "l");
        $pdf->Cell(100, 5, utf8_decode($bautizmal->testigo2), "B", 1, "");
        $pdf->SetFont("helvetica", "B", 14);
        $pdf->ln(5);
        $pdf->Cell(200, 5, utf8_decode("Actividades"), 0, 1, "C");
        $pdf->ln(5);
        $pdf->SetFont("helvetica", "B", 12);
//        $pdf->Cell(200, 5, utf8_decode($bautizmal->actividades), 0, 1, "");
        $pdf->MultiCell(200,5,utf8_decode($bautizmal->bienvenida),0,"",0);
        $pdf->ln(5);

        $pdf->SetFont("helvetica", "B", 14);
        $pdf->Cell(200, 5, utf8_decode("Bienvenida"), 0, 1, "C");
        $pdf->ln(5);
        $pdf->SetFont("helvetica", "B", 12);
//        $pdf->Cell(200, 5, utf8_decode($bautizmal->bienvenida), 0, 1, "");
        $pdf->MultiCell(200,5,utf8_decode($bautizmal->bienvenida),0,"",0);
        $pdf->ln(5);
        $pdf->SetFont("helvetica", "", 12);
        $pdf->Cell(95, 5, utf8_decode("Himno Inicial"), 0, 0, "l");
        $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "l");
        $pdf->Cell(100, 5, utf8_decode("Oracion Inicial"), 0, 1, "");
        $pdf->SetFont("helvetica", "B", 12);
        $pdf->Cell(95, 5, utf8_decode($bautizmal->himno_inicial), "B", 0, "l");
        $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "l");
        $pdf->Cell(100, 5, utf8_decode($bautizmal->oracion_inicial), "B", 1, "");


        $pdf->ln(5);
        $pdf->SetFont("helvetica", "", 12);
        $pdf->Cell(160, 5, utf8_decode(""), "", 0, "");
        $pdf->Cell(25, 5, utf8_decode("Asistencia"), 0, 0, "");
        $pdf->SetFont("helvetica", "B", 12);
        $pdf->Cell(15, 5, utf8_decode($bautizmal->asistencia), "B", 1, "C");







        if ($evento == 'descargar') {
            $pdf->Output($bautizmal->nombrearchivo . ".pdf", "D");
        }

        dd($hora);

    }
}
