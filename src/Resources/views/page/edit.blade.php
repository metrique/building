@extends('laravel-building::main')

@section('content')
    <div class="container">
        @constituent('laravel-building::partial.resource-page-title', [
            'icon' => 'fas fa-file-alt',
            'title' => 'Pages'
        ])
        
        <div class="row justify-content-center mt-4 mb-4">
            <div class="col-md-8 d-flex justify-content-end">
                @constituent('laravel-building::partial.resource-create-button', [
                    'icon' => 'fas fa-puzzle-piece',
                    'title' => 'Edit page sections',
                    'route' => route($routes['section.index'], $data['page']->id)
                ])
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                @include('laravel-building::page.form', [
                    'action' => route($routes['update'], $data['page']->id),
                    'edit' => true,
                    'data' => $data,
                ])
            </div>
        </div>
    </div>

@endsection
