<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function add()
    {
        return view('Employee.add');
    }

    public function addEmployee(EmployeeRequest $request)
    {
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
            'address' => $request->address,
            'phone' => $request->phone,
            'img' => $imagePath
        ]);
        // return response()->json([
        //     'success' => 'Employee added successfully!',
        //     'message' => 'Employee added successfully!',
        //     'employee' => $employee
        // ]);
       //  toastr()->success('employee added successfully!');
        return response()->json(['employee' => $employee]);
      
    }

    public function show()
    {
        $employees = Employee::all();
        return view('Employee.show', compact('employees'));
    }

    public function delete($id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            if ($employee->img) {
                Storage::disk('public')->delete($employee->img);
            }
            $employee->delete();
        }
        // return redirect()->route('show')->with('error', 'Employee not found.');
        //flash()->success('employee deleted successfully');  
        return response()->json(['success' => true]);
        
    }

    public function edit($id)
    {
        $employee = Employee::find($id);
        return response()->json(['employee' => $employee]);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            $imagePath = $employee->img;

            // Handle image upload
            if ($request->hasFile('image')) {
                if ($employee->img) {
                    Storage::disk('public')->delete($employee->img);
                }
                $image = $request->file('image');
                $imagePath = $image->store('images', 'public');
            }

            $employee->firstName = $request->firstName;
            $employee->lastName = $request->lastName;
            $employee->email = $request->email;
            $employee->address = $request->address;
            $employee->phone = $request->phone;
            $employee->img = $imagePath;

            $employee->save();
        }
      //  flash()->success('employee update successfully');  
        return response()->json(['employee' => $employee]);
    }
}
