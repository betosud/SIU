<?php

namespace SIU\Http\Controllers;

use Illuminate\Http\Request;

use SIU\Http\Requests;

class BautizmalController extends Controller
{
    public function create(){
        return view('bautizmal.nuevo');
    }
}
