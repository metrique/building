@extends('laravel-building::main')

@section('content')
    @include('laravel-building::partial.header', [
        'heading'=>'Page sections',
        'link'=>route($routes['create'], $data['page']->id),
        'title'=>'New section.',
        'icon'=>'fa-plus'
    ])

    @if(count($data['section']) > 0)
        <div class="row">
            <div class="col-sm-12">
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Order</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['section'] as $key => $value)
                    <tr>
                        <td>
                            <a href="{{ route($routes['edit'], [$data['page']->id, $value->id]) }}">
                                {{ $value['title'] }}
                            </a>
                        </td>
                        <td>{{ $value['slug'] }}</td>
                        <td>{{ $value['order'] }}</td>

                        <td class="text-right">
                            <a href="{{ route($routes['content.index'], [$data['page']->id, $value->id]) }}" class="btn btn-default">
                                <i class="fa fa-pencil"></i> Edit content
                            </a>
                        </td>

                        <td class="text-right">
                            @include('laravel-building::partial.button-destroy', [
                                'route'=>route($routes['destroy'], [$data['page']->id, $value->id]),
                            ])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        This page doesn't have any sections.
    @endif
@endsection
