<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Calculation extends Controller
{
    public function index()
    {
        return view('admin.calculation.index');
    }

    protected function getCalculation()
    {

    }
}
