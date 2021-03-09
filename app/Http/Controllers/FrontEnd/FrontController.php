<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        return view('login');
    }

    public function register(){
        return view('register');
    }

    public function processRegister( Request $request ){

        $this->validate($request,[
            'fullName' => 'required',
            'email' => 'required | email | unique:users,email',
            'password' => 'required | min:6 |confirmed'
        ]);

        $data = [
            'name' =>$request->input('fullName'),
            'email'=> strtolower($request->input('email')),
            'password'=>bcrypt($request->input('password'))

        ];

        try {
            User::create($data);
            session()->flash('message', 'User account created successful');
            session()->flash('type', 'success');

            return redirect()->route('login');

        }catch (Exception $e){
            session()->flash('message', $e->getMessage());
            session()->flash('type', 'danger');

            return redirect()->back();
        }
    }



    public function login(){
        return view('login');
    }



    public function loginProcess( Request $request ){
        $this->validate($request,[
            'email' => 'required | email',
            'password' => 'required | min:6 '
        ]);
        $credentials = $request->except('_token');
        if(auth()->attempt($credentials)){
            return redirect()->route('dashboard');
        }

        session()->flash('message', 'Invalid email or password');
        session()->flash('type', 'danger');
        return redirect()->back();
    }

    public function recoverPassword(){
        return view('forgot-password');
    }

    public  function logout(){
        auth()->logout();
        session()->flash('message', 'Logout successful');
        session()->flash('type', 'success');

        return redirect()->route('login');
    }



    public function profile(){
        return view('profile');
    }

}
