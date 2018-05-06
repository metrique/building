@extends('laravel-building::main')

@section('content')
    @include('laravel-building::partial.header', [
        'heading'=>'Page contents',
    ])

    @include($views['single.form'], [
        'action' => route($routes['store'], [$data['section']->page->id, $data['section']->id]),
        'edit' => false,
        'data' => $data
    ])
@endsection
