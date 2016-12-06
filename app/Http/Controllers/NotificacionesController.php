<?php

namespace SIU\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use SIU\asignaciones;
use SIU\barrios;
use SIU\discursos;
use SIU\entrevistas;
use SIU\Http\Requests;
use SIU\lideres;
use SIU\MailsEnviados;
use SIU\role_user;
use SIU\sit;
use SIU\User;

class NotificacionesController extends Controller
{
    function sits (){


        


            $unidades=barrios::all();
//        $unidades=barrios::where('id','362492')->orwhere('id','123456')->get();


        foreach ($unidades as $unidad){



            //obtener suarios para notificar
            $idbarrio=$unidad->id;



//            $usuarios=User::bybarrio($idbarrio)->get();

            $usuarios=User::where('idbarrio',$idbarrio)->get();

            $rolenotificar=array(1,2,4,5,7);
            $usuariosnotificar=array();
            foreach ($usuarios as $usuario){
                if(in_array($usuario->rolid,$rolenotificar)){
                    $usuariosnotificar[]=$usuario;
                }
            }


            if(count($usuariosnotificar)>0) {

                //buscar sits sin
                $valores = array();
                $notificar = array();
                $sinvalidar = array();
                $datos = sit::resumen($idbarrio);

                //totales de sits
                foreach ($datos as $dato) {
                    if ($dato->status == 63 || $dato->status == 65 || $dato->status == 70 || $dato->status == 72 || $dato->status == 73) {
                        $valores[$dato->statusdsc] = $dato->total;
                    }


                }
                $notificar['sitstabla'] = $valores;

                //buscar Solicitudes
                $notificar['solicitudes'] = sit::bybarrio($idbarrio)->where('status', '63')->orderBy('fecha', 'desc')->orderby('id', 'DESC')->get();

                //archivos sin validar
                $validaradjuntos = sit::bybarrio($idbarrio)->orderBy('fecha', 'asc')->orderby('id', 'asc')->get();

//                dd($validaradjuntos);


                foreach ($validaradjuntos as $sit) {
                    foreach ($sit->comprobantes as $comprobante) {
                        if ($comprobante->validadopor == 0) {
                            $sinvalidar[$sit->id] = $sit;
                        }
                    }
                }
                $notificar['sinvalidar'] = $sinvalidar;

                //criticos
                $notificar['criticos'] = sit::bybarrio($idbarrio)->wherein('status', array(65, 66, 68, 70))->get();
                $fecha = Carbon::today();
                $domingo = Carbon::today();
                $domingo->next(0);
                $notificar['asignaciones'] = asignaciones::bybarrio($idbarrio)->whereBetween('fecha', array($fecha, $domingo))->get();
                $notificar['entrevistas'] = entrevistas::bybarrio($idbarrio)->whereBetween('fecha', array($fecha, $domingo))->get();
                $notificar['discursos'] = discursos::bybarrio($idbarrio)->whereBetween('fecha', array($fecha, $domingo))->get();
//dd($notificar['entrevistas'][0]->entrevistadordatos->nombre);
                foreach ($usuariosnotificar as $user) {

                    Mail::send('emails.notificarsiu', ['notificar' => $notificar, 'usuario' => $user, 'barrio' => $unidad], function ($message) use ($notificar, $user, $unidad) {
                        $message->from($unidad->email, $unidad->nombreunidad);
                        $message->subject('Notificaciones SIU');
                        $message->to($user->email, $user->name);
                    });
                    $mailenviado=new MailsEnviados(['idbarrio'=>$unidad->id,'to'=>$user->email,'for'=>$unidad->email,'name'=>$user->name,'subjet'=>'Envio notificacion automatica']);
                    $mailenviado->save();
                }
            }

        }



    }
}
