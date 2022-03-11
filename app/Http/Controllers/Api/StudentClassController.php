<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\StudentClass;


class StudentClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get the data from database
        $classes = DB::table('student_classes')->get();
        // $classes = StudentClass::all();
        return response()->json($classes);
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
            'name' => 'required|max:25|unique:student_classes',
        ]);

        // $class = new StudentClass;
        // $class->name = $request->name;
        // $class->save();

        // query builder
        $data = array();
        $data['name'] = $request->name;
        DB::table('student_classes')->insert($data);

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
        // $class = StudentClass::findOrFail($id);
        $class = DB::table('student_classes')->where('id', $id)->first();

        return response()->json($class, 200)->header('Content-type', 'text/plain')->header('Accept', 'application/json');
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
        $class = StudentClass::findOrFail($id);
        $class->name = $request->name;
        $class->save();

        return response('Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classes = StudentClass::findOrFail($id);
        $classes->delete();
        
        return response('Deleted');

    }
}
