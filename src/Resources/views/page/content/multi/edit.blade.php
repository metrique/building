@extends('laravel-building::main')

@section('content')
    @include('laravel-building::partial.header', [
        'heading'=>'Page contents',
        'link'=>route($routes['create'], [$data['section']->page->id, $data['section']->id]),
        'title'=>'New content',
        'icon'=>'fa-plus'
    ])

    @include($views['multi.form'], [
        'action' => route($routes['update'], [$data['section']->page->id, $data['section']->id, 0]),
        'edit' => true,
        'counter' => 0,
        'data' => $data
    ])
@endsection
