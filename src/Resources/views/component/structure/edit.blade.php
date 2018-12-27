@extends('laravel-building::main')

@section('content')
    @constituent('laravel-building::partial.resource-page-title', [
        'icon' => 'fas fa-cog',
        'title' => 'Component structure'
    ])
    
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            @include('laravel-building::component.structure.form', [
                'action' => route($routes['update'], [
                    $data['component']->id,
                    $data['structure']->id
                ]),
                'edit' => true,
                'data' => $data,
            ])
        </div>
    </div>
@endsection
