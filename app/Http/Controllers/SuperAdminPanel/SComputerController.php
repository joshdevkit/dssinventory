<?php

namespace App\Http\Controllers\SuperAdminPanel;

use App\Http\Controllers\Controller;
use App\Models\ComputerEngineering;
use Illuminate\Http\Request;

class SComputerController extends Controller
{
    public function index()
    {
        $computerEngineering = ComputerEngineering::all();

        return view('superadmin.computer_engineering.index', compact('computerEngineering'));
    }
}
