<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
    
        return $users;
    }
 
   /**
    * Store a newly created resource in storage.
    *
    */
    public function store(Request $request)
    {
        $userData = $request->all();
        $user = User::create($userData);

        return $user;
    }
}
