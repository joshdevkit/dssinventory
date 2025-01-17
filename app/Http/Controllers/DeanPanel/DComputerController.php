<?php

namespace App\Http\Controllers\DeanPanel;

use App\Http\Controllers\Controller;
use App\Models\ComputerEngineering;
use Illuminate\Http\Request;

class DComputerController extends Controller
{
    public function index()
    {
        $computerEngineering = ComputerEngineering::with('items')->get();

        return view('dean.computer_engineering.index', compact('computerEngineering'));
    }
}
