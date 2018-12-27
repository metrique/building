@extends('laravel-building::main')

@section('content')
    @constituent('laravel-building::partial.resource-page-title', [
        'icon' => 'fas fa-cog',
        'title' => 'Component structure'
    ])
    
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            @include('laravel-building::component.form', [
                'action' => route($routes['update'], $data['component']->id),
                'edit' => true,
                'data' => $data,
            ])
        </div>
    </div>
@endsection
