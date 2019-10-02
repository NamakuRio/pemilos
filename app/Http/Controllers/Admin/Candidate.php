<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Candidate extends Controller
{
    public function index()
    {
        return view('admin.candidate.index');
    }

    protected function getCandidate()
    {

    }
}
