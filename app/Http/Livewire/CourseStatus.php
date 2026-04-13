<?php

namespace App\Http\Livewire;
use App\Models\Course;
use App\Models\Lesson;
use Livewire\Component;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseStatus extends Component
{
    use AuthorizesRequests;

    public $course, $current_id;

    public $video_url, $active;

    public function mount(Course $course){
        $this->authorize('enrolled', $course);

        $this->course = $course;
        $current = null;
        
        foreach ($course->lessons as $lesson) {
            if (!$lesson->completed) {
                $current = $lesson;

                break;
            }
        }

        if (!$current) {
            $current = $course->lessons->last();
        }

        if (!$current) {
            abort(404, 'Este curso no tiene lecciones disponibles.');
        }


        $this->current_id = $current->id;
        $this->video_url = $this->resolveVideoUrl($this->current->url);
        $this->active = $current->completed;
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
        $this->video_url = $this->resolveVideoUrl($this->current->url);
        $this->active = $this->current->completed;
    }

    protected function resolveVideoUrl($url){
        if (Str::startsWith($url, ['http://', 'https://'])) {
            return $url;
        }

        return Storage::url($url);
    }

    public function getVideoProviderProperty(){
        if (!$this->video_url) {
            return null;
        }

        if (Str::contains($this->video_url, ['youtube.com', 'youtu.be'])) {
            return 'youtube';
        }

        return 'local';
    }

    public function getYoutubeEmbedUrlProperty(){
        if ($this->video_provider !== 'youtube') {
            return null;
        }

        $url = trim($this->video_url);
        $videoId = null;

        if (preg_match('/youtu\.be\/([A-Za-z0-9_-]{6,})/i', $url, $matches)) {
            $videoId = $matches[1];
        } elseif (preg_match('/[?&]v=([A-Za-z0-9_-]{6,})/i', $url, $matches)) {
            $videoId = $matches[1];
        } elseif (preg_match('/youtube\.com\/embed\/([A-Za-z0-9_-]{6,})/i', $url, $matches)) {
            $videoId = $matches[1];
        }

        return $videoId ? 'https://www.youtube.com/embed/' . $videoId . '?rel=0&modestbranding=1' : null;
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
