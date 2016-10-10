@extends('laravel-building::main')

@section('content')
    @include('laravel-building::partial.header', [
        'heading'=>'Pages',
        'link'=>route($routes['section.index'], $data->id),
        'title'=>'Edit sections',
        'icon'=>'fa-pencil',
    ])

    @include('laravel-building::page.form', [
        'action' => route($routes['update'], $data->id),
        'edit' => true,
        'data' => $data,
    ])
@endsection
