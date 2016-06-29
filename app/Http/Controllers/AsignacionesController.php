<?php

namespace SIU\Http\Controllers;

use Carbon\Carbon;
use fpdf\FPDF;
use Illuminate\Http\Request;
use SIU\Http\Requests\asignacionesRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use SIU\asignaciones;
use SIU\Http\Requests;
use GuzzleHttp\Client;

class AsignacionesController extends Controller
{
    function listalideres ($status){
        if ($status=='todos'){
            $lista = lideres::bybarrio(Auth::user()->idbarrio)->withTrashed()->orderBy('nombre')->get();
        }
        elseif($status=='activos') {
            $lista = lideres::bybarrio(Auth::user()->idbarrio)->orderBy('nombre')->get();
        }
        $lideres=array();
//        dd($lideres);
        foreach($lista as $lider){
            $lideres[$lider->id]=$lider->conllamamiento;
        }
        return response()->json(['lideres'=>$lideres]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->is('admin|sec_barrio|obispado|sec_estaca|pcia_estaca')){
            $asignaciones= asignaciones::bybarrio(auth()->user()->idbarrio)->orderBy('fecha','desc')->orderBy('hora','desc')->paginate(10);
        }
        elseif(Auth::user()->is('lider_estaca|aux_lider')){
            $asignaciones= asignaciones::byuser(auth()->user()->id)->orderBy('fecha','desc')->orderBy('hora','desc')->paginate(10);
        }
//        dd($asignaciones);
        if($request->ajax()){
            return response()->json(view('layouts.asignacion',compact('asignaciones'))->render());
        }
        else {
            return view('asignaciones.asignaciones', compact('asignaciones'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('asignaciones.nueva');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(asignacionesRequest $request)
    {
        $fecha= Carbon::createFromFormat('Y-m-d',$request['fecha']);
        $request['fecha']=$fecha->format('Y-m-d');
        $request['nombre']= Str::title($request['nombre']);
        $request['asignacion']=Str::title($request['asignacion']);
        $request['lugar']=Str::title($request['lugar']);
        $asignacion= new asignaciones($request->all());
        $asignacion->save();
        \Session::flash('message','Registro Guardado Correctamente');
        return \Redirect::route('asignaciones');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $asignacion=asignaciones::findorfail($id);
        return response()->json($asignacion->toArray()
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lideres= $this->listalideres('todos');
        $asignacion=asignaciones::findorfail($id);
        return view('asignaciones.editar',compact('asignacion','lideres'));
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
        $rules=array('fecha'=>'required',
            'hora'=>'required',
            'nombre'=>'required',
            'asignacion'=>'required',
            'realizado'=>'required',
            'lugar'=>'required',
            'lider1'=>'required',
            'lider2'=>'required',
            'lider3'=>'required',
            'user_id'=>'required');
        $this->validate($request,$rules);
        $fecha=Carbon::createFromFormat('l d F Y',$request['fecha']);
        $request['fecha']=$fecha->format('Y-m-d');
        $request['nombre']=Str::title($request['nombre']);
        $request['asignacion']=Str::title($request['asignacion']);
        $request['lugar']=Str::title($request['lugar']);

        $asignacion=asignaciones::findorfail($id);
        $asignacion->fill($request->all());
        $asignacion->save();

        \Session::flash('message','Se actualizo la asignacion de '.$asignacion->nombre);
        return \Redirect::route('asignaciones');
    }

    public function updatestatus(Request $request, $id)
    {
        $asignacion=asignaciones::findorfail($id);
        $asignacion->fill($request->all());
        $asignacion->save();

        return response()->json(['mensaje'=>'Se Actualizo la asignacion de '.$asignacion->nombre]);
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

    public function pdf($id,$evento)
    {
        setlocale(LC_ALL,"es_ES");
        date_default_timezone_set("America/Mexico_City");
        $asignacion=asignaciones::findorfail($id);
//dd($discurso->lider1datos->nombre);
        $ward=$asignacion->ward;
//        dd($ward[0]['nameunit']);

        $fechaserv=strftime("%A %e de %B de %Y",strtotime($asignacion->fecha));


        $pdf=new FPDF();
        $pdf->AddPage("P", "letter");
        $pdf->SetFont("helvetica", "B", 20);
        $pdf->Image("imagenes/LOGO_LDS" . ".png", 10, 7, 60, 25);
        $y=$pdf->GetY();
        $pdf->Image("imagenes/logo" . ".png", 170, 7, 30, 30);
        $pdf->ln(25);
        $pdf->Cell(200, 5, "Asignacion", 0, 1, "C");
        $pdf->ln(2);
        $pdf->SetFont("helvetica", "B", 16);
        $pdf->Cell(200, 5, utf8_decode($asignacion->barrio[0]->nombreunidad), 0, 1, "C");
        $pdf->ln(10);
        $pdf->SetFont("helvetica", "", 12);
        $pdf->Cell(200, 5, utf8_decode("Apreciable Hno(a)"), 0, 1, "L");
        $pdf->SetFont("helvetica", "B", 12);
        $pdf->Cell(200, 5, utf8_decode($asignacion->nombre), 0, 1, "L");



        //leer texto
        $pdf->ln(25);

        $texto=file_get_contents("textos/ASIGNACIONES.txt");
        $texto=str_replace("FECHA",$fechaserv, $texto);
        $texto=str_replace("ASIGNACION",$asignacion->asignacion, $texto);
        $texto=str_replace("HORA",$asignacion->horahm, $texto);

        $texto=str_replace("LUGAR",$asignacion->lugar, $texto);
        $pdf->SetFont("helvetica","",12);
        $pdf->MultiCell(200,5,utf8_decode($texto),0,"C");


        $pdf->ln(15);
        $pdf->MultiCell(200,5,utf8_decode("Sin mas por el Momento deseando que las Bendiciones de Nuestro Padre Celestial sigan siendo
        derramadas sobre su Familia."),0,"C");
        $pdf->ln(15);
        $pdf->Cell(200,5,utf8_decode("Atentamente"),0,1,"C");


        //firmas
        $pdf->ln(15);
        $pdf->Cell(50, 5, utf8_decode(""), 0, 0, "C");
        $pdf->Cell(100, 5, utf8_decode($asignacion->lider1datos->nombre), "", 1, "C");

        $pdf->Cell(50, 5, utf8_decode(""), 0, 0, "C");
        $pdf->Cell(100, 5, utf8_decode($asignacion->lider1datos->organizacionnombre), "T", 1, "C");
        $pdf->Cell(50, 5, utf8_decode(""), 0, 0, "C");
        $pdf->Cell(100, 5, utf8_decode($asignacion->lider1datos->llamamientonombre), "", 1, "C");


        $pdf->ln(25);
        $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
        $pdf->Cell(80, 5, utf8_decode($asignacion->lider2datos->nombre), "", 0, "C");

        $pdf->Cell(20, 5, utf8_decode(""), 0, 0, "C");
        $pdf->Cell(80, 5, utf8_decode($asignacion->lider3datos->nombre), "", 1, "C");

        $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
        $pdf->Cell(80, 5, utf8_decode($asignacion->lider2datos->organizacionnombre), "T", 0, "C");
        $pdf->Cell(20, 5, utf8_decode(""), 0, 0, "C");
        $pdf->Cell(80, 5, utf8_decode($asignacion->lider2datos->organizacionnombre), "T", 1, "C");

        $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
        $pdf->Cell(80, 5, utf8_decode($asignacion->lider3datos->llamamientonombre), "", 0, "C");
        $pdf->Cell(20, 5, utf8_decode(""), 0, 0, "C");
        $pdf->Cell(80, 5, utf8_decode($asignacion->lider3datos->llamamientonombre), "", 1, "C");

        $pdf->ln(15);
        $pdf->MultiCell(200, 5, utf8_decode("Nota:Si necesita mas informacion sobre esta asignacion favor de contactar a los lideres de la unidad.
        En caso de No poder realizar la asignacion le pedimos que nos pueda informar con tiempo para realizar ajustes necesarios"), "T", "C");

        //opciones de generar
        if($evento=='descargar'){
            $pdf->Output($asignacion->nombrearchivo.".pdf","D");
        }
        else if($evento=='enviar'){

            $nombre=$asignacion->nombrearchivo.'.pdf';
            $descripcion='Asigancion '.$asignacion->nombre;
            $data=$asignacion;
            $modulo='asignacion';
            return view('emails.enviarcorreo',compact('nombre','descripcion','data','modulo'));
        }
        else if($evento =="ver"){
            $pdf->Output("Asignacion_".$asignacion->id.".pdf","I");
        }
        else if($evento =="cadena"){
            $reporte=$pdf->Output("Asignacion_".$asignacion->id.".pdf","S");
            return $reporte;
        }
    }
}
