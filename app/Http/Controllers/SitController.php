<?php

namespace SIU\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Patchwork\PHP\Shim\Xml;
use SIU\archivossit;
use SIU\barrios;
use SIU\catalogos;
use SIU\estacas;
use SIU\Http\Requests;
use SIU\lideres;
use SIU\sit;
use SIU\User;
use Carbon\Carbon;
use fpdf\FPDF;




class SitController extends Controller
{
    function listalideres ($status){
        if ($status =='todos'){
            $lista = lideres::bybarrio(Auth::user()->idbarrio)->withTrashed()->orderBy('nombre')->get();
        }
        elseif($status=='activos') {
            $lista = lideres::bybarrio(Auth::user()->idbarrio)->orderBy('nombre')->get();
        }
        elseif($status=='obispado') {
            $lista = lideres::whereraw("idbarrio=" . Auth::user()->idbarrio . " and organizacion in (9)")->orderBy('nombre')->get();
        }
        $lideres=array();
//        dd($lista);
        foreach($lista as $lider){
            $lideres[$lider->id]=$lider->conllamamiento;
        }
        $lideres[-1]="Agregar Nuevo";
        return $lideres;
    }

    public function barrios($id)
    {
        $barrios= barrios::orderBy('nombreunidad')->lists('nombreunidad','id');

        return response()->json($barrios);
    }
    public function nuevasolicitud()
    {
        $combo['estacas']= estacas::orderBy('nombre')->lists('nombre','id');
        $combo['barrios']= barrios::orderBy('nombreunidad')->lists('nombreunidad','id');
        $combo['llamamientos']=catalogos::bycatalogo('llamamiento')->orderby('nombre')->lists('nombre','id');
        $combo['organizacion']=catalogos::bycatalogo('organizacion')->orderby('nombre')->lists('nombre','id');
        $combo['tipopago']=catalogos::bycatalogo('tipopago')->orderby('nombre')->lists('nombre','id');



        return view('sit.solicitagasto',compact('combo'));
    }

    public function store(Request $request)
    {
        
        $rules=array('idestaca'=>'required',
            'idbarrio'=>'required',
//            'fecha'=>'required',
            'solicitante'=>'required',
            'mail'=>'required|email',
            'pagable'=>'required',
            'ife'=>'required|size:13',
            'descripcion'=>'required',
            'g-recaptcha-response' => 'required|captcha',
            'cantidad'=>'required|numeric',
            'organizaciongasto'=>'required',
            'tipopago'=>'required'
        );


        $this->validate($request,$rules);
        $request['token']=str_random(40);
        $request['solicitante']= Str::title($request['solicitante']);
        $request['pagable']=Str::title($request['pagable']);
        $request['descripcion']= Str::title($request['descripcion']);
        $request['fecha']=date('Y-m-d');

        $sit=sit::create($request->all());

        $sit->save();


        $barrio=barrios::findorfail($sit->idbarrio);


        Mail::send('emails.nuevasolicitud',['sit'=>$sit,'barrio'=>$barrio],function ($message) use ($barrio,$sit){
            $message->from($barrio->email,$barrio->nombreunidad);
            $message->subject('Registro de Solicitud');
            $message->to($sit->mail,$sit->solicitante);
        });


        return redirect()->route('solicitud',[$sit->id,$sit->token]);




    }

    public function status($id,$token)
    {
        $sit=sit::withTrashed()->findorfail($id);
        if ($sit->token != $token){
            abort(403);
        }

        $barrio=barrios::findorfail($sit->idbarrio);
        $archivossit=archivossit::where('idsit',$sit->id)->get();

//        dd($archivossit);
        return view('sit.status',compact('sit','barrio','archivossit'));

    }

    public function solicitudes()
    {
        $solicitudes=sit::bybarrio(auth()->user()->idbarrio)->where('status','63')->orderBy('fecha','desc')->orderby('id','DESC')->paginate(10);

        if(count($solicitudes)>0){
            return view('sit.solicitudes',compact('solicitudes'));    
        }
        else{
            \Session::flash('message','No se encontraron solicitudes');
            return redirect('/');
        }
        

    }

