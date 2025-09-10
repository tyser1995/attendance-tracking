<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Student;
use App\Models\Course;

use Illuminate\Support\Facades\Validator;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('students.index', [
            'students' => Student::with('course')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','id')->all();
        return view('students.create', [
            'roles' => $roles,
            'courses' => \App\Models\Course::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'idnumber' => 'required|unique:students,idnumber',
            'fn'       => 'required|string|max:255',
            'ln'       => 'required|string|max:255',
            'mn'       => 'nullable|string|max:255',
            'dob'      => 'required|date',
            'sex'      => 'required|in:M,F',
            'course_id' => 'required|exists:courses,id',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', $validator->errors()->first());
        }

        $student = new Student();
        $student->idnumber = $request->idnumber;
        $student->fn       = $request->fn;
        $student->ln       = $request->ln;
        $student->mn       = $request->mn;
        $student->dob      = $request->dob;
        $student->sex      = $request->sex;
        $student->course_id = $request->course_id;
        $student->save();

        return redirect()
            ->back()
            ->with('status', 'Student added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $courses = Course::all();
        return view('students.edit', compact('student', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $student = Student::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'idnumber' => 'required|unique:students,idnumber,' . $student->id, // ✅ ignore current student
            'fn'       => 'required|string|max:255',
            'ln'       => 'required|string|max:255',
            'mn'       => 'nullable|string|max:255',
            'dob'      => 'required|date',
            'sex'      => 'required|in:M,F',
            'course_id' => 'required|exists:courses,id',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', $validator->errors()->first());
        }

        $student->idnumber = $request->idnumber;
        $student->fn       = $request->fn;
        $student->ln       = $request->ln;
        $student->mn       = $request->mn;
        $student->dob      = $request->dob;
        $student->sex      = $request->sex;
        $student->course_id = $request->course_id;
        $student->save();

        return redirect()
            ->route('student.index')
            ->with('status', 'Student updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id){
        $student = Student::findOrfail($id);
        $student->delete();
        return redirect()->route('student.index')->withError('Deleted Successfully ' .$student->idnumber);
    }
}
