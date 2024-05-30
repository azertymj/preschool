<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function add(){
        return view('teacher.add');
    }

    public function edit(){
        return view('teacher.edit');
    }

    public function list(){
        return view('teacher.list');
    }

    public function view(){
        return view('teacher.view');
    }
}
