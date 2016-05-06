<?php

namespace SIU\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use SIU\Http\Requests;
use SIU\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
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

//dd($results);
        $respuesta=array();
        foreach ($results->getItems() as $eventos){
//            dd($eventos->start->dateTime);

            $inicio=explode("T",$eventos->start->dateTime,2);
            $fin=explode("T",$eventos->start->dateTime,2);
//            dd(explode(":",$inicio[1],3)[0]);
            $startdate=Carbon::create(explode("-",$inicio[0],3)[0],explode("-",$inicio[0],3)[1],explode("-",$inicio[0],3)[2],explode(":",$inicio[1],3)[0],explode(":",$inicio[1],3)[1],0,"UTC");
            $enddate=Carbon::create(explode("-",$fin[0],3)[0],explode("-",$fin[0],3)[1],explode("-",$fin[0],3)[2],explode(":",$fin[1],3)[0],explode(":",$fin[1],3)[1],0,"America/Mexico_City");

//            dd($startdate);
            $registro="";

            $registro=$eventos->summary;
            if ($startdate !="") {
                $registro .= " Fecha " . $startdate->format("l d M Y");
                $registro .= " Hora " . $startdate->format("h:m A");
            }



            $respuesta[]= $registro;
        }


//        dd($respuesta);
        return view('welcome',compact('respuesta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
