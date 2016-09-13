@extends('metrique-building::main')

@section('content')
    @include('metrique-building::partial.header', [
        'heading'=>'Block',
        'link'=>route($routes['create']),
        'title'=>'New block.',
        'icon'=>'fa-plus'
    ])

    <div class="row">
        <div class="col-xs-12">
        @if(count($data) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Single item</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key=>$value)
                    <tr>
                        <td>
                            <a href="{{ route($routes['edit'], $value->id) }}">{{ $value->title }}</a>
                        </td>
                        <td>{{ $value->slug }}</td>
                        <td>
                            <i class="fa fa-lg fa-{{ $value->single_item ? 'check' : 'times' }}"></i>
                        </td>
                        <td>Edit sections?</td>
                        <td></td>
                        <td class="text-right">
                            @include('metrique-building::partial.button-destroy', [
                                'route'=>route($routes['destroy'], $value->id),
                            ])
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No blocks exist.</p>
        @endif
        </div>
    </div>
@endsection
