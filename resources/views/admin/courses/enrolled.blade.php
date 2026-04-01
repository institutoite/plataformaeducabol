@extends('adminlte::page')

@section('title', 'Educabol')

@section('content_header')
    <h1>Inscribir estudiante</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.courses.store']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Nombre del estudiante') !!}
                    {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}

                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                
                {!! Form::hidden('user_id', $user->id) !!}

                <div class="form-group">
                    {!! Form::label('course_id', 'Seleccione el curso:') !!}
                    {!! Form::select('course_id', $courses, null, ['class'=> 'form-control']) !!}
                </div>

                
                {!! Form::submit('Inscribir al curso', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop