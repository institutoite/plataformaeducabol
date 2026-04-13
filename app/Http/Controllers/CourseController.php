<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CoursePurchaseRequest;

class CourseController extends Controller
{
    public function index() {
        return view('courses.index');
    } 

    public function show(Course $course){

        $this->authorize('published', $course);

        $similares = Course::where('category_id', $course->category_id)
                            ->where('id', '!=', $course->id)
                            ->where('status',3)
                            ->latest('id')
                            ->take(5)
                            ->get();

        $hasPendingPurchaseRequest = false;

        if (auth()->check()) {
            $hasPendingPurchaseRequest = CoursePurchaseRequest::where('course_id', $course->id)
                ->where('user_id', auth()->id())
                ->where('status', CoursePurchaseRequest::STATUS_PENDING)
                ->exists();
        }

        return view('courses.show',compact('course', 'similares', 'hasPendingPurchaseRequest'));
        
    }

    public function purchaseRequest(Course $course)
    {
        $user = auth()->user();

        if ($course->students()->where('user_id', $user->id)->exists()) {
            return redirect()->route('courses.status', $course);
        }

        CoursePurchaseRequest::updateOrCreate(
            [
                'course_id' => $course->id,
                'user_id' => $user->id,
            ],
            [
                'status' => CoursePurchaseRequest::STATUS_PENDING,
                'admin_note' => null,
            ]
        );

        $message = urlencode("Hola, me interesa comprar el curso {$course->title}");
        $whatsappUrl = "https://api.whatsapp.com/send?phone=59171039910&text={$message}";

        return redirect()->away($whatsappUrl);
    }

    public function enrolled(Course $course){
        $course->students()->attach(auth()->user()->id);

        return redirect()->route('courses.status', $course);
    }

    public function enroll(){
    
        return redirect()->route('admin.courses.enroll');
    }

    public function learn(Course $course){
    
        return view('courses.learn', compact('course'));
    }
    
    
}
