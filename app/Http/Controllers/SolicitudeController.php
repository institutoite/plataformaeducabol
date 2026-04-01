<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class SolicitudeController extends Controller
{
    public function becometeacher(){
        $user = User::find(auth()->user()->id);
        $user->removeRole('Student');
        $user->assignRole('Teacher');

        return redirect()->route('instructor.courses.index');
    }
}
