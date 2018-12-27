@extends('laravel-building::main')

@section('content')
    @constituent('laravel-building::partial.resource-page-title', [
        'icon' => 'fas fa-cog',
        'title' => 'Components'
    ])
    
    <div class="row justify-content-center my-4">
        <div class="col-md-8 d-flex justify-content-end">
            @constituent('laravel-building::partial.resource-create-button', [
                'icon' => 'fas fa-fw fa-plus',
                'title' => 'Create a new component',
                'route' => route($routes['create'])
            ])
        </div>
    </div>
    
    <div class="row justify-content-center mb4">
        <div class="col-md-8">
            @if(count($data['components']) < 1)
                <p>No components found. <a href="{{ route($routes['create']) }}">Create a new component.</a></p>
            @endif
            
            @foreach($data['components'] as $key => $component)
                @constituent('laravel-building::partial.list-group', [
                    'icon' => 'fa fa-fw fa-cog',
                    'title' => sprintf('%s <code>[%s]</code>', $component->title, $component->slug),
                    'destroy' => route($routes['destroy'], $component->id),
                    'visible' => $component->published,
                    'items' => [
                        [
                            'title' => 'Single item',
                            'icon' => sprintf('fas fa-%s', $component->single_item ? 'check' : 'times'),
                        ],[
                            'title' => 'Edit structure',
                            'icon' => 'fas fa-cog',
                            'route' => route($routes['structure.index'], $component->id),
                        ],[
                            'title' => 'Edit component',
                            'icon' => 'fas fa-cog',
                            'route' => route($routes['edit'], $component->id),
                        ]
                    ]
                ])
            @endforeach
        </div>
    </div>
@endsection
