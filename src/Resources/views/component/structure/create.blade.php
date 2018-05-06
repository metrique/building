@extends('laravel-building::main')

@section('content')
    @include('laravel-building::partial.header', [
        'heading'=>'Component structure',
    ])

    @include('laravel-building::component.structure.form', [
        'action' => route($routes['store'], $data['component']->id),
        'edit' => false,
        'data' => $data
    ])

@endsection
