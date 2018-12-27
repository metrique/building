@extends('laravel-building::main')

@section('content')
    @constituent('laravel-building::partial.resource-page-title', [
        'icon' => 'fas fa-cog',
        'title' => 'Components'
    ])
    
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            @include('laravel-building::component.form', [
                'action' => route($routes['store']),
                'edit' => false,
                'data' => $data,
            ])
        </div>
    </div>
@endsection
