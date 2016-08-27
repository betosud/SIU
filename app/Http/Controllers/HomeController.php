<?php

namespace SIU\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Mockery\CountValidator\Exception;
use SIU\archivossit;
use SIU\barrios;
use SIU\Http\Requests;
use Illuminate\Http\Request;
use SIU\sit;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {

            if(!Auth::guest()){

                $url=url('eventos',[528633,4]);
                //obtener eventos del calendario
                $client2 = new \GuzzleHttp\Client();
                $responseestaca = $client2->request('GET', $url, [
                    'headers' => ['user' => env('USERAPISIU'),'apikey'=>env('APIKEYSIU')]
                ]);
                $eventosestaca=json_decode($responseestaca->getBody()->getContents(),true);


                $url=url('eventos',[Auth::user()->idbarrio,4]);
                //obtener eventos del calendario
                $client2 = new \GuzzleHttp\Client();
                $responsebarrio = $client2->request('GET', $url, [
                    'headers' => ['user' => env('USERAPISIU'),'apikey'=>env('APIKEYSIU')]
                ]);
                $eventosbarrio=json_decode($responsebarrio->getBody()->getContents(),true);
            }
//            dd($databarrio);

        }
        catch (Exception $e){
        
    }
        finally{
            $sinvalidar=array();
            $sits=array();
            $solicitudes=array();
            if(!Auth::guest()) {
                $solicitudes = sit::bybarrio(auth()->user()->idbarrio)->where('status', '63')->orderBy('fecha', 'desc')->orderby('id', 'DESC')->get();

//                $totalsolicitudes = count($solicitudes);
                $sits=sit::bybarrio(auth()->user()->idbarrio)->wherein('status',array(65,66,68,70))->get();
                $validaradjuntos=sit::bybarrio(auth()->user()->idbarrio)->orderBy('fecha', 'asc')->orderby('id', 'asc')->get();

//                dd($validaradjuntos);


                foreach ($validaradjuntos as $sit){
                    foreach ($sit->comprobantes as $comprobante){
                        if($comprobante->validadopor==0){
                            $sinvalidar[$sit->id]=$sit;
                        }
                    }
                }
                $barrio=barrios::findorfail(Auth::user()->idbarrio);

            }

        $estaca=barrios::findorfail(528633);
//dd($estaca);

        return view('welcome',compact('eventosestaca','sits','eventosbarrio','sinvalidar','estaca','barrio','solicitudes'));


        }
    }
}
