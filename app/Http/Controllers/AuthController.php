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
//        dd($request->all());

        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address'=>$request->address,
            'password' => Hash::make($request->password),

        ]);
        flash()->success('registration  successfully');  
        return redirect()->route('login');
     }
     public function loginUser(loginRequest $request)
     {
         $credentials = $request->only('email', 'password');
     
         // Attempt to log the user in with the 'student' guard
         if (Auth::guard('student')->attempt($credentials)) {
           // return redirect()->route('show');
           // Display a success toast with no title
            flash()->success('login successfully');  
            return redirect('/show');

         }
     
         // Redirect back with input and an error message
         return redirect()->back()
             ->withInput()
             ->withErrors(['email' => 'Invalid email or password']);
     }
     
     public function logoutUser(Request $request){
        // Perform logout
        Auth::logout();
    
        // Flash a success message to the session
      //  $request->session()->flash('success', 'You have been logged out successfully.');
    
        // Redirect to the desired route
        flash()->success('logout successfully');  
        return redirect('/login');
    }

  /*   public function dashboard(){
      
        return redirect()->route('show');
    //     $student = Auth::guard('student')->user();
           
    //    return view('dashboard', ['student' => $student]);

    //    $students = Student::all();
    //   return view('dashboard',compact('students'));

     } */

}