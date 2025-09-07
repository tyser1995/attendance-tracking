<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Student;

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
            'students' => Student::all()
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
            'roles' => $roles
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
        //
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
        //
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
