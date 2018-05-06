@extends('laravel-building::main')

@section('content')
    @include('laravel-building::partial.header', [
        'heading'=>'Pages',
    ])
    @include('laravel-building::page.form', [
        'action' => route($routes['store']),
        'edit' => false,
    ])
@endsection
