<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Student::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'class_id' => 'required|max:10',
            'section_id' => 'required|max:10',
            'name' => 'required|max:20',
            'email' => 'required|max:50|unique:students',
            'phone' => 'required|max:50|unique:students',
            'password' => 'required|max:50',
            'address' => 'max:100',
            'photo' => 'max:100',
            'gender' => 'max:10'
        ]);

        $student = new Student;
        $student->class_id = $request->class_id;
        $student->section_id = $request->section_id;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->password = Hash::make($request->password);
        $student->address = $request->address;
        $student->photo = $request->photo;
        $student->gender = $request->gender;

        $student->save();

        return response('Inserted');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);
        
        return response()->json($student);
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
        $student = Student::findOrFail($id);

        // $student->class_id = $request->class_id;
        // $student->section_id = $request->section_id;
        // $student->name = $request->name;
        // $student->email = $request->email;
        // $student->phone = $request->phone;
        // $student->password = $request->password;
        // $student->address = $request->address;
        // $student->photo = $request->photo;

        $student->class_id = ( is_null($request->class_id) ? $student->class_id : $request->class_id );
        $student->section_id = ( is_null($request->section_id) ? $student->section_id : $request->section_id );
        $student->name = ( is_null($request->name) ? $student->name : $request->name );
        $student->email = ( is_null($request->email) ? $student->email : $request->email );
        $student->phone = ( is_null($request->phone) ? $student->phone : $request->phone );
        $student->password = Hash::make(( is_null($request->password) ? $student->password : $request->password ));
        $student->address = ( is_null($request->address) ? $student->address : $request->address );
        $student->photo = ( is_null($request->photo) ? $student->photo : $request->photo);

        $student->update();

        return response('Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Student::findOrFail($id);

        $delete->delete();

        return response('Deleted');
    }
}
