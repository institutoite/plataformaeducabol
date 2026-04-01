<?php

namespace App\Observers;

use App\Models\lesson;
use Illuminate\Support\Facades\Storage;

class LessonObserver
{
    public function deleting(Lesson $lesson){
        if($lesson->resource){
            Storage::delete($lesson->resource->url);
            $lesson->resource->delete();
        }
    }
}