    public function editarsolicitud($id)
    {
        $sit=sit::findorfail($id);



        $this->authorize('updatebarrio', $sit);

        $combo['estacas']= estacas::orderBy('nombre')->lists('nombre','id');
        $combo['barrios']= barrios::orderBy('nombreunidad')->lists('nombreunidad','id');
        $combo['llamamientos']=catalogos::bycatalogo('llamamiento')->orderby('nombre')->lists('nombre','id');
        $combo['organizacion']=catalogos::bycatalogo('organizacion')->orderby('nombre')->lists('nombre','id');
        $combo['tipopago']=catalogos::bycatalogo('tipopago')->orderby('nombre')->lists('nombre','id');
        return view('sit.editarsolicitud',compact('sit','combo'));


    }
    public function updatesolicitud(Request $request,$id)
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
            'organizaciongasto'=>'required',
            'tipopago'=>'required'
//            'g-recaptcha-response' => 'required|captcha'
        );

        $this->validate($request,$rules);





        $sit =sit::findorfail($id);

        $this->authorize('updatebarrio', $sit);
//        dd($solicitud);
        $sit->fill($request->all());
//        dd($solicitud);
        $sit->save();

        \Session::flash('message','Se actualizo Correctamente la solicitud '.$sit->id);
        return \Redirect::route('solicitudes');
    }

    public function eliminarsolicitud(Request $request,$id){

        $user=User::findorfail($request->user()->id);
        $observaciones=$request->observaciones;
        ($observaciones==""?$observaciones="Cancelado por ".$user->name:$observaciones.=" Cancelado por ".$user->name);
        $request['observaciones']=$observaciones;
        $request['status']=64;
        $sit =sit::findorfail($id);

        $this->authorize('updatebarrio', $sit);
//        dd($solicitud);
        $sit->fill($request->all());

        $sit->save();

        $sit->delete();
        $barrio=barrios::findorfail($sit->idbarrio);

        //notificar
        Mail::send('emails.infosolicitud',['sit'=>$sit,'barrio'=>$barrio],function ($message) use ($barrio,$sit){
            $message->from($barrio->email,$barrio->nombreunidad);
            $message->subject('Solicitud De gasto '.$sit->idsit);
            $message->to($sit->mail,$sit->pagable);
        });

        \Session::flash('message','Se elimino Correctamente la solicitud '.$sit->id);
        return \Redirect::route('solicitudes');
    }

    public function crearsit($id){
        $sit=sit::findorfail($id);

        $this->authorize('updatebarrio', $sit);
        $combos['llamamientos']=catalogos::bycatalogo('llamamiento')->orderby('nombre')->lists('nombre','id');
        $combos['organizacion']=catalogos::bycatalogo('organizacion')->orderby('nombre')->lists('nombre','id');


        $combos['obispado']=$this->listalideres('obispado');
        $combos['lideres']=$this->listalideres('activos');
        $combos['categoria']=catalogos::bycatalogo('categoria')->orderby('nombre')->lists('nombre','id');

        return view('sit.crearsit',compact('sit','combos'));

    }

    public function guardarsit(Request $request,$id){
        $rules=array('fechasit'=>'required',
            'idsit'=>'required|numeric|unique:sit',
            'fechasit'=>'required',
            'categoria'=>'required',
            'pteorganizacion'=>'required',
            'obispo'=>'required'
        );

        $this->validate($request,$rules);





        $sit =sit::findorfail($id);

        $this->authorize('updatebarrio', $sit);
        $request['status']=65;
        $sit->fill($request->all());
        $sit->save();





        \Session::flash('message','Se actualizo Correctamente la solicitud '.$sit->id);
        return \Redirect::route('sits');
    }
    public function sits(Request $request){

        $combos['statussit']=catalogos::where('combo','statussolicitud')->lists('nombre','id');
        if(isset($_GET['parametros'])){


            $parametros=htmlspecialchars(Input::get("parametros"));

            $sits=sit::bybarrio(auth()->user()->idbarrio)
                ->where('pagable','like','%'.$parametros.'%')
                ->orwhere('solicitante','like','%'.$parametros.'%')
                ->orwhere('idsit','like','%'.$parametros)
                ->orderby('fechasit','desc')
                ->limit(20)
                ->paginate(20);

            return view('sit.sits',compact('sits','combos'));

        }
        else {
//        dd($combos['statussit']);

            $sits = sit::bybarrio(auth()->user()->idbarrio)->where('status', '<>', '63')->orderBy('fechasit', 'desc')->orderby('id', 'DESC')->paginate(10);
        }
        if(count($sits)>0){

            if($request->ajax()){
                return response()->json(view('layouts.sits',compact('sits','combos'))->render());
            }
            else {
                return view('sit.sits',compact('sits','combos'));
            }

        }
        else{
            \Session::flash('message','No se encontraron Sit en la unidad');
            return redirect('/');
        }
    }

    public function updatestatus(Request $request,$id){
        $sit=sit::findorfail($id);

        $this->authorize('updatebarrio', $sit);

        $sit->fill($request->all());
        $sit->save();


        if($sit->status==70){
            $barrio=barrios::findorfail($sit->idbarrio);


            Mail::send('emails.infosolicitud',['sit'=>$sit,'barrio'=>$barrio],function ($message) use ($barrio,$sit){
                $message->from($barrio->email,$barrio->nombreunidad);
                $message->subject('Solicitud De gasto');
                $message->to($sit->mail,$sit->solicitante);
            });
        }


        if($sit->status==64){
            $barrio=barrios::findorfail($sit->idbarrio);


            Mail::send('emails.infosolicitud',['sit'=>$sit,'barrio'=>$barrio],function ($message) use ($barrio,$sit){
                $message->from($barrio->email,$barrio->nombreunidad);
                $message->subject('Solicitud De gasto');
                $message->to($sit->mail,$sit->solicitante);
            });
        }


        return response()->json(['mensaje'=>'Se Actualizo el sit num '.$sit->idsit]);
    }

    public function editarsit($id){
        $sit=sit::findorfail($id);
        $this->authorize('updatebarrio', $sit);


        $archivossit=archivossit::where('idsit',$sit->id)->orderby('created_at')->paginate(30);

//        dd($archivossit[0]->nombrearchivo);
        $combos['llamamientos']=catalogos::bycatalogo('llamamiento')->orderby('nombre')->lists('nombre','id');
        $combos['organizacion']=catalogos::bycatalogo('organizacion')->orderby('nombre')->lists('nombre','id');


        $combos['obispado']=$this->listalideres('obispado');
        $combos['lideres']=$this->listalideres('activos');
        $combos['categoria']=catalogos::bycatalogo('categoria')->orderby('nombre')->lists('nombre','id');
        $combos['tipopago']=catalogos::bycatalogo('tipopago')->orderby('nombre')->lists('nombre','id');
        $combos['statussit']=catalogos::where('combo','statussolicitud')->lists('nombre','id');

        return view('sit.editarsit',compact('sit','combos','archivossit'));

        
    }
    
    
    public function updatesit(Request $request,$id){

        $sit=sit::findorfail($id);
        $this->authorize('updatebarrio', $sit);
//dd($request->all());
        $rules=array('fechasit'=>'required',
            'solicitante'=>'required',
            'pagable'=>'required',
            'mail'=>'required|email',
            'ife'=>'required',
            'descripcion'=>'required',
            'cantidad'=>'required',
            'organizaciongasto'=>'required',
            'categoria'=>'required',
            'tipopago'=>'required',
            'status'=>'required',
            'pteorganizacion'=>'required',
            'obispo'=>'required'
        );

        $validate= $this->validate($request,$rules);

        $request['solicitante']= Str::title($request['solicitante']);
        $request['pagable']=Str::title($request['pagable']);
        $request['descripcion']= Str::title($request['descripcion']);



        $sit->fill($request->all());

        $sit->save();

        \Session::flash('message','Se actualizo Correctamente el SIT '.$sit->idsit);
        return \Redirect::route('editarsit',[$sit->id]);


    }

    public function pdf($id,$tipo,$modo,$token)
    {
        $sit =sit::findorfail($id);


        if ($sit->token != $token){
            abort(403);
        }


        $cantidad = number_format($sit->cantidad, 2, '.', ',');

        $importeletra = \NumeroALetras::convertir($cantidad, 'Pesos', 'Centavos');

//dd($solicitud->datossit->PteorganizacionNombre);


//
        $pdf = new FPDF();
        $pdf->AddPage("P", "letter");

//        para sit
        if ($tipo == 'completo' || $tipo == 'sit') {

            $pdf->SetFont("helvetica", "B", 20);
            $pdf->Image("imagenes/LOGO_LDS" . ".png", 10, 7, 50, 30);
            $pdf->Image(asset($sit->datosbarrio->datosbanco->rutalogo), 150, 15, 60, 15);
            $pdf->ln(8);
//        $pdf->Cell(70, 5, "", 0, 0, "C");
            $pdf->Cell(200, 5, "Cobro de SIT", 0, 1, "C");
            $pdf->ln(5);
            $pdf->Cell(200, 5, utf8_decode($sit->datosbarrio->nombreunidad), 0, 1, "C");
            $pdf->ln(10);
            $pdf->SetFont("helvetica", "", 15);
            $pdf->Cell(60, 5, utf8_decode("Convenio"), 0, 0, "C");
            $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
            $pdf->Cell(60, 5, utf8_decode("Referencia"), 0, 0, "C");
            $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
            $pdf->Cell(60, 5, utf8_decode("Concepto"), 0, 1, "C");
            $pdf->SetFont("helvetica", "B", 15);
            $pdf->ln(2);
            $pdf->Cell(60, 5, utf8_decode($sit->datosbarrio->datosbanco->convenio), "B", 0, "C");
            $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
            $pdf->Cell(60, 5, utf8_decode($sit->idsit), "B", 0, "C");
            $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
            $pdf->Cell(60, 5, utf8_decode($sit->idsit), "B", 1, "C");
            $pdf->ln(5);
            $pdf->SetFont("helvetica", "", 15);
            $pdf->Cell(200, 5, utf8_decode("Nombre del Beneficiario"), 0, 1, "C");
            $pdf->ln(2);
            $pdf->SetFont("helvetica", "B", 15);
            $pdf->Cell(200, 5, utf8_decode($sit->pagable), "B", 1, "C");


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
            $pdf->Cell(110, 5, utf8_decode($sit->descripcion), "B", 0, "C");
            $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
            $pdf->Cell(80, 5, utf8_decode($sit->fechamda), "B", 1, "C");
            $pdf->SetFont("helvetica", "", 12);
            $pdf->ln(3);
            $pdf->Cell(80, 5, utf8_decode("Pagable"), 0, 0, "C");
            $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "C");
            $pdf->Cell(55, 5, utf8_decode("Categoria"), 0, 0, "C");
            $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "C");
            $pdf->Cell(55, 5, utf8_decode("Tipo"), 0, 1, "C");
            $pdf->ln(2);
            $pdf->SetFont("helvetica", "B", 12);
            $pdf->Cell(80, 5, utf8_decode($sit->pagable), "B", 0, "C");
            $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "C");
            $pdf->Cell(55, 5, utf8_decode($sit->categorianombre), "B", 0, "C");
            $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "C");
            $pdf->Cell(55, 5, utf8_decode($sit->tipopagodsc), "B", 1, "C");

            $pdf->ln(3);
            $pdf->Cell(40, 5, utf8_decode("Organizacion"), 0, 0, "C");
            $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "C");
            $pdf->Cell(40, 5, utf8_decode("Monto"), 0, 0, "C");
            $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "C");
            $pdf->Cell(110, 5, utf8_decode("Importe en letra"), 0, 1, "C");
            $pdf->ln(2);
            $pdf->SetFont("helvetica", "B", 12);
            $pdf->Cell(40, 5, utf8_decode($sit->organizacionnombre), "B", 0, "C");
            $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "C");
            $pdf->Cell(40, 5, utf8_decode($cantidad), "B", 0, "C");
            $pdf->Cell(5, 5, utf8_decode(""), 0, 0, "C");
            $pdf->Cell(110, 5, utf8_decode($importeletra), "B", 1, "C");

            $pdf->ln(5);
            $pdf->SetFont("helvetica", "B", 12);
            $pdf->Cell(120, 5, utf8_decode($sit->solicitante), 0, 0, "C");
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
            $pdf->Cell(120, 5, utf8_decode($sit->pteorganizacionnombre), 0, 0, "C");
            $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
            $pdf->Cell(70, 5, utf8_decode(""), 0, 1, "C");
            $pdf->ln(2);
            $pdf->SetFont("helvetica", "", 12);
            $pdf->Cell(120, 5, utf8_decode("Presidente de la Organizacion"), "T", 0, "C");
            $pdf->Cell(10, 5, utf8_decode(""), 0, 0, "C");
            $pdf->Cell(70, 5, utf8_decode("Firma"), "T", 1, "C");


            $pdf->ln(5);
            $pdf->SetFont("helvetica", "B", 12);
            $pdf->Cell(120, 5, utf8_decode($sit->obisponombre), 0, 0, "C");
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
            $pdf->Cell(60, 5, utf8_decode($sit->idsit), "B", 1, "C");
        }

