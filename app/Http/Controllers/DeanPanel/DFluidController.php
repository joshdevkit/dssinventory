<?php

namespace App\Http\Controllers\DeanPanel;

use App\Http\Controllers\Controller;
use App\Models\Fluid;
use Illuminate\Http\Request;

class DFluidController extends Controller
{
    public function index()
    {
        $fluids = Fluid::with('items')->get();

        return view('dean.fluid.index', compact('fluids'));
    }
}
