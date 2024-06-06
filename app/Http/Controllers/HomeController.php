<?php

namespace App\Http\Controllers;

use App\Models\Specialty;

class HomeController extends Controller
{
    public function index()
    {
        $specialties = Specialty::all();
        return view('index', compact('specialties'));
    }


}
