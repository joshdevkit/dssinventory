<?php

namespace App\Http\Controllers\SuperAdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Construction;
use Illuminate\Http\Request;

class SConstructionController extends Controller
{
    public function index()
    {
        $constructions = Construction::all();

        return view('superadmin.construction.index', compact('constructions'));
    }
}
