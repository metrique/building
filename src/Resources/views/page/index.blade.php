@extends('laravel-building::main')

@section('content')
    @constituent('laravel-building::partial.resource-page-title', [
        'icon' => 'fas fa-fw fa-file-alt',
        'title' => 'Pages'
    ])
    
    <div class="row justify-content-center my-4">
        <div class="col-md-8 d-flex justify-content-end">
            @constituent('laravel-building::partial.resource-create-button', [
                'icon' => 'fas fa-fw fa-plus',
                'title' => 'Create a new page',
                'route' => route($routes['create'])
            ])
        </div>
    </div>
    
    <div class="row justify-content-center mb4">
        <div class="col-md-8">
            @if(count($data['pages']) < 1)
                <p>No pages found. <a href="{{ route($routes['create']) }}">Create a new page.</a></p>
            @endif

            @foreach($data['pages'] as $key => $page)
                @constituent('laravel-building::partial.list-group', [
                    'icon' => 'fa fa-fw fa-file',
                    'title' => sprintf('%s', $page->title),
                    'destroy' => route($routes['destroy'], $page->id),
                    'visible' => $page->published,
                    'items' => [
                        [
                            'title' => '/'. str_replace('_', '/', $page->slug),
                            'icon' => 'fas fa-external-link-alt',
                            'route' => '/'. str_replace('_', '/', $page->slug),
                        ],[
                            'title' => 'Configure page',
                            'icon' => 'fas fa-cog',
                            'route' => route($routes['edit'], $page->id),
                        ],[
                            'title' => 'Edit page sections',
                            'icon' => 'fas fa-puzzle-piece',
                            'route' => route($routes['section.index'], $page->id),
                        ]
                    ]
                ])
            @endforeach
        </div>
    </div>
@endsection
