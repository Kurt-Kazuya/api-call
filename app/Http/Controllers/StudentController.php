<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
   
    public function get()
    {
        return response()->json(Student::all(), 200, [], JSON_PRETTY_PRINT);
    }

   
    public function post(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:students,email',
            'course' => 'required|string',
        ]);

        $student = Student::create($validated);

        return response()->json($student, 201);
    }

   
    public function getsingle($id)
    {   
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }
        return response()->json($student, 200, [], JSON_PRETTY_PRINT);
    }

    
    public function update(Request $request, $id)
    {
         $student = Student::find($id);
        
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:students,email,' . $id,
            'course' => 'required|string',
        ]);

        $student->update($validated);
        return response()->json($student, 200, [], JSON_PRETTY_PRINT);
    }

   
    public function patch(Request $request, $id)
    {
         $student = Student::find($id);
        
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }
        $validated = $request->validate([
            'name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:students,email,' . $id,
            'course' => 'sometimes|string',
        ]);

        $student->update($validated);
        return response()->json($student, 200, [], JSON_PRETTY_PRINT);
    }

   
    public function destroy($id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }
        $student->delete();
        return response()->json($student, 200, [], JSON_PRETTY_PRINT);
    }

  
    public function destroyAll()
    {
       Student::truncate();
       return response()->json(['message' => 'all students deleted successfully!']);
    }
}