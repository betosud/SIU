<?php

namespace SIU\Http\Controllers;

use Carbon\Carbon;
use fpdf\FPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use SIU\anuncios_sacramentales;
use SIU\asuntos_sacramentales;
use SIU\Http\Requests;
use SIU\Http\Controllers\Controller;
use SIU\oradores_sacramentales;
use SIU\sacramentales;


class SacramentalController extends Controller
{

    public function index(Request $request)
    {
        if(Auth::user()->is('admin|sec_barrio|obispado|sec_estaca|pcia_estaca')){
            $sacramentales=sacramentales::bybarrio(auth()->user()->idbarrio)->orderBy('fecha','desc')->orderBy('hora','desc')->paginate(10);
        }
        elseif(Auth::user()->is('lider_estaca|aux_lider')){
            $sacramentales= sacramentales::byuser(auth()->user()->id)->orderBy('fecha','desc')->orderBy('hora','desc')->paginate(10);
        }
//        dd($entrevistas);
        if($request->ajax()){
            return response()->json(view('layouts.entrevista',compact('entrevistas'))->render());
        }
        else {
            return view('sacramentales.sacramentales', compact('sacramentales'));
        }
    }


    public function add(Request $request){


        if($request->user()->datos->idestaca!=$request->user()->idbarrio) {

            $url = url('eventos', [$request->user()->datos->idestaca, 6]);
            //obtener eventos del calendario
            $client1 = new \GuzzleHttp\Client();

            $responseestaca = $client1->request('GET', $url, [
                'headers' => ['user' => env('USERAPISIU'),'apikey'=>env('APIKEYSIU')]
            ]);
        }


        $url=url('eventos',[$request->user()->idbarrio,6]);
        //obtener eventos del calendario
        $client2 = new \GuzzleHttp\Client();
        $responsebarrio = $client2->request('GET', $url, [
            'headers' => ['user' => env('USERAPISIU'),'apikey'=>env('APIKEYSIU')]
        ]);

        $databarrio=json_decode($responsebarrio->getBody()->getContents(),true);
        $dataestaca=json_decode($responseestaca->getBody()->getContents(),true);
        $anucnios_sacramental=array();
        $totaleventos=0;

        dd($dataestaca);
        if(isset($dataestaca)){
            foreach ($dataestaca->datos as $evento){
                $anucnios_sacramental[$totaleventos]=$evento;
                $totaleventos++;
            }
        }
        if(isset($databarrio)){
            foreach ($databarrio->datos as $evento){
                $anucnios_sacramental[$totaleventos]=$evento;
                $totaleventos++;
            }
        }
        return view('sacramentales.nuevo.nuevo',compact('anucnios_sacramental'));

    }
    public function store(Request $request){
        $request['idbarrio']=$request->user()->idbarrio;
        $request['user_id']=$request->user()->id;
        //ingresar las validaciones dinamicas


        $rules=array('idbarrio'=>'required',
            'fecha'=>'required',
            'hora'=>'required',
            'preside'=>'required',
            'direccion_programa'=>'required',
            'direccion_himnos'=>'required',
            'pianista'=>'required',
            'himno_inicial'=>'required',
            'oracion_inicial'=>'required',
            'himno_sacramental'=>'required',

            'himno_intermedio'=>'required',
            'himno_final'=>'required',
            'oracion_final'=>'required',
            'user_id'=>'required|numeric');

        $totaloradores=0;
        $anuncios=0;
        $asuntos=0;
        $discursantesgrupo1=0;
        $discursantesgrupo2=0;
        $customarray=array();
        $mensajes=array();
        foreach($request->all() as $key => $value) {
//
            $request[$key]=Str::title($request[$key]);
            if (strpos($key, "anuncio",1) !== false) {
                $anuncios++;
                $rules['tbxanuncio'.$anuncios]='required';
                $customarray['tbxanuncio'.$anuncios]='Anuncio '.$anuncios;
            }
            if (strpos($key, "asunto",1) !== false) {
                $asuntos++;
                $rules['tbxasunto'.$asuntos]='required';
                $customarray['tbxasunto'.$anuncios]='Asunto '.$anuncios;
            }

            if (strpos($key, "discursantegrupo1",1) !== false) {
                $discursantesgrupo1++;
                $rules['tbxdiscursantegrupo1num'.$discursantesgrupo1]='required';
                $customarray['tbxdiscursantegrupo1num'.$discursantesgrupo1]='Discursante '.$discursantesgrupo1." Antes del Intermedio";
            }
            if (strpos($key, "discursantegrupo2",1) !== false) {
                $discursantesgrupo2++;
                $rules['tbxdiscursantegrupo2num'.$discursantesgrupo2]='required';
                $customarray['tbxdiscursantegrupo2num'.$discursantesgrupo2]='Discursante '.$discursantesgrupo2." Despues del Intermedio";
            }

        }

        $this->validate($request,$rules,$mensajes,$customarray);
        $sacramental=new sacramentales($request->all());
        $sacramental->save();
        $anuncios=0;
        $asuntos=0;
        $discursantesgrupo1=0;
        $discursantesgrupo2=0;
        $oradornombregrupo1=array();
        $oradortemagrupo1=array();
        $oradornombregrupo2=array();
        $oradortemagrupo2=array();
        foreach($request->all() as $key => $value) {
            if (strpos($key, "anuncio",1) !== false) {
                $anuncios++;
                $anuncios_sacramentales=new anuncios_sacramentales(['idprograma'=>$sacramental->id,'descripcion'=>$value]);
                $anuncios_sacramentales->save();
            }

            if (strpos($key, "asunto",1) !== false) {
                $asuntos++;
                $asuntos_sacramentales=new asuntos_sacramentales(['idprograma'=>$sacramental->id,'descripcion'=>$value]);
                $asuntos_sacramentales->save();
            }

            if (strpos($key, "discursantegrupo1",1) !== false) {
                $oradornombregrupo1[]=$value;
            }
            if (strpos($key, "discursantetemagrupo1",1) !== false) {
                $oradortemagrupo1[]=$value;
            }
            if (strpos($key, "discursantegrupo2",1) !== false) {
                $oradornombregrupo2[]=$value;
            }
            if (strpos($key, "discursantetemagrupo2",1) !== false) {
                $oradortemagrupo2[]=$value;
            }
        }

//guardar discrusantes
        $total=0;
        foreach ($oradornombregrupo1 as $orador){
            $oradorsacramental=new oradores_sacramentales(['idprograma'=>$sacramental->id,'nombre'=>$orador,'tema'=>$oradortemagrupo1[$total],'grupo'=>'1']);
            $oradorsacramental->save();
            $total++;
        }
        $total=0;
        foreach ($oradornombregrupo2 as $orador){
            $oradorsacramental=new oradores_sacramentales(['idprograma'=>$sacramental->id,'nombre'=>$orador,'tema'=>$oradortemagrupo2[$total],'grupo'=>'2']);
            $oradorsacramental=new oradores_sacramentales(['idprograma'=>$sacramental->id,'nombre'=>$orador,'tema'=>$oradortemagrupo2[$total],'grupo'=>'2']);
            $oradorsacramental->save();
            $total++;
        }

        \Session::flash('message','Registro Guardado Correctamente');

        return \Redirect::route('sacramentales');

    }


