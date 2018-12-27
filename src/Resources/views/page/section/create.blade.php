@extends('laravel-building::main')

@section('content')
    @constituent('laravel-building::partial.resource-page-title', [
        'icon' => 'fas fa-puzzle-piece',
        'title' => 'Page sections'
    ])
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            @include('laravel-building::page.section.form', [
                'action' => route($routes['store'], $data['page']->id),
                'edit' => false,
                'data' => $data
            ])
        </div>
    </div>
@endsection
