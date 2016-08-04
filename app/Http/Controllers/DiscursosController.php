<?php

namespace SIU\Http\Controllers;

use Carbon\Carbon;
use fpdf\FPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use SIU\discursos;
use SIU\Http\Requests;
use SIU\Http\Controllers\Controller;
use SIU\lideres;
use SIU\barrios;


class DiscursosController extends Controller
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
        $year=Carbon::now();
        $years=array();
        $years[$year->year]=$year->year;
        $idbarrio=$request->user()->idbarrio;
        $resultado=DB::select("select YEAR(fecha) as year from discursos where idbarrio={$idbarrio} group by YEAR(fecha) desc") ;
        foreach ($resultado as $val){
            $years[$val->year]=$val->year;
        }
        $year=$year->year;
        return view('discursos.discursos',compact('year','years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lideres=$this->listalideres('activos');
        return view('discursos.nuevo',compact('lideres'));
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
            'tema'=>'required',
            'duracion'=>'required',
            'lugar'=>'required',
            'lider1'=>'required',
            'lider2'=>'required',
            'lider3'=>'required',
            'user_id'=>'required');
        $this->validate($request,$rules);
        $fecha=Carbon::createFromFormat('Y-m-d',$request['fecha']);
        $request['fecha']=$fecha->format('Y-m-d');
        $request['nombre']=Str::title($request['nombre']);
        $request['tema']=Str::title($request['tema']);
        $request['lugar']=Str::title($request['lugar']);
        $request['token']=str_random(40);

        $discurso= new discursos($request->all());
        $discurso->save();
        \Session::flash('message','Registro Guardado Correctamente');
        return \Redirect::route('discursos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $discurso=discursos::findorfail($id);

        
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
        $discurso=discursos::findorfail($id);

        $this->authorize('updatebarrio', $discurso);


        if(Auth::user()->is('lider_estaca|aux_lider')){
            $this->authorize('updateuser', $discurso);
        }


        $lideres= $this->listalideres('todos');
        return view('discursos.editar',compact('discurso','lideres'));
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
            'tema'=>'required',
            'duracion'=>'required',
            'lugar'=>'required',
            'lider1'=>'required',
            'lider2'=>'required',
            'lider3'=>'required',
            'user_id'=>'required');
        $this->validate($request,$rules);


        $fecha=Carbon::createFromFormat('Y-m-d',$request['fecha']);
        $request['fecha']=$fecha->format('Y-m-d');
        $request['nombre']=Str::title($request['nombre']);
        $request['tema']=Str::title($request['tema']);
        $request['lugar']=Str::title($request['lugar']);
        $discurso=discursos::findorfail($id);
        $discurso->fill($request->all());

        $this->authorize('updatebarrio', $discurso);


        if(Auth::user()->is('lider_estaca|aux_lider')){
            $this->authorize('updateuser', $discurso);
        }

        $discurso->save();

        \Session::flash('message','Se actualizo el Discurso de '.$discurso->nombre);
        return \Redirect::route('discursos');


    }
    public function updatestatus(Request $request, $id)
    {
        $discurso=discursos::findorfail($id);
        $discurso->fill($request->all());
        $discurso->save();

        return response()->json(['mensaje'=>'Se Actualizo el Discurso de '.$discurso->nombre]);
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

    public function pdf($id,$evento,$token)
    {
        setlocale(LC_ALL, "es_ES");
        date_default_timezone_set("America/Mexico_City");
        $discurso = discursos::findorfail($id);

        if ($discurso->token != $token){
            abort(403);
        }
        
        
        $ward = $discurso->ward;
        $fechaserv = strftime("%A %e de %B de %Y", strtotime($discurso->fecha));

        $horaentrevista = $discurso->horahm;


        $pdf=new FPDF();
        $pdf->AddPage("P", "letter");
        $pdf->SetFont("helvetica", "B", 20);
        $pdf->Image("imagenes/LOGO_LDS" . ".png", 10, 7, 60, 25);
        $y=$pdf->GetY();
        $pdf->Image("imagenes/logo" . ".png", 170, 7, 30, 30);
        $pdf->ln(25);
        $pdf->Cell(200, 5, "Asignacion de Discurso", 0, 1, "C");
        $pdf->ln(2);
        $pdf->SetFont("helvetica", "B", 16);
        $pdf->Cell(200, 5, utf8_decode($discurso->barrio[0]->nombreunidad), 0, 1, "C");
        $pdf->ln(10);
        $pdf->SetFont("helvetica", "", 12);
        $pdf->Cell(200, 5, utf8_decode("Apreciable Hno(a)"), 0, 1, "L");
        $pdf->SetFont("helvetica", "B", 12);
        $pdf->Cell(200, 5, utf8_decode($discurso->nombre), 0, 1, "L");


        //leer texto
        $pdf->ln(10);

        $texto = file_get_contents("textos/DISCURSOS.txt");
        $texto = str_replace("FECHA", $fechaserv, $texto);
        $texto = str_replace("DURACION", $discurso->duracion, $texto);
        $texto = str_replace("LUGAR", $discurso->lugar, $texto);
        $texto = str_replace("TEMA", $discurso->tema, $texto);
        $texto = str_replace("HORA", $horaentrevista, $texto);
        $pdf->SetFont("helvetica", "", 12);
        $pdf->MultiCell(200, 5, utf8_decode($texto), 0, "C");


        $pdf->ln(15);
        $pdf->MultiCell(200, 5, utf8_decode("Sin mas por el Momento deseando que las Bendiciones de Nuestro Padre Celestial sigan siendo
        derramadas sobre su Familia."), 0, "C");
        $pdf->ln(15);
        $pdf->Cell(200, 5, utf8_decode("Atentamente"), 0, 1, "C");
        //firmas
        $pdf->ln(15);
        $pdf->Cell(50, 5, utf8_decode(""), 0, 0, "C");
        $pdf->Cell(100, 5, utf8_decode($discurso->lider1datos->nombre), "", 1, "C");

        $pdf->Cell(50, 5, utf8_decode(""), 0, 0, "C");
        $pdf->Cell(100, 5, utf8_decode($discurso->lider1datos->organizacionnombre), "T", 1, "C");
        $pdf->Cell(50, 5, utf8_decode(""), 0, 0, "C");
        $pdf->Cell(100, 5, utf8_decode($discurso->lider1datos->llamamientonombre), "", 1, "C");


        $pdf->ln(25);
        $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
        $pdf->Cell(80, 5, utf8_decode($discurso->lider2datos->nombre), "", 0, "C");

        $pdf->Cell(20, 5, utf8_decode(""), 0, 0, "C");
        $pdf->Cell(80, 5, utf8_decode($discurso->lider3datos->nombre), "", 1, "C");

        $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
        $pdf->Cell(80, 5, utf8_decode($discurso->lider2datos->organizacionnombre), "T", 0, "C");
        $pdf->Cell(20, 5, utf8_decode(""), 0, 0, "C");
        $pdf->Cell(80, 5, utf8_decode($discurso->lider2datos->organizacionnombre), "T", 1, "C");

        $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
        $pdf->Cell(80, 5, utf8_decode($discurso->lider3datos->llamamientonombre), "", 0, "C");
        $pdf->Cell(20, 5, utf8_decode(""), 0, 0, "C");
        $pdf->Cell(80, 5, utf8_decode($discurso->lider3datos->llamamientonombre), "", 1, "C");


        $pdf->ln(15);
        $pdf->MultiCell(200, 5, utf8_decode("Nota: En caso de No poder asistir le pedimos que nos pueda informar con tiempo para
        realizar ajustes necesarios"), "T", "C");


        if ($evento == 'descargar') {
            $pdf->Output($discurso->nombrearchivo . ".pdf", "D");
        }
        else if ($evento == 'enviar') {

            $nombre = $discurso->nombrearchivo . '.pdf';
            $descripcion = 'Discurso ' . $discurso->nombre;
            $data = $discurso;
            $modulo = 'discurso';
            return view('emails.enviarcorreo', compact('nombre', 'descripcion', 'data', 'modulo'));
        }
        else if ($evento == "ver") {
            $pdf->Output($discurso->nombrearchivo . ".pdf", "I");
        }
        else if ($evento == "cadena") {
            $reporte = $pdf->Output($discurso->nombrearchivo . ".pdf", "S");
            return $reporte;
        }
    }



    public function search($datosbuscar,$year)
    {
        if($datosbuscar=='vacio'){
            $discursos = discursos::bybarrio(auth()->user()->idbarrio)->whereRaw('YEAR(fecha)=?',[$year])->orderBy('fecha', 'desc')->orderby('id')->paginate(10);
        }
        else{
            $discursos = discursos::bybarrio(auth()->user()->idbarrio)
                ->whereRaw("(nombre like '%$datosbuscar%')and (YEAR(fecha)=$year)")
                ->paginate(10);
        }
        return response()->view('layouts.discurso',compact('discursos'));
    }
}
