@extends('laravel-building::main')

@section('content')
    @include('laravel-building::partial.header', [
        'heading'=>'Page contents',
    ])

    @include($views['single.form'], [
        'action' => route($routes['update'], [$data['section']->page->id, $data['section']->id, 0]),
        'edit' => true,
        'data' => $data
    ])
@endsection
