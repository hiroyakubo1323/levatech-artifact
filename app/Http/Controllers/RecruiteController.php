<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecruiteController extends Controller
{
    function create()
    {
        return view('posts/recruite/create');
    }
}
