<?php

namespace SIU\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use SIU\Http\Requests;
use GuzzleHttp\Client;
use SIU\Http\Controllers\Controller;

class ApiCalendarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function eventosestaca()
    {
        $client = new \Google_Client();
        $client->setApplicationName("calendario");
        $client->setDeveloperKey("AIzaSyCWNBlnKa5507bm-ACF2iEVoFCXL3ysOrQ");

        $service = new \Google_Service_Calendar($client);

        $fecha=Carbon::create()->now();
        $optParams = array('singleEvents'=>true, 'orderBy'=>'startTime', 'timeMin'=>$fecha->toRfc3339String(), 'maxResults'=>5);

        $results = $service->events->listEvents('bt9imag1pljia49foievrvntq0@group.calendar.google.com',$optParams);

//dd($results);
        foreach ($results->getItems() as $eventos){
            echo $eventos->summary." Descripcion ".$eventos->description." hora ".$eventos->start->dateTime."<br>";
        }


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
