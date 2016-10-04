@extends('metrique-building::main')

@section('content')
    @include('metrique-building::partial.header', [
        'heading'=>'Component structure',
        'link'=>route($routes['create'], $data['component']->id),
        'title'=>'New component item.',
        'icon'=>'fa-plus'
    ])

    <div class="row">
        <div class="col-xs-12">
        @if(count($data['structure']) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Order</th>
                        <th>Type</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['structure'] as $key=>$value)
                    <tr>
                        <td>
                            <a href="{{ route($routes['edit'], [$data['component']->id, $value->id]) }}">{{ $value->title }}</a>
                        </td>
                        <td>
                            {{ $value->order }}
                        </td>
                        <td>
                            {{ $value->type->title }}
                        </td>
                        <td class="text-right">
                            @include('metrique-building::partial.button-destroy', [
                                'route'=>route($routes['destroy'], [$data['component']->id, $value->id]),
                            ])
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No structure exists.</p>
        @endif
        </div>
    </div>
@endsection
