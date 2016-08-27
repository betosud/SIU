<?php

namespace SIU\Http\Controllers;

use Illuminate\Http\Request;

use SIU\Http\Requests;
use SIU\Http\Controllers\Controller;
use SIU\asignaciones;
use SIU\barrios;
use SIU\correosenviados;
use SIU\discursos;
use SIU\entrevistas;
use Illuminate\Support\Facades\Mail;
use SIU\solicitudes;

class EnviarCorreoController extends Controller
{
    public function enviarcorreo(Request $request,$id,$modulo)
    {
        //

        $rules=array('nombre'=>'required',
            'email'=>'required|email');
        $validacion= $this->validate($request,$rules);





//        else if ($modulo=='asignacion'){
//            $data = asignaciones::findorfail($id);
//            $pdf= route('pdfasignacion',[$data->id,'cadena']);
//        }
//
//        else if ($modulo=='sit'){
//            $data = Sit::findorfail($id);
//            $pdf= route('pdfsit',[$data->id,'completo','cadena']);
//
//        }
//
        if ($modulo=='entrevista'){
            $data = entrevistas::findorfail($id);
            $nombrearchivo=$data->nombrearchivo.".pdf";
            $pdf= url('entrevistaview',[$data->id,'cadena',$data->token]);
            $descripcion="Cita Para Entrevista";
            $nombre=$request->nombre;
        }

        elseif ($modulo=='asignacion'){
            $data = asignaciones::findorfail($id);
            $nombrearchivo=$data->nombrearchivo.".pdf";
            $pdf= route('pdfasignacion',[$data->id,'cadena',$data->token]);
            $descripcion="Asignacion del Barrio";
            $nombre=$request->nombre;
        }
        else if($modulo=='discurso') {
            $data = discursos::findorfail($id);
            $nombrearchivo=$data->nombrearchivo.".pdf";
            $pdf= route('pdfdiscurso',[$data->id,'cadena',$data->token]);
            $descripcion="Asignacion de discurso";
            $nombre=$request->nombre;
        }

//        else if($modulo=='sit') {
//            $data =solicitudes::findorfail($id);
//            $nombrearchivo=$data->nombrearchivo;
//            $pdf= route('pdfsit',[$data->id,'completo','cadena']);
//            $descripcion="Asignacion de Sit";
//            $nombre=$request->nombre;
//        }

        $barrio=barrios::findorfail($data->idbarrio);
        $pdffile=file_get_contents($pdf);

        $resul= Mail::send('emails.enviar',['data'=>$data,'ward'=>$barrio,'descripcion'=>$descripcion,'modulo'=>$modulo],function ($message) use ($barrio,$request,$pdffile,$nombre,$descripcion,$nombrearchivo){

            $message->from($barrio->email,$barrio->nombreunidad);
            $message->subject($descripcion);
            $message->to($request->email,$request->nombre);
            $message->attachData($pdffile, $nombre,$options = array('as' => $nombrearchivo,'mime' => 'application/pdf'));
        });
//        $correoenviado= new correosenviados($request->all());
//        $correoenviado['idbarrio']=$data->idbarrio;
//        $correoenviado['descripcion']=$descripcion;
//        $correoenviado->save();
        return response()->json([
            'error'=>$validacion,'salida'=>$resul
        ]);
    }
}
