<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; 

class EmployeeController extends Controller
{
    
   public function add(){
    return view('Employee.add');
    }

    public function addEmployee(EmployeeRequest $request){
    
    // dd($request->all());   
   // $validated = $request->validated();

    $imagePath = null;

    // Handle image upload
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagePath = $image->store('images', 'public');
    }   

        $employee = Employee::create([
            
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'address'=>$request->address,
            'phone' => $request->phone,
            'img'=> $imagePath
       ]);

        return redirect()->route('show');
    }

    public function show(){
        $employees = Employee::all();
        //echo $employees;
       return view('Employee.show',compact('employees'));
     
      
    }

    public function delete($id){
    $employee = Employee::find($id);
    $employee->delete();

    return redirect()->route('show');
    }


    public function edit($id){

        $employee = Employee::find($id);
        return view('Employee.edit',compact('employee'));
    }

    public function update(Request $request,$id){
        $imagePath = null;

        // Handle image upload
         
        $employee = Employee::find($id);
        $employee->firstName = $request->firstName;
        $employee->lastName = $request->lastName;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->phone = $request->phone;
        if ($request->hasFile('image')) {
            if ($employee->img) {
                Storage::disk('public')->delete($employee->img);
            }

            $image = $request->file('image');
            $employee->img = $image->store('images', 'public');
        }
    
      
        $employee->save();
        return redirect()->route('show');
       
    }
}