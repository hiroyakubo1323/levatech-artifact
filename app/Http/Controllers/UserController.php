<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    
    
    public function store(Request $request, $user_id, User $user)
    {
        $user = User::whereId($user_id)->first();
        $gender = $request['gender'];
        $experience =$request['experience'];
        $birthday = $request['birthday'];
        //誕生日を整数化
        $birthday = str_replace("-", "", $birthday);
        // 現在日付
        $now = date('Ymd');
        //年齢
        $age = floor(($now - $birthday) / 10000);

        $user->age = $age; 
        $user->gender = $gender;
        $user->experience = $experience;
        $user->save();
        
        return view('/dashboard');
    }
    
}