<?php

namespace SIU\Http\Controllers;

use Illuminate\Http\Request;
use SIU\Http\Controllers\Route;

use SIU\Http\Requests;

class SacramentalController extends Controller
{
    public function add(Request $request){



        $url=url('eventos',[$request->user()->idbarrio,6]);
        //obtener eventos del calendario
        $client = new \GuzzleHttp\Client();
        $responsebarrio = $client->request('GET', $url, [
            'headers' => ['user' => env('USERAPISIU'),'apikey'=>env('APIKEYSIU')]
        ]);



        if($request->user()->datos->idestaca!=$request->user()->idbarrio) {

            $url = url('eventos', [$request->user()->datos->idestaca, 6]);
            //obtener eventos del calendario
            $client = new \GuzzleHttp\Client();
            $responseestaca = $client->request('GET', $url, [
                'headers' => ['user' => env('USERAPISIU'), 'apikey' => env('APIKEYSIU')]
            ]);
        }

        $databarrio=json_decode($responsebarrio->getBody()->getContents());
        $dataestaca=json_decode($responseestaca->getBody()->getContents());
        $anucnios_sacramental=array();
        $totaleventos=0;
        if(count($dataestaca->datos)>0){
            foreach ($dataestaca->datos as $evento){
                $anucnios_sacramental[$totaleventos]=$evento;
                $totaleventos++;
            }
        }
        if(count($databarrio->datos)>0){
            foreach ($databarrio->datos as $evento){
                $anucnios_sacramental[$totaleventos]=$evento;
                $totaleventos++;
            }
        }
        return view('sacramentales.nuevo.nuevo',compact('anucnios_sacramental'));

    }
    public function store(Request $request){
        dd($request->all());

    }
}
