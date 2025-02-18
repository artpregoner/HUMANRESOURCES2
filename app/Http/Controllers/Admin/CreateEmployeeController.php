<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeeRequest; //to display/create etc... employee
use App\Models\User; //from employee to Users in my system
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash; //matic nato syempre
class CreateEmployeeController extends Controller
{
    public function index()
    {
        return view('admin.employee.create-employee');
    }
    public function employeeList()
    {
        $EmployeeList = EmployeeRequest::with('user')->get();

        return view('admin.employee.index-employee', compact('EmployeeList'));
    }

    public function show($id)
    {
        $employeeRequest = EmployeeRequest::with('user')->findOrFail($id);

        // Check if the employee already exists as a user
        $userExists = User::where('email', $employeeRequest->email)->exists();

        return view('admin.employee.show-employee', compact('employeeRequest', 'userExists'));
    }


    public function createUser(Request $request)
    {
        // Validate the form input
        $validated = $request->validate([
            'role' => 'required|in:employee,hr,admin',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        // Check if the user already exists
        $user = User::where('email', $validated['email'])->first();

        if ($user) {
            // If the user exists, update their role
            $user->update([
                'role' => $validated['role'],
            ]);

            return redirect()->route('admin.index.employee')->with('success', 'User updated successfully!');
        }

        // Use a fixed password for new users
        $password = 'CompanyPassword2025'; // Set fixed password

        // If the user does not exist, create a new user
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => Hash::make($password), // Hash the password before saving
        ]);

        return redirect()->route('admin.index.employee')->with('success', 'User created successfully!');
    }


    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employee_requests,email',
            'phone' => 'required|numeric',
            'birthdate' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'civil_status' => 'required|string',
            'address' => 'required|string',
            'social_media' => 'nullable|string',
            'department' => 'required|string',
            'emergency_name' => 'required|string',
            'emergency_address' => 'required|string',
            'emergency_phone' => 'required|numeric',
            'emergency_relationship' => 'required|string',
        ]);

        // Store employee request
        $employeeRequest = EmployeeRequest::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'civil_status' => $request->civil_status,
            'address' => $request->address,
            'social_media' => $request->social_media,
            'department' => $request->department,

            // Emergency Contact
            'emergency_name' => $request->emergency_name,
            'emergency_address' => $request->emergency_address,
            'emergency_phone' => $request->emergency_phone,
            'emergency_relationship' => $request->emergency_relationship,

            'status' => 'pending', // Default status
        ]);

        return redirect()->route('admin.show.employee', $employeeRequest->id)->with('success', 'Employee request submitted successfully.');
    }
}

