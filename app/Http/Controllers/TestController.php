<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
//        $user = auth()->user();
        $user = User::find(11);

//        dd($user);

        $roleIds = [1, 2];
//        $user->roles()->attach($roleIds);
        $user->roles()->syncWithoutDetaching($roleIds);



    }
}