    public function edit($id){
        $sacramental=sacramentales::findorfail($id);
        $this->authorize('updatebarrio', $sacramental);
//        dd($sacramental->oradores);

        return view('sacramentales.editar.editar',compact('sacramental'));

    }
    public function update(Request $request,$id){
        $rules=array('fecha'=>'required',
            'hora'=>'required',
            'preside'=>'required',
            'direccion_programa'=>'required',
            'direccion_himnos'=>'required',
            'pianista'=>'required',
            'himno_inicial'=>'required',
            'oracion_inicial'=>'required',
            'himno_sacramental'=>'required',

            'himno_intermedio'=>'required',
            'himno_final'=>'required',
            'oracion_final'=>'required');

        $totaloradores=0;
        $anuncios=0;
        $asuntos=0;
        $discursantesgrupo1=0;
        $discursantesgrupo2=0;
        $customarray=array();
        $mensajes=array();
        foreach($request->all() as $key => $value) {
//
            $request[$key]=Str::title($request[$key]);
            if (strpos($key, "anuncio",1) !== false) {
                $anuncios++;
                $rules['tbxanuncio'.$anuncios]='required';
                $customarray['tbxanuncio'.$anuncios]='Anuncio '.$anuncios;
            }
            if (strpos($key, "asunto",1) !== false) {
                $asuntos++;
                $rules['tbxasunto'.$asuntos]='required';
                $customarray['tbxasunto'.$anuncios]='Asunto '.$anuncios;
            }

            if (strpos($key, "discursantegrupo1",1) !== false) {
                $discursantesgrupo1++;
                $rules['tbxdiscursantegrupo1num'.$discursantesgrupo1]='required';
                $customarray['tbxdiscursantegrupo1num'.$discursantesgrupo1]='Discursante '.$discursantesgrupo1." Antes del Intermedio";
            }
            if (strpos($key, "discursantegrupo2",1) !== false) {
                $discursantesgrupo2++;
                $rules['tbxdiscursantegrupo2num'.$discursantesgrupo2]='required';
                $customarray['tbxdiscursantegrupo2num'.$discursantesgrupo2]='Discursante '.$discursantesgrupo2." Despues del Intermedio";
            }

        }

        $this->validate($request,$rules,$mensajes,$customarray);
        $sacramental=sacramentales::findorfail($id);

        $sacramental->fill($request->all());
        $sacramental->save();
        //eliminar datos

        foreach ($sacramental->oradores as $orador){
            $orador->delete();
        }
        foreach ($sacramental->asuntos as $asunto){
            $asunto->delete();
        }
        foreach ($sacramental->anuncios as $asunto){
            $asunto->delete();
        }

        //Guardar datos
        $anuncios=0;
        $asuntos=0;
        $discursantesgrupo1=0;
        $discursantesgrupo2=0;
        $oradornombregrupo1=array();
        $oradortemagrupo1=array();
        $oradornombregrupo2=array();
        $oradortemagrupo2=array();
        foreach($request->all() as $key => $value) {
            if (strpos($key, "anuncio",1) !== false) {
                $anuncios++;
                $anuncios_sacramentales=new anuncios_sacramentales(['idprograma'=>$sacramental->id,'descripcion'=>$value]);
                $anuncios_sacramentales->save();
            }

            if (strpos($key, "asunto",1) !== false) {
                $asuntos++;
                $asuntos_sacramentales=new asuntos_sacramentales(['idprograma'=>$sacramental->id,'descripcion'=>$value]);
                $asuntos_sacramentales->save();
            }

            if (strpos($key, "discursantegrupo1",1) !== false) {
                $oradornombregrupo1[]=$value;
            }
            if (strpos($key, "discursantetemagrupo1",1) !== false) {
                $oradortemagrupo1[]=$value;
            }
            if (strpos($key, "discursantegrupo2",1) !== false) {
                $oradornombregrupo2[]=$value;
            }
            if (strpos($key, "discursantetemagrupo2",1) !== false) {
                $oradortemagrupo2[]=$value;
            }
        }

//guardar discrusantes
        $total=0;
        foreach ($oradornombregrupo1 as $orador){
            $oradorsacramental=new oradores_sacramentales(['idprograma'=>$sacramental->id,'nombre'=>$orador,'tema'=>$oradortemagrupo1[$total],'grupo'=>'1']);
            $oradorsacramental->save();
            $total++;
        }
        $total=0;
        foreach ($oradornombregrupo2 as $orador){
            $oradorsacramental=new oradores_sacramentales(['idprograma'=>$sacramental->id,'nombre'=>$orador,'tema'=>$oradortemagrupo2[$total],'grupo'=>'2']);
            $oradorsacramental->save();
            $total++;
        }
        \Session::flash('message','Registro Guardado Correctamente');
        return \Redirect::route('sacramentales');
    }


