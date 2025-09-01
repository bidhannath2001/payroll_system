<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'designation' => 'required|string|max:100',
            'department_id' => 'required|exists:departments,department_id',
            'role_id' => 'required|exists:roles,role_id',
            'date_joined' => 'required|date',
            'status' => 'required|string|in:full time,part time',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:150|unique:employees,email',
            'address' => 'required|string',
            'resume' => 'nullable|mimes:pdf,doc,docx|max:2048',
            'id_proof' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'department_id.exists' => 'Selected department does not exist.',
            'role_id.exists' => 'Selected role does not exist.',
            'status.in' => 'Status must be either full time or part time.',
            'email.unique' => 'This email is already registered.',
            'resume.mimes' => 'Resume must be a PDF, DOC, or DOCX file.',
            'resume.max' => 'Resume file size must not exceed 2MB.',
            'id_proof.mimes' => 'ID proof must be a JPG, JPEG, PNG, or PDF file.',
            'id_proof.max' => 'ID proof file size must not exceed 2MB.',
        ];
    }

    public function getValidatedWithFiles(): array
    {
        $validated = $this->validated();
        
        // Ensure we have an array to work with
        if (!is_array($validated)) {
            $validated = [];
        }

        // Handle file uploads
        if ($this->hasFile('resume')) {
            $validated['resume'] = $this->file('resume')->store('resumes', 'public');
        }

        if ($this->hasFile('id_proof')) {
            $validated['id_proof'] = $this->file('id_proof')->store('id_proofs', 'public');
        }
        return $validated;
    }
}