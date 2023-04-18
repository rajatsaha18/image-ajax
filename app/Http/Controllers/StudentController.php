<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('form');
    }

    public function addStudent(Request $request){

        $file = $request->file('image');
        $fileName = time().''.$file->getClientOriginalName();
        $filePath =$file->storeAs('images', $fileName, 'public');

        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->image = $filePath;
        $student->save();
        return response()->json(['res' => 'Student Created Successfully']);
    }

    public function getStudent(){
        $students =Student::all();
        return response()->json(['students' => $students]);
    }

    public function editStudent($id){
        $editStudent = Student::where('id', $id)->get();
        return view('edit-user',['editStudent' => $editStudent]);
    }

    public function updateStudent(Request $request){
        $updateStudent = Student::find($request->id);
        $updateStudent->name  = $request->name;
        $updateStudent->email = $request->email;

        if($request->file('image')){
            $image = $request->file('image');
            $imageName = time().''.$image->getClientOriginalName();
            $imageUrl = $image->storeAs('images', $imageName, 'public');
            $updateStudent->image = $imageUrl;
        }

        $updateStudent->save();
        return response()->json(['result' => 'student update successfully']);

    }
}
