<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterFormController extends Controller
{
    public function index(){
        return view('registration');
    }

    public function register(Request $request){
        // return Input::all();
        // return redirect('registration');
        // $request->validate(
        //     [
        //         'fname' => 'required',
        //         'lname' => 'required',
        //         'username' => 'required',
        //         'email' => 'required|email',
        //         'city' => 'required',
        //         'state' => 'required',
        //         'zip' => 'required',
        //         'password' => 'required',
        //         'password_confirm' => 'required|same:password',
        //         'invalidCheck' => 'required'
        //     ]
        // );
        // $request->validate(
        //     [
        //         'fname' => 'required',
        //         'lname' => 'required',
        //         'username' => 'required|string|regex:/\w*$/|max:10|min:5|unique:users,username|alpha_dash',
        //         'email' => 'required|email',
        //         'password' => 'required',
        //         'password_confirm' => 'required|same:password'
        //     ]
        // );
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'status' => 'required',
                'month' => 'required',
                'gender' => 'required',
            ]
        );

        echo "<pre>";
        print_r($request->all());
        echo "</pre>";


    }
}
