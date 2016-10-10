@extends('laravel-building::main')

@section('content')
    @include('laravel-building::partial.header', [
        'heading'=>'Page sections',
    ])

    @include('laravel-building::page.section.form', [
        'action' => route($routes['store'], $data['page']->id),
        'edit' => false,
        'data' => $data
    ])

@endsection
