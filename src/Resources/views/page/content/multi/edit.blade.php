@extends('laravel-building::main')

@section('content')
    @constituent('laravel-building::partial.resource-page-title', [
        'icon' => 'fas fa-pencil-alt',
        'title' => 'Page content'
    ])
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row justify-content-center">
                <div class="col-md-6"><p></p></div>
                <div class="col-md-6">
                    <p class="text-right">
                        <a href="{{ route($routes['create'], [$data['section']->page->id, $data['section']->id]) }}" class="btn btn-primary">
                            Create new content.
                        </a>
                    </p>
                </div>
            </div>
            
            @include($views['multi.form'], [
                'action' => route($routes['update'], [$data['section']->page->id, $data['section']->id, 0]),
                'edit' => true,
                'counter' => 0,
                'data' => $data
            ])
        </div>
    </div>
@endsection
