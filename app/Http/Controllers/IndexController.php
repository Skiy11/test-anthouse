<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{
    public function getEnrolleesList()
    {
        return view('section.list');
    }

    public function registration()
    {
        return view('section.registration');
    }
}
