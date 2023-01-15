<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\RecruiteRequest;

use App\Models\Recruite;

use App\Models\Emotion;

use App\Models\Recommendation;

class RecruiteController extends Controller
{
    public function index(Recruite $recruite)
    {
        return view('posts/recruite/index')->with([
            'recruites'=>$recruite->getPaginate()
        ]);
    }
    
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
        
        return redirect('/recruite/index');
    }
    
    public function auth_user(Recruite $recruite, Emotion $emotion)
    {
        $user_id = Auth::user()->id;
        return view('posts/recruite/auth_user')->with([
            'recruites' => $recruite->getUserPaginate($user_id)
        ]);
    }
    
    public function each_user(Recruite $recruite, $user_id)
    {
        return view('posts/recruite/each_user')->with([
            'recruites'=>$recruite->getUserPaginate($user_id),
            'user_id'=>$user_id
        ]);
    }
    
    
}
