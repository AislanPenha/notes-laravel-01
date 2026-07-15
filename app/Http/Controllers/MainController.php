<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    function login($value) {
        echo 'oi';

        //return view('main')->with('nome', 'Aislan');
        // return view('main')->with('idade', '55');
        // return view('main')->with('sexo', 'Masculino');
    }

    function page2($value) {
        return view('page2', ['valor' => $value]);
    }

    function page3($value) {
        return view('page3', ['valor' => $value]);
    }
}
