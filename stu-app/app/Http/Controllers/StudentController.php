<?php

namespace App\Http\Controllers;

use App\Common\Helper;
use App\Models\Class_S;
use App\Models\Gender;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    protected $student;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

//    public function __construct(Student $student)
//    {
//        $this->student = $student::all();
//    }
    public function index(Request $request)
    {
        $student = Student::query()->with(['class','gender']);

        if ($request->has('name')) {
            $student->where('name', 'LIKE', '%' . $request->name . '%');
        }
        if ($request->has('class')) {
            $student->whereRelation('class', 'name', $request->class);
        }
        if ($request->has('gender')) {
            $student->whereRelation('gender', 'name', $request->gender);
        }

        $total = $student->paginate(5)->total();
        $this->student = $student->get();
        $page = ceil($total / 5);
        return Helper::getResponse($this->student, null, null, $page);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
       $student = new Student();
       $student->name = Helper::RandomString();
       $student->class = rand(1,4);
       $student->gender = rand(1,2);
       $student->save();
        return Helper::getResponse($student);
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
        $student = Student::destroy($id);
        return Helper::getResponse($student);
    }
}
