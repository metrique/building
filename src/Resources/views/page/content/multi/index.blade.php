@extends('laravel-building::main')

@section('content')
    @constituent('laravel-building::partial.resource-page-title', [
        'icon' => 'fas fa-pencil-alt',
        'title' => 'Page content'
    ])
    
    <div class="row justify-content-center mt-4 mb-4">
        <div class="col-md-8 d-flex justify-content-end">
            @constituent('dashboard.resource-create-button', [
                'icon' => 'fas fa-fw fa-plus',
                'title' => 'Create new content',
                'route' => route($routes['create'], [$data['section']->page->id, $data['section']->id])
            ])
        </div>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if($data['section']->component->structure->count() < 1)
                <p>Whoops! <a href="{{ route('component.structure.index', $data['section']->component->id) }}">{{ $data['section']->component->title }}</a> has no structure.</p>
            @else
                @if($data['content']->count() < 1)
                    <p>No content exists. <a href="{{ route($routes['create'], [$data['section']->page->id, $data['section']->id]) }}">Create new content</a></p>
                @else
                    @include($views['multi.edit'], [
                        'routes' => $routes,
                        'views' => $views,
                        'data' => $data,
                    ])
                @endif
            @endif
        </div>
    </div>
@endsection
