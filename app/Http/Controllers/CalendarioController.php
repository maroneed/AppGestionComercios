<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    public function index()
    {
        return view('/calendar');
    }
}
