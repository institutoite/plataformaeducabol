<?php

namespace App\Http\Livewire;
use App\Models\Course;
use App\Models\Lesson;
use Livewire\Component;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class CourseStatus extends Component
{
    use AuthorizesRequests;

    public $course, $current_id;

    public $video_url, $active;

    public function mount(Course $course){
        $this->course = $course;
        
        foreach ($course->lessons as $lesson) {
            if (!$lesson->completed) {
                $current = $lesson;

                break;
            }
        }

        if (!$current) {
            $current = $course->lessons->last();
        }


        $this->current_id = $current->id;
        $this->video_url = Storage::url($this->current->url);
        $this->active = $current->completed;

        $this->authorize('enrolled', $course);
    }

    
    public function render()
    {
        return view('livewire.course-status');
    }

    //Propiedad computada
    public function getCurrentProperty(){
        return $this->course->lessons->where('id', $this->current_id)->first();
    }

    //Ciclo de vida
    public function updatedCurrentId(){
        $this->video_url = Storage::url($this->current->url);
        $this->active = $this->current->completed;
    }

    public function updatedActive(){
        /* $this->current->update(['completed' => $this->active]); */
        if($this->current->completed){
            $this->current->users()->detach(auth()->user()->id);
        }else{
            $this->current->users()->attach(auth()->user()->id);
        }

        $this->current = Lesson::find($this->current->id);
        $this->course = Course::find($this->course->id);
    }

    //Métodos
    /* public function completed(){
        if($this->current->completed){
            $this->current->users()->detach(auth()->user()->id);
        }else{
            $this->current->users()->attach(auth()->user()->id);
        }

        $this->current = Lesson::find($this->current->id);
        $this->course = Course::find($this->course->id);
    } */

    /* public function getIndexProperty(){
        return $this->course->lessons->pluck('id')->search($this->current_id);
    } */

    public function getPreviousProperty(){

        $index = $this->course->lessons->pluck('id')->search($this->current_id);

        if($index == 0){
            return null;
        }else{
            /* return $this->previous = $this->course->lessons[$index - 1]; */
            return $this->course->lessons[$index - 1];
        }
    }

    public function getNextProperty(){
        $index = $this->course->lessons->pluck('id')->search($this->current_id);

        if ($index == $this->course->lessons->count() - 1) {
            return null;
        }else{
            return $this->course->lessons[$index + 1];
        }
    }

    public function getAdvanceProperty(){
        $i = 0;
        foreach ($this->course->lessons as $lesson) {
            if ($lesson->completed) {
                $i++;
            }
        }

        $advance = ($i * 100)/($this->course->lessons->count());

        return round($advance, 1);
    }

    public function download(){
        return response()->download(storage_path('app/public/' . $this->current->resource->url));
    }

}
