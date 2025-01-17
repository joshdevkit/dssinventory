<?php

namespace App\Http\Controllers\SuperAdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Surveying;
use Illuminate\Http\Request;

class SSurveyingController extends Controller
{
    public function index()
    {
        $surveyings = Surveying::all();

        return view('superadmin.surveying.index', compact('surveyings'));
    }
}
