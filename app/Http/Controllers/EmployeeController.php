<?php
namespace App\Http\Controllers;
use App\Models\Employee as ModelsEmployee;
use Illuminate\Http\Request;
class EmployeeController extends Controller
{
    public function create()
    {
        return view('admin.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'designation' => 'required|string|max:100',
            'department' => 'required|string|max:100',
            'joining_date' => 'required|date',
            'employment_type' => 'required|string',
            'salary_range' => 'required|string',
            'bonus_eligibility' => 'nullable|string',
            'benefits' => 'nullable|string',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:150',
            'password' => 'required|string|min:6|max:100',
            'address' => 'required|string',
            'emergency_contact_name' => 'required|string|max:150',
            'emergency_contact_phone' => 'required|string|max:20',
            'resume' => 'nullable|mimes:pdf,doc,docx|max:2048',
            'id_proof' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        //handle file uploads
        if($request->hasFile('resume')){
            $validated['resume'] = $request->file('resume')->store('resumes', 'public');
        }
        if($request->hasFile('id_proof')){
            $validated['id_proof'] = $request->file('id_proof')->store('id_proofs', 'public');
        }

        ModelsEmployee::create($validated);
        return redirect()->route('admin.admin')->with('success', 'Employee created successfully.');

        // return redirect()->back()->with('success', 'Employee created successfully.');
    }
    // public function home()
    // {
    //     $employee = session('employee');

    //     if (!$employee) {
    //         return redirect('/login');
    //     }

    //     $attendance = $employee['attendance'] ?? [];
    //     $payslips = $employee['payslips'] ?? [];

    //     return view('employee.home', compact('employee', 'attendance', 'payslips'));
    // }
}
