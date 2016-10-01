@extends('metrique-building::main')

@section('content')
    @include('metrique-building::partial.header', [
        'heading'=>'Page contents',
        'link'=>route($routes['create'], [$data['section']->page->id, $data['section']->id]),
        'title'=>'New content',
        'icon'=>'fa-plus'
    ])

    @if($data['section']->component->structure->count() < 1)
        <p>Whoops! <a href="{{ route('component.structure.index', $data['section']->component->id) }}">{{ $data['section']->component->title }}</a> has no structure.</p>
    @endif

    {{-- Single Item --}}
    @if($data['section']->component->single_item)
        @if($data['content']->count() < 1)
            @include($views['create'], [
                'routes' => $routes,
                'views' => $views,
                'data' => $data,
            ])
        @else
            @include($views['edit'], [
                'routes' => $routes,
                'views' => $views,
                'data' => $data,
            ])
        @endif
    @endif

    {{-- Multi Item --}}
    @if(!$data['section']->component->single_item)
        @if($data['content']->count() < 1)
            <p>No content exists.</p>
        @else
            @include($views['edit'], [
                'routes' => $routes,
                'views' => $views,
                'data' => $data,
            ])
        @endif
    @endif
@endsection
