<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Profile extends Controller
{
    public function index()
    {
        return view('global.profile.index');
    }

    public function editPassword()
    {
        return view('global.profile.edit_password');
    }
}
