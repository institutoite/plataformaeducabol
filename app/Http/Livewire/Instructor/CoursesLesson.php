<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Lesson;
use App\Models\Section;
use Livewire\Component;

use Livewire\WithFileUploads;

class CoursesLesson extends Component
{
    use WithFileUploads;

    public $section, $lesson, $name, $url, $file;

    protected $rules = [
        'lesson.name' => 'required',
        'lesson.url' => 'required'
    ];

    public function mount(Section $section){
        $this->section = $section;

        $this->lesson = new Lesson();
    }

    public function render()
    {
        return view('livewire.instructor.courses-lesson');
    }

    public function store(){
        $rules = [
            'name' => 'required',
            'file' => 'required|file|mimes:mp4,mov,ogg,qt|max:1228800'
        ];

        $this->validate($rules);

        $url = $this->file->store('resources');

        Lesson::create([
            'name' => $this->name,
            'url' => $url,
            'section_id' => $this->section->id,
            'iframe' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/DgDxAzbkOSs" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>' 
        ]);

        $this->reset(['name', 'url']);
        $this->section = Section::find($this->section->id);

        //$this->lesson = Lesson::find($this->lesson->id);

        
    }

    public function edit(Lesson $lesson){
        $this->resetValidation();
        $this->lesson = $lesson;
    }

    public function update(){
        $this->validate();

        $this->lesson->url = $this->file->store('resources');

        $this->lesson->save();
        $this->lesson = new Lesson();

        $this->section = Section::find($this->section->id);
    }

    public function destroy(Lesson $lesson){
        $lesson->delete();
        $this->section = Section::find($this->section->id);
    }

    public function cancel(){
        $this->lesson = new Lesson();
    }

}
