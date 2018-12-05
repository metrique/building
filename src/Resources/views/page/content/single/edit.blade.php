@extends('laravel-building::main')

@section('content')
    <div class="container">
        @constituent('laravel-building::partial.resource-page-title', [
            'icon' => 'fas fa-pencil-alt',
            'title' => 'Page content'
        ])
        
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                @include($views['single.form'], [
                    'action' => route($routes['update'], [
                        $data['section']->page->id,
                        $data['section']->id, 0
                    ]),
                    'edit' => true,
                    'data' => $data
                ])
            </div>
        </div>
    </div>
@endsection