    public function pdf($id){
        setlocale(LC_ALL, "es_ES");
        date_default_timezone_set("America/Mexico_City");
        $sacramental=sacramentales::findorfail($id);
        $this->authorize('updatebarrio', $sacramental);
        $fechaserv = strftime("%A %e de %B de %Y", strtotime($sacramental->fecha));
        $horaserv = $sacramental->horahm;
        $pdf=new FPDF();
        $pdf->AddPage("P", "letter");
        $pdf->SetFont("helvetica", "B", 20);
        $pdf->Image("imagenes/LOGO_LDS" . ".png", 10, 7, 60, 25);
        $y=$pdf->GetY();
        $pdf->Image("imagenes/logo" . ".png", 170, 7, 30, 30);
        $pdf->ln(5);
        $pdf->Cell(200, 5, "Programa Sacramental", 0, 1, "C");
        $pdf->ln(5);
        $pdf->Cell(200, 5, utf8_decode($sacramental->barrio->nombreunidad), 0, 1, "C");
        $pdf->ln(10);
        $pdf->SetFont("helvetica", "B", 13);
        $pdf->Cell(200, 5, utf8_decode($fechaserv." ".$horaserv), 0, 1, "R");


        $pdf->ln(5);
        $pdf->SetFont("helvetica", "B", 13);
        $pdf->Cell(200, 5, utf8_decode("Anuncios"), 0, 1, "C");
        //ingresar anuncios
        $pdf->SetFont("helvetica", "", 11);
        $total=1;
        foreach ($sacramental->anuncios as $anuncio){
            $pdf->MultiCell(200,5,utf8_decode($total.".- ".$anuncio->descripcion),"B",'J');
            $total++;
        }


        $pdf->ln(5);
        $pdf->SetFont("helvetica", "", 11);
        $pdf->Cell(95, 5, utf8_decode("Preside"), 0, 0, "L");
        $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "L");
        $pdf->Cell(100, 5, utf8_decode("Direccion del Programa"), 0, 1, "L");
        $pdf->SetFont("helvetica", "B", 1);
        $pdf->Cell(95, 5, utf8_decode($sacramental->preside), "B", 0, "L");
        $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "L");
        $pdf->Cell(100, 5, utf8_decode($sacramental->direccion_programa), "B", 1, "L");

        $pdf->ln(5);
        $pdf->SetFont("helvetica", "", 11);
        $pdf->Cell(95, 5, utf8_decode("Director Himnos"), 0, 0, "L");
        $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "L");
        $pdf->Cell(100, 5, utf8_decode("Pianista"), 0, 1, "L");
        $pdf->SetFont("helvetica", "B", 11);
        $pdf->Cell(95, 5, utf8_decode($sacramental->direccion_himnos), "B", 0, "L");
        $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "L");
        $pdf->Cell(100, 5, utf8_decode($sacramental->pianista), "B", 1, "L");

        $pdf->ln(5);
        $pdf->SetFont("helvetica", "", 11);
        $pdf->Cell(95, 5, utf8_decode("Himno Inicial"), 0, 0, "L");
        $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "L");
        $pdf->Cell(100, 5, utf8_decode("Oracion Inicial"), 0, 1, "L");
        $pdf->SetFont("helvetica", "B", 11);
        $pdf->Cell(95, 5, utf8_decode($sacramental->himno_inicial), "B", 0, "L");
        $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "L");
        $pdf->Cell(100, 5, utf8_decode($sacramental->oracion_inicial), "B", 1, "L");



        $pdf->ln(5);
        $pdf->SetFont("helvetica", "", 11);
        $pdf->Cell(200, 5, utf8_decode("Himno Sacramental"), 0, 1, "L");
        $pdf->SetFont("helvetica", "B", 11);
        $pdf->Cell(200, 5, utf8_decode($sacramental->himno_sacramental), "B", 1, "L");


        $pdf->ln(5);
        $pdf->SetFont("helvetica", "B", 12);
        $pdf->Cell(200, 5, utf8_decode("Asuntos Barrio"), 0, 1, "C");
        //ingresar anuncios
        $pdf->SetFont("helvetica", "", 11);
        $total=1;
        foreach ($sacramental->asuntos as $asunto){
            $pdf->MultiCell(200,5,utf8_decode($total.".- ".$asunto->descripcion),'B','J');
            $total++;
        }


        $pdf->ln(5);
        $pdf->SetFont("helvetica", "", 11);
        $pdf->Cell(95, 5, utf8_decode("Bendice"), 0, 0, "L");
        $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "L");
        $pdf->Cell(100, 5, utf8_decode("Bendice"), 0, 1, "L");
        $pdf->SetFont("helvetica", "B", 11);
        $pdf->Cell(95, 5, utf8_decode($sacramental->bendice1), "B", 0, "L");
        $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "L");
        $pdf->Cell(100, 5, utf8_decode($sacramental->bendice2), "B", 1, "L");

        $pdf->ln(5);
        $pdf->SetFont("helvetica", "", 11);
        $pdf->Cell(200, 5, utf8_decode("Reparten Sacramentos"), 0, 1, "L");
        $pdf->SetFont("helvetica", "B", 11);
        $pdf->MultiCell(200,5,utf8_decode($sacramental->reparten),"B",'J');

        $pdf->ln(5);
        $pdf->SetFont("helvetica", "B", 12);
        $pdf->Cell(200, 5, utf8_decode("Discursantes"), 0, 1, "C");
        $total=1;
        foreach($sacramental->oradores as $orador){
            if($orador->grupo==1){
                $pdf->SetFont("helvetica", "", 11);
                $pdf->Cell(95, 5, utf8_decode("Discursante $total"), 0, 0, "L");
                $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "L");
                $pdf->Cell(95, 5, utf8_decode("Tema"), 0, 1, "L");
                $pdf->SetFont("helvetica", "B", 11);
                $pdf->Cell(95, 5, utf8_decode("$orador->nombre"), "B", 0, "L");
                $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
                $pdf->Cell(95, 5, utf8_decode($orador->tema), "B", 1, "L");
                $total++;
                $pdf->ln(5);
            }
        }



        $pdf->ln(5);
        $pdf->SetFont("helvetica", "", 11);

        $pdf->Cell(200, 5, utf8_decode("Himno Intermedio"), 0, 1, "L");
        $pdf->SetFont("helvetica", "B", 11);
        $pdf->Cell(200, 5, utf8_decode($sacramental->himno_intermedio), "B", 1, "L");

        $pdf->ln(5);
        $pdf->SetFont("helvetica", "B", 12);
        $pdf->Cell(200, 5, utf8_decode("Discursantes"), 0, 1, "C");
        $total=1;
        foreach($sacramental->oradores as $orador){
            if($orador->grupo==2){
                $pdf->SetFont("helvetica", "", 11);
                $pdf->Cell(95, 5, utf8_decode("Discursante $total"), 0, 0, "L");
                $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "L");
                $pdf->Cell(95, 5, utf8_decode("Tema"), 0, 1, "L");
                $pdf->SetFont("helvetica", "B", 11);
                $pdf->Cell(95, 5, utf8_decode("$orador->nombre"), "B", 0, "L");
                $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
                $pdf->Cell(95, 5, utf8_decode($orador->tema), "B", 1, "L");
                $pdf->ln(5);
                $total++;
            }
        }







        $pdf->ln(5);
        $pdf->SetFont("helvetica", "", 11);
        $pdf->Cell(95, 5, utf8_decode("Himno Final"), 0, 0, "L");
        $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "L");
        $pdf->Cell(100, 5, utf8_decode("Oracion Final"), 0, 1, "L");
        $pdf->SetFont("helvetica", "B", 11);
        $pdf->Cell(95, 5, utf8_decode($sacramental->himno_final), "B", 0, "L");
        $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "L");
        $pdf->Cell(100, 5, utf8_decode($sacramental->oracion_final), "B", 1, "L");


        $pdf->ln(5);
        $pdf->SetFont("helvetica", "", 11);
        $pdf->Cell(40, 5, utf8_decode("Asistencia"), 0, 1, "L");
        $pdf->SetFont("helvetica", "B", 11);
        $pdf->Cell(40, 5, utf8_decode($sacramental->asistencia), "B", 1, "L");



        $pdf->Output($sacramental->nombrearchivo . ".pdf", "D");

    }
}
