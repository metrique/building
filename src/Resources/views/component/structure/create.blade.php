@extends('laravel-building::main')

@section('content')
    @constituent('laravel-building::partial.resource-page-title', [
        'icon' => 'fas fa-cog',
        'title' => 'Component structure'
    ])
    
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            @include('laravel-building::component.structure.form', [
                'action' => route($routes['store'], $data['component']->id),
                'edit' => false,
                'data' => $data
            ])
        </div>
    </div>
    
@endsection
