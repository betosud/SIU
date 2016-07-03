<?php

namespace SIU\Http\Controllers;

use Illuminate\Http\Request;

use SIU\himnos;
use SIU\Http\Requests;

class HimnosController extends Controller
{
    public function getautocompletarhimnos($valor)
    {
        $result=array();
        $himnos = himnos::select('numero', 'nombre', 'himnario')
            ->where('numero', 'like',$valor.'%')
            ->orwhere('nombre', 'like','%'.$valor.'%')
            ->get();

        foreach ($himnos as $himno)
        {
            $result[]=$himno->numero." - ".$himno->nombre." (".$himno->himnario.")";
        }

        echo json_encode($result);
//return Response::json($result);

    }
}
