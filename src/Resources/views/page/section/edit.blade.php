@extends('laravel-building::main')

@section('content')
    @include('laravel-building::partial.header', [
        'heading'=>'Page sections',
    ])

    @include('laravel-building::page.section.form', [
        'action' => route($routes['update'], [$data['page']->id, $data['section']->id]),
        'edit' => true,
        'data' => $data
    ])

@endsection
