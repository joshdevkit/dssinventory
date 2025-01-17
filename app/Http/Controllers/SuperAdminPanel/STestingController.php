<?php

namespace App\Http\Controllers\SuperAdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Testing;
use Illuminate\Http\Request;

class STestingController extends Controller
{
    public function index()
    {
        $testings = Testing::all();

        return view('superadmin.testing.index', compact('testings'));
    }
}
