@extends('laravel-building::main')

@section('content')
    @constituent('laravel-building::partial.resource-page-title', [
        'icon' => 'fas fa-puzzle-piece',
        'title' => 'Page sections'
    ])
        
    @include('laravel-building::partial.header', [
        'heading'=>'Page contents',
        'link'=>route($routes['create'], [$data['section']->page->id, $data['section']->id]),
        'title'=>'New content',
        'icon'=>'fa-plus'
    ])

    <div class="row justify-content-center">
        <div class="col-md-8 ">
            @if($data['section']->component->structure->count() < 1)
                <p>Whoops! <a href="{{ route('component.structure.index', $data['section']->component->id) }}">{{ $data['section']->component->title }}</a> has no structure.</p>
            @else
                @if($data['content']->count() < 1)
                    @include($views['single.create'], [
                        'routes' => $routes,
                        'views' => $views,
                        'data' => $data,
                    ])
                @else
                    @include($views['single.edit'], [
                        'routes' => $routes,
                        'views' => $views,
                        'data' => $data,
                    ])
                @endif
            @endif
        </div>
    </div>
@endsection
