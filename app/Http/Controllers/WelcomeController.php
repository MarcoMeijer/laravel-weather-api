<?php

namespace App\Http\Controllers;

use App\Services\Weather;

class WelcomeController extends Controller
{
    public function index()
    {
        $weather = new Weather;
        $forecast = $weather->forecast('Barcelona');
        return view('welcome', compact('forecast'));
    }
}
