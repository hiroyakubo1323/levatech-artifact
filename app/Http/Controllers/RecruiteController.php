<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\RecruiteRequest;

use App\Models\Recruite;

class RecruiteController extends Controller
{
    public function create()
    {
        return view('posts/recruite/create');
    }
    
    public function store($user_id, RecruiteRequest $request, Recruite $recruite)
    {
        $input_recruite = $request['recruite'];
        
        $recruite -> fill($input_recruite);
        $recruite->user_id = $user_id;
        $recruite->save();
        
        return redirect('/');
    }
    
}
