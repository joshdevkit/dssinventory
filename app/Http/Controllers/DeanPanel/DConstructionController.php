<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\DeanPanel;

use App\Http\Controllers\Controller;
use App\Models\Construction;
use Illuminate\Http\Request;

class DConstructionController extends Controller
{
    public function index()
    {
        $constructions = Construction::with('items')->get();

        return view('dean.construction.index', compact('constructions'));
    }
}
