<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
    public function index(){
        return view('index');
    }

    public function login(){
        return view('login');
    }

    public function recoverPassword(){
        return view('forgot-password');
    }

    public function register(){
        return view('register');
    }

    public function processRegister( Request $request ){
        $validator = Validator::make($request->all(),[
            'fullName' => 'required',
            'email' => 'required | email',
            'password' => 'required | min:6'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        echo $request->input('fullName');
        echo "<br>";
        echo $request->input('email');
        echo "<br>";
        echo $request->input('password');
    }
}
