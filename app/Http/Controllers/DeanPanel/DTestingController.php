<?php

namespace App\Http\Controllers\DeanPanel;

use App\Http\Controllers\Controller;
use App\Models\Testing;
use Illuminate\Http\Request;

class DTestingController extends Controller
{
    public function index()
    {
        $testings = Testing::with('items')->get();

        return view('dean.testing.index', compact('testings'));
    }
}
