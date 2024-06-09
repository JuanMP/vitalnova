<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use App\Models\Review;

class HomeController extends Controller
{
    public function index()
    {
        $specialties = Specialty::all();
        $latestReviews = Review::latest()->take(4)->get();
        return view('index', compact('specialties', 'latestReviews'));

    }


}
