@extends('metrique-building::main')

@section('content')
    @include('metrique-building::partial.header', [
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
                            <a href="{{ route($routes['edit'], [$data['page']->id, $value['id']]) }}">
                                {{ $value['title'] }}
                            </a>
                        </td>
                        <td>{{ $value['slug'] }}</td>
                        <td>{{ $value['order'] }}</td>

                        <td class="text-right no-wrap">
                            <a href="{{ route($routes['content.index'], [$data['page']->id, $value['id']]) }}" class="button tiny">
                                <i class="fa fa-pencil"></i> Edit content
                            </a>
                        </td>

                        <td class="text-right no-wrap">
                            <form method="POST" action="{{ route($routes['destroy'], [$data['page']->id, $value['id']]) }}">
                                {!! csrf_field() !!}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="tiny" data-role="destroy"><i class="fa fa-trash-o"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        This page doesn't have any sections.
    @endif
@endsection
