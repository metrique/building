@extends('metrique-building::master')

@section('content')
    @include('metrique-building::partial.header', [
        'heading'=>'Pages',
    ])
    <form action="{{ route($routes['store']) }}" method="POST">
        {!! csrf_field() !!}
        <legend>Create page</legend>
        <input type="hidden" name="_method" value="PATCH">

        <div class="form-group col-xs-12">
            <label for="title">Title</label>
            <input class="form-control" type="text" name="title" placeholder="My new page title.">
        </div>

        <div class="form-group col-xs-12">
            <label for="slug">Slug</label>
            <input class="form-control" type="text" name="slug" placeholder="a-z, 0-9, -, _" >
        </div>

        <div class="form-group col-xs-12">
            <label for="params">Params</label>
            <input class="form-control" type="text" name="params" placeholder="Valid JSON only.">
        </div>

        <div class="form-group col-xs-12">
            <label for="meta">Meta</label>
            <input class="form-control" type="text" name="meta" placeholder="Valid JSON only.">
        </div>

        <div class="form-group col-xs-12">
            <input class="form-control" id="published" name="published" type="checkbox" value="1">
            <label for="published">Published</label>
        </div>

        <div class="row text-center">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </div>
    </form>
@endsection
