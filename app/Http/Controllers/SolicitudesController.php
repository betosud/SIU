<?php

namespace SIU\Http\Controllers;

use Carbon\Carbon;
use fpdf\FPDF;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

use Illuminate\Routing\Matching\MethodValidator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Validator;
use SIU\barrios;
use SIU\catalogos;
use SIU\estacas;
use SIU\Http\Requests;
use SIU\Http\Controllers\Controller;
use SIU\lideres;
use SIU\solicitudes;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SolicitudesController extends Controller
{

    function listalideres ($status){
        if ($status=='todos'){
            $lista = lideres::bybarrio( Auth::user()->idbarrio)->withTrashed()->orderBy('nombre')->get();
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
    public function index()
    {
        //

        $solicitudes=solicitudes::bybarrio(auth()->user()->idbarrio)->where('status','<>','66')->orderBy('fecha','desc')->orderby('id','DESC')->paginate(10);
//        dd($solicitudes);

        

        return view('gastos.solicitudes',compact('solicitudes'));
    }

    public function show($id)
    {

        $solicitud =solicitudes::findorfail($id);


        return response()->json($solicitud->toArray()
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //leer catalogos
        $llamamientos=catalogos::bycatalogo('llamamiento')->orderby('nombre')->lists('nombre','id');
        $organizacion=catalogos::bycatalogo('organizacion')->orderby('nombre')->lists('nombre','id');
        $tipopago=catalogos::bycatalogo('tipopago')->orderby('nombre')->lists('nombre','id');
        $combo['estacas']= estacas::orderBy('nombre')->lists('nombre','id');
        $combo['barrios']= barrios::orderBy('nombreunidad')->lists('nombreunidad','id');
        $combo['llamamientos']=$llamamientos;
        $combo['organizacion']=$organizacion;
        $combo['tipopago']=$tipopago;

        return view('gastos.solicitud',compact('combo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=array('idestaca'=>'required',
            'idbarrio'=>'required',
            'fecha'=>'required',
            'solicitante'=>'required',
            'mail'=>'required|email',
            'pagable'=>'required',
            'ife'=>'required|size:13',
            'descripcion'=>'required',
            'cantidad'=>'required|numeric',
            'organizacion'=>'required',
            'tipopago'=>'required');
        $this->validate($request,$rules);
        $fecha= Carbon::createFromFormat('l d F Y',$request['fecha']);
        $request['fecha']=$fecha->format('Y-m-d');
        $request['solicitante']= Str::title($request['solicitante']);
        $request['pagable']=Str::title($request['pagable']);
        $request['descripcion']=Str::title($request['descripcion']);
        $request['observaciones']=Str::title($request['observaciones']);

//        dd($request->all());

        $solicitud=solicitudes::create($request->all());
        $solicitud->save();


        $barrio=barrios::findorfail($solicitud->idbarrio);


         Mail::send('emails.nuevasolicitud',['solicitud'=>$solicitud,'barrio'=>$barrio],function ($message) use ($barrio,$solicitud){
            $message->from($barrio->email,$barrio->nombreunidad);
            $message->subject('Solicitud De gasto');
            $message->to($solicitud->mail,$solicitud->solicitante);
        });

//        return redirect()->action('SolicitudesController@exito',array('barrio'=>$barrio,'solicitud'=>$solicitud));
        return View::make('gastos.exito',compact('barrio','solicitud'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function exito($barrio,$solicitud)
    {
        return view('gastos.exito',compact('barrio','solicitud'));
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
        $combo['tipopago']=catalogos::bycatalogo('tipopago')->orderby('nombre')->lists('nombre','id');
        $combo['status']=catalogos::bycatalogo('statussolicitud')->orderby('nombre')->lists('nombre','id');

        $combo['estacas']= estacas::orderBy('nombre')->lists('nombre','id');
        $combo['barrios']= barrios::orderBy('nombreunidad')->lists('nombreunidad','id');
        $solicitud=solicitudes::findorfail($id);
        return view('gastos.editarsolicitud',compact('solicitud','combo','lideres'));
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
            'solicitante'=>'required',
            'mail'=>'required|email',
            'pagable'=>'required',
            'ife'=>'required|size:13',
            'descripcion'=>'required',
            'cantidad'=>'required|numeric',
            'organizacion'=>'required',
            'tipopago'=>'required');
        $this->validate($request,$rules);


        $fecha= Carbon::createFromFormat('l d F Y',$request['fecha']);
        $request['fecha']=$fecha->format('Y-m-d');
        $request['solicitante']= Str::title($request['solicitante']);
        $request['pagable']=Str::title($request['pagable']);
        $request['descripcion']=Str::title($request['descripcion']);
        $request['observaciones']=Str::title($request['observaciones']);


        $solicitud=solicitudes::findorfail($id);
//        dd($solicitud);
        $solicitud->fill($request->all());
//        dd($solicitud);
        $solicitud->save();

        \Session::flash('message','Se actualizo Correctamente la solicitud '.$solicitud->id);
        return \Redirect::route('solicitudes');
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

    public function barrios($id)
    {
        $lista=array();
        $barrios=barrios::byestaca($id)->orderby('nombreunidad','DESC')->get();
        foreach($barrios as $barrio){
            $lista[$barrio->id]=$barrio->nombreunidad;
        }

        return response()->json($lista);
    }


    
    public function pdf($id,$tipo,$modo)
    {
            $solicitud = solicitudes::findorfail($id);

            $cantidad = number_format($solicitud->cantidad, 2, '.', ',');

            $importeletra = \NumeroALetras::convertir($cantidad, 'Pesos', 'Centavos');

//dd($solicitud->datossit->PteorganizacionNombre);


//
            $pdf = new FPDF();
            $pdf->AddPage("P", "letter");

//        para sit
            if ($tipo == 'completo' || $tipo == 'sit') {

                $pdf->SetFont("helvetica", "B", 20);
                $pdf->Image("imagenes/LOGO_LDS" . ".png", 10, 7, 50, 30);
                $pdf->Image(asset($solicitud->datosbarrio->datosbanco->rutalogo), 150, 15, 60, 15);
                $pdf->ln(8);
//        $pdf->Cell(70, 5, "", 0, 0, "C");
                $pdf->Cell(200, 5, "Cobro de SIT", 0, 1, "C");
                $pdf->ln(5);
                $pdf->Cell(200, 5, utf8_decode($solicitud->datosbarrio->nombreunidad), 0, 1, "C");
                $pdf->ln(10);
                $pdf->SetFont("helvetica", "", 15);
                $pdf->Cell(60, 5, utf8_decode("Convenio"), 0, 0, "C");
                $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
                $pdf->Cell(60, 5, utf8_decode("Referencia"), 0, 0, "C");
                $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
                $pdf->Cell(60, 5, utf8_decode("Concepto"), 0, 1, "C");
                $pdf->SetFont("helvetica", "B", 15);
                $pdf->ln(2);
                $pdf->Cell(60, 5, utf8_decode($solicitud->datosbarrio->datosbanco->convenio), "B", 0, "C");
                $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
                $pdf->Cell(60, 5, utf8_decode($solicitud->datossit->id), "B", 0, "C");
                $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
                $pdf->Cell(60, 5, utf8_decode($solicitud->datossit->id), "B", 1, "C");
                $pdf->ln(5);
                $pdf->SetFont("helvetica", "", 15);
                $pdf->Cell(200, 5, utf8_decode("Nombre del Beneficiario"), 0, 1, "C");
                $pdf->ln(2);
                $pdf->SetFont("helvetica", "B", 15);
                $pdf->Cell(200, 5, utf8_decode($solicitud->pagable), "B", 1, "C");


                $pdf->ln(5);
                $pdf->SetFont("helvetica", "", 15);
                $pdf->Cell(40, 5, utf8_decode("Monto"), 0, 0, "C");
                $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
                $pdf->Cell(150, 5, utf8_decode("Importe en letra"), 0, 1, "C");
                $pdf->ln(2);
                $pdf->SetFont("helvetica", "B", 15);
                $pdf->Cell(40, 5, utf8_decode($cantidad), "B", 0, "C");
                $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");

                if (strlen($importeletra) > 45)
                    $pdf->SetFont("helvetica", "B", 9);
                $pdf->Cell(150, 5, utf8_decode($importeletra), "B", 1, "C");
                $pdf->SetFont("helvetica", "B", 12);
                $pdf->ln(5);
                $pdf->Cell(200, 5, utf8_decode("No olvide Presentarse con una Identificacion vigente"), 0, 1, "C");
                $pdf->Cell(200, 10, utf8_decode("Vigencia 15 Dias Naturales a partir de que es recibido en el Banco"), "B", 1, "C");

            }

            if ($tipo == 'completo') {
                $y = $pdf->GetY();
                //agregar imagen tijeras
                $y = $y - 5;
                $pdf->Image("imagenes/tijeras" . ".png", 10, $y, 15, 10);
                $pdf->ln(5);
            }

            if ($tipo == 'completo' || $tipo == 'solicitud') {


                $pdf->SetFont("helvetica", "B", 22);
                $pdf->MultiCell(200, 10, utf8_decode("Formulario de Solicitud de Reembolso o Autorización de Gasto"), 0, "C", "");
                $pdf->SetFont("helvetica", "", 12);
                $pdf->MultiCell(200, 10, utf8_decode("Adjunte todos los recibos a este formulario"), 0, "C", "");
                $y = $pdf->GetY();
                //agregar imagen tijeras
                $y = $y - 20;

                $pdf->Image("imagenes/logo" . ".png", 170, $y, 20, 20);

                $pdf->SetFont("helvetica", "", 12);

                $pdf->ln(5);
                $pdf->Cell(110, 5, utf8_decode("Descripcion del Gasto"), 0, 0, "C");
                $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
                $pdf->Cell(80, 5, utf8_decode("Fecha"), 0, 1, "C");
                $pdf->SetFont("helvetica", "B", 12);
                $pdf->Cell(110, 5, utf8_decode($solicitud->descripcion), "B", 0, "C");
                $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
                $pdf->Cell(80, 5, utf8_decode($solicitud->fechamda), "B", 1, "C");
                $pdf->SetFont("helvetica", "", 12);
                $pdf->ln(3);
                $pdf->Cell(80, 5, utf8_decode("Pagable"), 0, 0, "C");
                $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "C");
                $pdf->Cell(55, 5, utf8_decode("Categoria"), 0, 0, "C");
                $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "C");
                $pdf->Cell(55, 5, utf8_decode("Tipo"), 0, 1, "C");
                $pdf->ln(2);
                $pdf->SetFont("helvetica", "B", 12);
                $pdf->Cell(80, 5, utf8_decode($solicitud->pagable), "B", 0, "C");
                $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "C");
                $pdf->Cell(55, 5, utf8_decode($solicitud->datossit->categorianombre), "B", 0, "C");
                $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "C");
                $pdf->Cell(55, 5, utf8_decode($solicitud->tipopagodsc), "B", 1, "C");

                $pdf->ln(3);
                $pdf->Cell(40, 5, utf8_decode("Organizacion"), 0, 0, "C");
                $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "C");
                $pdf->Cell(40, 5, utf8_decode("Monto"), 0, 0, "C");
                $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "C");
                $pdf->Cell(110, 5, utf8_decode("Importe en letra"), 0, 1, "C");
                $pdf->ln(2);
                $pdf->SetFont("helvetica", "B", 12);
                $pdf->Cell(40, 5, utf8_decode($solicitud->organizacionnombre), "B", 0, "C");
                $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "C");
                $pdf->Cell(40, 5, utf8_decode($cantidad), "B", 0, "C");
                $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "C");
                $pdf->Cell(110, 5, utf8_decode($importeletra), "B", 1, "C");

                $pdf->ln(5);
                $pdf->SetFont("helvetica", "B", 12);
                $pdf->Cell(120, 5, utf8_decode($solicitud->solicitante), 0, 0, "C");
                $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
                $pdf->Cell(70, 5, utf8_decode(""), 0, 1, "C");
                $pdf->ln(2);
                $pdf->SetFont("helvetica", "", 12);
                $pdf->Cell(120, 5, utf8_decode("Nombre del Solicitante"), "T", 0, "C");
                $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
                $pdf->Cell(70, 5, utf8_decode("Firma"), "T", 1, "C");
//dd($solicitud->datossit->pteorganizacionnombre);
                $pdf->ln(5);
                $pdf->SetFont("helvetica", "B", 12);
                $pdf->Cell(120, 5, utf8_decode($solicitud->datossit->pteorganizacionnombre), 0, 0, "C");
                $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
                $pdf->Cell(70, 5, utf8_decode(""), 0, 1, "C");
                $pdf->ln(2);
                $pdf->SetFont("helvetica", "", 12);
                $pdf->Cell(120, 5, utf8_decode("Presidente de la Organizacion"), "T", 0, "C");
                $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
                $pdf->Cell(70, 5, utf8_decode("Firma"), "T", 1, "C");


                $pdf->ln(5);
                $pdf->SetFont("helvetica", "B", 12);
                $pdf->Cell(120, 5, utf8_decode($solicitud->datossit->obisponombre), 0, 0, "C");
                $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
                $pdf->Cell(70, 5, utf8_decode(""), 0, 1, "C");
                $pdf->ln(2);
                $pdf->SetFont("helvetica", "", 12);
                $pdf->Cell(120, 5, utf8_decode("Nombre del Obispo"), "T", 0, "C");
                $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
                $pdf->Cell(70, 5, utf8_decode("Firma"), "T", 1, "C");


                $pdf->ln(5);
                $pdf->Cell(60, 5, utf8_decode("Entrego Factura  SI   NO"), 0, 0, "C");
                $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
                $pdf->Cell(60, 5, utf8_decode("Gasto Para"), 0, 0, "C");
                $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
                $pdf->Cell(60, 5, utf8_decode("SIT #"), 0, 1, "C");
                $pdf->ln(2);
                $pdf->SetFont("helvetica", "B", 12);
                $pdf->Cell(60, 5, utf8_decode(""), "B", 0, "C");
                $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
                $pdf->Cell(60, 5, utf8_decode("Unidad     Estaca"), "B", 0, "C");
                $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
                $pdf->Cell(60, 5, utf8_decode($solicitud->datossit->id), "B", 1, "C");
            }

//        dd($evento);
            if ($modo == 'enviar') {
//            $nombre='Sit_'.$sit->idsit.'.pdf';
//            $descripcion='SIT '.$sit->idsit;
//            $data=$sit;
//            $modulo='sit';
//            return view('emails.enviarcorreo',compact('nombre','descripcion','data','modulo'));
            } else if ($modo == 'descargar') {
                $pdf->Output($solicitud->nombrearchivo, "D");
            } else if ($modo == "ver") {
                $pdf->Output($solicitud->nombrearchivo, "I");
            } else if ($modo == 'cadena') {
                $reporte = $pdf->Output($solicitud->nombrearchivo, "S");
                return $reporte;
            }


    }
}
