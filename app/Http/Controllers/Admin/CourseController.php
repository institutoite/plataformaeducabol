<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\User;

class CourseController extends Controller
{
    public function index(){

        $courses = Course::where('status', 2)->paginate();

        return view('admin.courses.index', compact('courses'));
    }

    public function show(Course $course){
        return view('admin.courses.show', compact('course'));
    }

    public function approved(Course $course){

        if (!$course->lessons || !$course->goals || !$course->requirements || !$course->image ) {
            return back()->with('info', 'No se puede publicar un curso que no este completo');
        }

        $course->status = 3;
        $course->save();

        return redirect()->route('admin.courses.index')->with('info', 'El curso se publico con exito');
    }

    public function observation(Course $course){
        return view('admin.courses.observation', compact('course'));
    }

    public function reject(Request $request, Course $course){

        $request->validate([
            'body' => 'required'
        ]);

        $course->observation()->create($request->all());

        $course->status = 1;
        $course->save();

        return redirect()->route('admin.courses.index')->with('info', 'El curso se ha rechazado con exito');
    }

    /*public function enrolled(Course $course){
        $course->students()->attach(auth()->user()->id);

        return redirect()->route('admin.courses.status', $course);
    }*/

    public function enroll(){
        $users = User::paginate();

        return view('admin.courses.enroll', compact('users'));
    }

    public function enrolled(User $user){
        $courses = Course::where('status', 3)->pluck('title', 'id');

        return view('admin.courses.enrolled', compact('user', 'courses'));
    }
    
    public function store(Request $request){

        $course = Course::find($request->course_id);
        $user = Course::find($request->user_id);

        $course->students()->attach($request->user_id);

        return redirect()->route('admin.courses.enroll');
    }

}
