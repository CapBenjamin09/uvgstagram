<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!auth()->attempt($request->only('email', 'password'))){
            return back()->with('status', 'Datos Incorrectos, por favor verifique');
        }
        return redirect()->route('post.index', auth()->user()->username);
    }

}
