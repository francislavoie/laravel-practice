<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Show the list of users
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index', [
        	'users' => User::all()
        ]);
    }
}
