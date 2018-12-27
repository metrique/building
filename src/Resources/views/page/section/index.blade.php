@extends('laravel-building::main')

@section('content')
    @constituent('laravel-building::partial.resource-page-title', [
        'icon' => 'fas fa-puzzle-piece',
        'title' => 'Page sections'
    ])
    
    <div class="row justify-content-center my-4">
        <div class="col-md-8 d-flex justify-content-end">
            @constituent('laravel-building::partial.resource-create-button', [
                'icon' => 'fas fa-fw fa-plus',
                'title' => 'Create a new section',
                'route' => route($routes['create'], $data['page']->id)
            ])
        </div>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            @if(count($data['section']) < 1)
                <p>No sections found. <a href="{{ route($routes['create'], $data['page']->id) }}">Create a new section.</a></p>
            @endif

            @foreach($data['section'] as $key => $section)
                @constituent('laravel-building::partial.list-group', [
                    'icon' => 'fas fa-puzzle-piece',
                    'title' => sprintf('%s <code>[%s]</code>', $section->title, $section->slug),
                    'destroy' => route($routes['destroy'], [$data['page']->id, $section->id]),
                    'items' => [
                        [
                            'title' => sprintf(
                                '%s <code>[%s]</code>',
                                $section->component->title,
                                $section->component->slug
                            ),
                            'icon' => 'fas fa-plug',
                        ],[
                            'title' => sprintf('Configure section <code style="font-weight: normal;">[%s]</code>' , $section->order),
                            'icon' => 'fas fa-cog',
                            'route' => route($routes['edit'], [$data['page']->id, $section->id])
                        ],[
                            'title' => 'Edit content',
                            'icon' => 'fas fa-edit',
                            'route' => route($routes['content.index'], [$data['page']->id, $section->id])
                        ]
                    ],
                ])
            @endforeach
        </div>
    </div>
@endsection
