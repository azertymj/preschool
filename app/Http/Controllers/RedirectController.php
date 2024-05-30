<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function add(){
        $documents = Document::all();
        return view('teacher.add');
    }

    public function edit(){
        $documents = Document::all();
        return view('teacher.edit');
    }

    public function list(){
        $documents = Document::all();
        return view('teacher.list', compact('documents'));
    }

    public function view(){
        $documents = Document::all();
        return view('teacher.view');
    }
}
