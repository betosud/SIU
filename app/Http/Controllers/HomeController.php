<?php

namespace SIU\Http\Controllers;

use Carbon\Carbon;
use SIU\Http\Requests;
use Illuminate\Http\Request;

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

        $client = new \Google_Client();
        $client->setApplicationName("calendario");
        $client->setDeveloperKey("AIzaSyCWNBlnKa5507bm-ACF2iEVoFCXL3ysOrQ");

        $service = new \Google_Service_Calendar($client);

        $fecha=Carbon::create()->now();
        $optParams = array('singleEvents'=>true, 'orderBy'=>'startTime', 'timeMin'=>$fecha->toRfc3339String(), 'maxResults'=>5);

        $results = $service->events->listEvents('bt9imag1pljia49foievrvntq0@group.calendar.google.com',$optParams);
        $respuesta=array();
        foreach ($results->getItems() as $eventos){
            $registro="";
            if(isset($eventos->start->dateTime)) {

                $inicio=explode("T",$eventos->start->dateTime);

//                    dd(explode(":",$inicio[1])[1]);
                $startdate= Carbon::create(explode("-",$inicio[0])[0],explode("-",$inicio[0])[1],explode("-",$inicio[0])[2],explode(":",$inicio[1])[0],explode(":",$inicio[1])[1],"00","America/Mexico_City");
                $registro=$eventos->summary;
                $registro .= " Fecha " . $startdate->format("l d M Y");
                $registro .= " Hora ".$startdate->format("h:m a");
            }
            elseif (isset($eventos->start->date)){
                $inicio=$eventos->start->date;
                $startdate=Carbon::createFromDate(explode("-",$inicio)[0],explode("-",$inicio)[1],explode("-",$inicio)[2]);
                $registro=$eventos->summary;
                $registro .= " Fecha " . $startdate->format("l d M Y");
            }

            $respuesta[]= $registro;
        }

//        if(! Auth::guest()) {
//            $solicitudes = solicitudes::bybarrio(auth()->user()->idbarrio)->where('status', '<>', '66')->get();
//
//            $countsolicitudes = count($solicitudes);
//        }

//dd($respuesta);
        return view('welcome',compact('respuesta'));

    }
}