//        dd($evento);
        if ($modo == 'enviar') {
//            $nombre='Sit_'.$sit->idsit.'.pdf';
//            $descripcion='SIT '.$sit->idsit;
//            $data=$sit;
//            $modulo='sit';
//            return view('emails.enviarcorreo',compact('nombre','descripcion','data','modulo'));
        } else if ($modo == 'descargar') {
            $pdf->Output($sit->nombrearchivo, "D");
        } else if ($modo == "ver") {
            $pdf->Output($sit->nombrearchivo, "I");
        } else if ($modo == 'cadena') {
            $reporte = $pdf->Output($sit->nombrearchivo, "S");
            return $reporte;
        }


    }

    public function uploadfileexterno(Request $request,$token)
    {
//        dd($request->idsit);
        $sit=sit::findorfail($request->idsit);

        if($sit->token!=$token){
            abort(403);
        }
        else{
            $rules=array('idsit'=>'required',
                'nombrearchivo'=>'required',
//                'descripcionarchivo'=>'required',
                'montoarchivo'=>'numeric',
                'archivo'=>'required');
            $validate=$this->validate($request,$rules);


            $nombre=$request->nombrearchivo;
            $nombre=str_replace(" ","_",$nombre);

            $fecha = Carbon::now();
            $fecha = $fecha->format('Ymd_Hms');


            //obtenemos el campo file definido en el formulario
            $file = $request->file('archivo');

//        dd($file);

            //obtenemos el nombre del archivo

            $extension=$file->getClientOriginalExtension();




            $fileName =$sit->id."_".$sit->idsit."_".$nombre."_".$fecha.".".$extension; // renameing image


            $destino=public_path('archivossit');

            //indicamos que queremos guardar un nuevo archivo en el disco local
            $upload_success = $file->move($destino, $fileName);

            if($extension=='xml'){
//                dd($destino.'/'.$archivosit->rutaarchivo);

                $xml = simplexml_load_file($destino.'/'.$fileName);

                if(isset($xml['total'])){
                    $request['montoarchivo']=$xml['total'];
                }



            }

            if($upload_success){
                $request['rutaarchivo']=$fileName;
                $request['tipoarchivo']=$extension;
                $request['tokenarchivo']=str_random(40);
                if(!Auth::guest()){
                    $request['subidopor']=Auth::user()->id;
                }
                else{
                    $request['subidopor']=$sit->mail;
                }

                $archivosit=new archivossit($request->all());


                $archivosit->save();





                \Session::flash('message','el Archivo se Guardo Correctamente');
                return redirect()->route('solicitud',[$sit->id,$sit->token]);

            }
            else{
                \Session::flash('error','No se subio el archivo');
                return redirect()->route('solicitud',[$sit->id,$sit->token]);
            }
        }



    }

    public function uploadfile(Request $request)
    {

        $id=$request['idsit'];

        $sit=sit::findorfail($id);
        $this->authorize('updatebarrio', $sit);


        $rules=array('idsit'=>'required',
            'nombrearchivo'=>'required',
            'descripcionarchivo'=>'required',
            'montoarchivo'=>'numeric',
            'archivo'=>'required');
        $validate=$this->validate($request,$rules);


        $nombre=$request->nombrearchivo;
        $nombre=str_replace(" ","_",$nombre);

        $fecha = Carbon::now();
        $fecha = $fecha->format('Ymd_Hms');


        //obtenemos el campo file definido en el formulario
        $file = $request->file('archivo');

//        dd($file);

        //obtenemos el nombre del archivo

        $extension=$file->getClientOriginalExtension();




        $fileName =$sit->id."_".$sit->idsit."_".$nombre."_".$fecha.".".$extension; // renameing image


        $destino=public_path('archivossit');

        //indicamos que queremos guardar un nuevo archivo en el disco local
        $upload_success = $file->move($destino, $fileName);

        if($extension=='xml'){
//                dd($destino.'/'.$archivosit->rutaarchivo);

            $xml = simplexml_load_file($destino.'/'.$fileName);

            if(isset($xml['total'])){
                $request['montoarchivo']=$xml['total'];
            }



        }

        if($upload_success){
            $request['rutaarchivo']=$fileName;
            $request['tipoarchivo']=$extension;
            $request['tokenarchivo']=str_random(40);
            if(!Auth::guest()){
                $request['subidopor']=Auth::user()->id;
            }
            else{
                $request['subidopor']=0;
            }

            $archivosit=new archivossit($request->all());


            $archivosit->save();





            \Session::flash('message','el Archivo se Guardo Correctamente');
            return redirect()->route('editarsit',$sit->id);

        }
        else{
            \Session::flash('error','No se subio el archivo');
            return redirect()->route('editarsit',$sit->id);
        }

    }

    public function  destroyfile($id){
        $archivosit=archivossit::findorfail($id);
        $archivosit->delete();

        return redirect()->back();
    }

    public function updatevalidadopor(Request $request,$id){
        $archivosit=archivossit::findorfail($id);
        $this->authorize('updatebarrioarchivo', $archivosit);

        if($request['validadopor']==1){
            $request['validadopor']=$request->user()->id;

        }
        $archivosit->fill($request->all());

        $archivosit->save();
        return response()->json(['mensaje'=>'Se Actualizo el Archivo ID => '.$archivosit->id]);
    }



}
