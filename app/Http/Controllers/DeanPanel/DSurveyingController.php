<?php

namespace App\Http\Controllers\DeanPanel;

use App\Http\Controllers\Controller;
use App\Models\Surveying;
use Illuminate\Http\Request;

class DSurveyingController extends Controller
{
    public function index()
    {
        $surveyings = Surveying::with('items')->get();

        return view('dean.surveying.index', compact('surveyings'));
    }
}
