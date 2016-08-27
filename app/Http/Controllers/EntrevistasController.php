<?php

namespace SIU\Http\Controllers;

use Carbon\Carbon;
use fpdf\FPDF;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use SIU\entrevistas;
use SIU\Http\Requests;
use SIU\Http\Controllers\Controller;
use SIU\lideres;
use SIU\barrios;

class EntrevistasController extends Controller
{

    function listalideres ($status){
        if ($status=='todos'){
            $lista = lideres::bybarrio(Auth::user()->idbarrio)->withTrashed()->orderBy('nombre')->get();
        }
        elseif($status=='activos') {
            $lista = lideres::bybarrio(Auth::user()->idbarrio)->orderBy('nombre')->get();
        }
        elseif($status=='sacerdocio') {
            $lista = lideres::whereraw("idbarrio=".Auth::user()->idbarrio." and organizacion in (9,10,11,12,38,53)")->orderBy('nombre')->get();
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
        $year=Carbon::now();
        $years=array();
        $years[$year->year]=$year->year;
        $idbarrio=$request->user()->idbarrio;
        $resultado=DB::select("select YEAR(fecha) as year from entrevistas where idbarrio={$idbarrio} group by YEAR(fecha) desc") ;
        foreach ($resultado as $val){
            $years[$val->year]=$val->year;
        }
        $year=$year->year;
        return view('entrevistas.entrevistas',compact('year','years'));
    }
    public function search($datosbuscar,$year)
    {
        if($datosbuscar=='vacio'){
            $entrevistas =entrevistas::bybarrio(auth()->user()->idbarrio)->whereRaw('YEAR(fecha)=?',[$year])->orderBy('fecha', 'desc')->orderby('id')->paginate(10);
        }
        else{
            $entrevistas = entrevistas::bybarrio(auth()->user()->idbarrio)
                ->whereRaw("(nombre like '%$datosbuscar%')and (YEAR(fecha)=$year)")
                ->paginate(10);
        }
        return response()->view('layouts.entrevista',compact('entrevistas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lideres=$this->listalideres('sacerdocio');
        return view('entrevistas.nueva',compact('lideres'));
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
            'fecha'=>'required',
            'hora'=>'required',
            'nombre'=>'required',
            'entrevistador'=>'required',
            'duracion'=>'required',
            'lugar'=>'required',
            'lider1'=>'required',
            'lider2'=>'required',
            'lider3'=>'required',
            'user_id'=>'required',
            'token'=>'required');
        $this->validate($request,$rules);


        $fecha= Carbon::createFromFormat('Y-m-d',$request['fecha']);
        $request['fecha']=$fecha->format('Y-m-d');
        $request['nombre']=Str::title($request['nombre']);
        $request['lugar']=Str::title($request['lugar']);
        $entrevista=new entrevistas($request->all());
        $entrevista->save();

        \Session::flash('message','Registro Guardado Correctamente');
        return \Redirect::route('entrevistas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $discurso=entrevistas::findorfail($id);


        return response()->json($discurso->toArray()
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
        $entrevista=entrevistas::findorfail($id);

        $this->authorize('updatebarrio', $entrevista);


        if(Auth::user()->is('lider_estaca|aux_lider')){
            $this->authorize('updateuser', $entrevista);
        }

        $lideres=$this->listalideres('todos');
//        dd($entrevista);
        return view('entrevistas.editar',compact('entrevista','lideres'));
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
            'entrevistador'=>'required',
            'duracion'=>'required',
            'lugar'=>'required',
            'lider1'=>'required',
            'lider2'=>'required',
            'lider3'=>'required',
            'user_id'=>'required');
        $this->validate($request,$rules);

        $entrevista=entrevistas::findorfail($id);

        $this->authorize('updatebarrio', $entrevista);


        if(Auth::user()->is('lider_estaca|aux_lider')){
            $this->authorize('updateuser', $entrevista);
        }

        $fecha=Carbon::createFromFormat('Y-m-d',$request['fecha']);
        $hora=Carbon::createFromFormat('H:i A',$request['hora']);
        $request['fecha']=$fecha->format('Y-m-d');
        $request['hora']=$hora->format('H:i');

        $request['nombre']=Str::title($request['nombre']);
        $request['lugar']=Str::title($request['lugar']);


//        dd($request->all());
        $entrevista->fill($request->all());

//        dd($entrevista);
        $entrevista->save();

        \Session::flash('message','Se actualizo la entrevista de '.$entrevista->nombre);
        return \Redirect::route('entrevistas');
    }


    public function updatestatus(Request $request, $id)
    {
        $entrevista=entrevistas::findorfail($id);
        $entrevista->fill($request->all());
        $entrevista->save();

        return response()->json(['mensaje'=>'Se Actualizo la entrevista de '.$entrevista->nombre]);
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


    public function viewpdf($id,$evento,$token){

        $ruta=url('pdfentrevista',[$id,$evento,$token]);
//        dd($ruta);
        return view('entrevistas.view',compact('ruta'));
    }
    public function pdf($id,$evento,$token)
    {
        setlocale(LC_ALL, "es_ES");
        date_default_timezone_set("America/Mexico_City");
        $entrevista = entrevistas::findorfail($id);
        if ($entrevista->token != $token){
            abort(403);
        }



        $ward = $entrevista->ward;
        $fechaserv = strftime("%A %e de %B de %Y", strtotime($entrevista->fecha));
//        $horaentrevista=strftime("%l:%M %P",strtotime($entrevista->fecha));
        $horaentrevista = $entrevista->horahm;
//dd($entrevista->hora);

        $pdf=new FPDF();
        $pdf->AddPage("P", "letter");
        $pdf->SetFont("helvetica", "B", 20);
        $pdf->Image("imagenes/LOGO_LDS" . ".png", 10, 7, 60, 25);
        $y=$pdf->GetY();
        $pdf->Image("imagenes/logo" . ".png", 170, 7, 30, 30);
        $pdf->ln(25);
        $pdf->Cell(200, 5, "Asignacion de Entrevista", 0, 1, "C");
        $pdf->ln(2);
        $pdf->SetFont("helvetica", "B", 16);
        $pdf->Cell(200, 5, utf8_decode($entrevista->barrio[0]->nombreunidad), 0, 1, "C");
        $pdf->ln(10);
        $pdf->SetFont("helvetica", "", 12);
        $pdf->Cell(200, 5, utf8_decode("Apreciable Hno(a)"), 0, 1, "L");
        $pdf->SetFont("helvetica", "B", 12);
        $pdf->Cell(200, 5, utf8_decode($entrevista->nombre), 0, 1, "L");


        //leer texto
        $pdf->ln(10);

        $texto = file_get_contents("textos/ENTREVISTAS.txt");
        $texto = str_replace("FECHA", $fechaserv, $texto);
        $texto = str_replace("ENTREVISTADOR", $entrevista->entrevistadordatos->nombre, $texto);
        $texto = str_replace("DURACION", $entrevista->duracion, $texto);
        $texto = str_replace("LUGAR", $entrevista->lugar, $texto);
        $texto = str_replace("HORA", $horaentrevista, $texto);
        $pdf->SetFont("helvetica", "", 12);
        $pdf->MultiCell(200, 5, utf8_decode($texto), 0, "C");


        $pdf->ln(10);
        $pdf->MultiCell(200, 5, utf8_decode("Sin mas por el Momento deseando que las Bendiciones de Nuestro Padre Celestial sigan siendo
        derramadas sobre su Familia."), 0, "C");
        $pdf->ln(15);
        $pdf->Cell(200, 5, utf8_decode("Atentamente"), 0, 1, "C");
        //firmas
        $pdf->ln(15);
        $pdf->Cell(50, 5, utf8_decode(""), 0, 0, "C");
        $pdf->Cell(100, 5, utf8_decode($entrevista->lider1datos->nombre), "", 1, "C");

        $pdf->Cell(50, 5, utf8_decode(""), 0, 0, "C");
        $pdf->Cell(100, 5, utf8_decode($entrevista->lider1datos->llamamientonombre), "T", 1, "C");
        $pdf->Cell(50, 5, utf8_decode(""), 0, 0, "C");
        $pdf->Cell(100, 5, utf8_decode($entrevista->lider1datos->organizacionnombre), "", 1, "C");


        $pdf->ln(20);
        $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
        $pdf->Cell(80, 5, utf8_decode($entrevista->lider2datos->nombre), "", 0, "C");

        $pdf->Cell(20, 5, utf8_decode(""), 0, 0, "C");
        $pdf->Cell(80, 5, utf8_decode($entrevista->lider3datos->nombre), "", 1, "C");

        $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
        $pdf->Cell(80, 5, utf8_decode($entrevista->lider2datos->llamamientonombre), "T", 0, "C");
        $pdf->Cell(20, 5, utf8_decode(""), 0, 0, "C");
        $pdf->Cell(80, 5, utf8_decode($entrevista->lider2datos->llamamientonombre), "T", 1, "C");

        $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
        $pdf->Cell(80, 5, utf8_decode($entrevista->lider3datos->organizacionnombre), "", 0, "C");
        $pdf->Cell(20, 5, utf8_decode(""), 0, 0, "C");
        $pdf->Cell(80, 5, utf8_decode($entrevista->lider3datos->organizacionnombre), "", 1, "C");


        $pdf->ln(10);
        $pdf->MultiCell(200, 5, utf8_decode("Nota: En caso de No poder asistir le pedimos que nos pueda informar con tiempo para
        realizar ajustes necesarios"), "T", "C");

        $pdf->Cell(200, 5, utf8_decode("Datos del Entrevistador"), 0, 1, "L");
        $pdf->Cell(200, 5, utf8_decode("Nombre: ".$entrevista->entrevistadordatos->conllamamiento." (".$entrevista->entrevistadordatos->organizacionnombre.")"), 0, 1, "L");
        if($entrevista->entrevistadordatos->phone!='')
            $pdf->Cell(40, 5, utf8_decode("Tel.: ".$entrevista->entrevistadordatos->phone), 0, 0, "L");
        if($entrevista->entrevistadordatos->email!='') {
            $pdf->Cell(15, 5, utf8_decode("Correo :"), 0, 0, "L");
            $pdf->SetTextColor(45,27,186);
            $pdf->Write(5, $entrevista->entrevistadordatos->email, "mailto:" . $entrevista->entrevistadordatos->email);
        }

        if ($evento == 'descargar') {
            $pdf->Output($entrevista->nombrearchivo . ".pdf", "D");
        } else if ($evento == 'enviar') {

            $nombre = $entrevista->nombrearchivo . '.pdf';
            $descripcion = 'Entrevista ' . $entrevista->nombre;
            $data = $entrevista;
            $modulo = 'entrevista';
            return view('emails.enviarcorreo', compact('nombre', 'descripcion', 'data', 'modulo'));
        } else if ($evento == "ver") {
            $pdf->Output($entrevista->nombrearchivo . ".pdf", "I");
        } else if ($evento == "cadena") {
            $reporte = $pdf->Output($entrevista->nombrearchivo . ".pdf", "S");
            return $reporte;
        }
    }
}
