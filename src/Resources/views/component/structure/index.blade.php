@extends('laravel-building::main')

@section('content')
    <div class="container">
        @constituent('laravel-building::partial.resource-page-title', [
            'icon' => 'fas fa-cog',
            'title' => 'Component structure'
        ])
        
        <div class="row justify-content-center my-4">
            <div class="col-md-8 d-flex justify-content-end">
                @constituent('laravel-building::partial.resource-create-button', [
                    'icon' => 'fas fa-fw fa-plus',
                    'title' => 'Create a new field',
                    'route' => route($routes['create'], $data['component']->id),
                ])
            </div>
        </div>
        
        <div class="row justify-content-center mb4">
            <div class="col-md-8">
                @if(count($data['structure']) < 1)
                    <p>No components found. <a href="{{ route($routes['create'], $data['component']->id) }}">Create a new field.</a></p>
                @else
                    @foreach($data['structure'] as $key => $structure)
                        @constituent('laravel-building::partial.list-group', [
                            'icon' => 'fa fa-fw fa-cog',
                            'title' => $structure->title,
                            'destroy' => route($routes['destroy'], [
                                $data['component']->id,
                                $structure->id
                            ]),
                            'items' => [
                                [
                                    'title' => sprintf('Edit field <code>[%s]</code>', $structure->order),
                                    'icon' => 'fas fa-cog',
                                    'route' => route($routes['edit'], [
                                        $data['component']->id, $structure->id
                                    ]),
                                ]
                            ]
                        ])
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
