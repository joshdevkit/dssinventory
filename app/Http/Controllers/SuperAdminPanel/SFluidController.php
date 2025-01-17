<?php

namespace App\Http\Controllers\SuperAdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Fluid;
use Illuminate\Http\Request;

class SFluidController extends Controller
{
    public function index()
    {
        $fluids = Fluid::all();

        return view('superadmin.fluid.index', compact('fluids'));
    }
}
