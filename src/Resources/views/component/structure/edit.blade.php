@extends('laravel-building::main')

@section('content')
    @include('laravel-building::partial.header', [
        'heading'=>'Component structure',
    ])

    @include('laravel-building::component.structure.form', [
        'action' => route($routes['update'], [$data['component']->id, $data['structure']->id]),
        'edit' => true,
        'data' => $data
    ])

@endsection
