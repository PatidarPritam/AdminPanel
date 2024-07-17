<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    public function register(){
        return view('register');
     }

     public function addUser(UserRegisterRequest $request){
        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address'=>$request->address,
            'password' => Hash::make($request->password),

        ]);
    
     }
     public function loginUser(loginRequest $request)
     {
         $credentials = $request->only('email', 'password');
     
         // Attempt to log the user in with the 'student' guard
         if (Auth::guard('student')->attempt($credentials)) {
             return redirect()->intended('dashboard');
         }
     
         // Redirect back with input and an error message
         return redirect()->back()
             ->withInput()
             ->withErrors(['email' => 'Invalid email or password']);
     }
     

}