<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TeamController extends Controller
{
    public function index()
    {
        $doctors = User::where('rol', 'doctor')->get();
        $receptionists = User::where('rol', 'receptionist')->get();

        return view('teams.index', compact('doctors', 'receptionists'));
    }
}
