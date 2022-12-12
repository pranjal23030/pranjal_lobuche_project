<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PagesController extends Controller
{
    public function home() {
        $data = [
            'name'=>'Pranjal',
            'age'=>18
        ];
        return view('welcome')->with($data);
    }

    public function profile(){
        $data1=[
            'username'=>'Pranjal'
        ];
        return view('profile')->with($data1);
    }

    public function create(){
        return view('create');
    }

    public function store(Request $request){
        $student = new Student();
        $student->name = $request->name;
        $student->address = $request->address;
        $student->age = $request->age;

        $filenameWithExt = $request->file('image')->getClientOriginalName(); //Image ko name taneko like .png, .jpg etc.
        $img = Image::make($request->file('image'));  //Image load gareko
        $img->save('storage/image/'.$filenameWithExt);
        $student->image = $filenameWithExt;
        $student->save();
        return redirect('/list');

    }

    public function list() {
        $students = Student::orderBy('name','asc')->get();
        return view('list')->with('students',$students);
    }

    public function edit($id) {
        $student = Student::where('id',$id)->first();
        return view('update')->with('student',$student);
//        $student = Student::find($id);
    }

    public function update(Request $request) {
        $student = Student::where('id',$request->id)->first();
        $student->name = $request->name;
        $student->address = $request->address;
        $student->age = $request->age;
        $student->save();
        return route('list');
    }

    public function delete($id) {
        $student = Student::where('id', $id)->first();

        if(File::exists('storage/image/'. $student->image)) {
            File::delete('storage/image/'.$student->image);
        }

        $student->delete();
        return redirect('/list');
    }
}


//⇒ Make database studentmanagement
//
//⇒ php artisan make:migration create_students_table --create=students
//
//⇒ $table->id();
//            $table->string('studname');
//            $table->string('course');
//            $table->integer('fee');
//
//⇒ php artisan migrate
//
//⇒ php artisan make:controller StudentController --resource --model=Student
//
//
//⇒ For Image halnako laagi
//php artisan storage:link
//
//composer require intervention/image



//cd ..
//cd ..
//cd xampp..
//cd htdocs
//
//composer create-project --prefer-dist laravel/laravel StuMS

