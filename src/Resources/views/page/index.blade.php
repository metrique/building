@extends('metrique-building::master')

@section('content')
    @include('metrique-building::partial.header', [
        'heading'=>'Pages',
        'link'=>route($routes['create']),
        'title'=>'New page.',
        'icon'=>'fa-plus'
    ])

    <div class="row">
        <div class="col-sm-12">
            @if(count($pages) > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th width="35%">Title</th>
                            <th width="30%">Slug</th>
                            <th width="5%">Published</th>
                            <th width="auto"></th>
                            <th width="auto"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pages as $key => $value)
                            <tr>
                                <td>
                                    <a href="{{ route($routes['edit'], $value->id) }}">{{ $value->title }}</a>
                                </td>

                                <td>{{ $value->slug }}</td>

                                <td class="text-center">
                                    <p><i class="fa fa-lg fa-{{ $value->published ? 'check' : 'times' }}"></i></p>
                                </td>

                                <td class="text-right">
                                    <a href="{{ route($routes['section.index'], $value->id) }}" class="btn btn-default">
                                        <i class="fa fa-pencil"></i> Edit sections
                                    </a>
                                </td>

                                <td class="text-right">
                                    <form method="POST" action="{{ route($routes['destroy'], $value->id) }}">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" data-role="destroy"><i class="fa fa-trash-o"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No pages exist.</p>
            @endif

        </div>
    </div>
@endsection
