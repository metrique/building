@extends('metrique-building::master')

@section('content')
    @include('metrique-building::partial.header', [
        'heading'=>'Page',
        'link'=>route($routes['section.index'], $page->id),
        'title'=>'Edit sections',
        'icon'=>'fa-pencil',
    ])

    <form action="{{ route($routes['update'], $page->id) }}" method="POST">
        {!! csrf_field() !!}

        <legend>Edit page</legend>
        <input type="hidden" name="_method" value="PATCH">

        <div class="form-group col-xs-12">
            <label for="title">Title</label>
            <input class="form-control" type="text" name="title" placeholder="My new page title." value="{{ $page->title }}">
        </div>

        <div class="form-group col-xs-12">
            <label for="slug">Slug</label>
            <input class="form-control" type="text" name="slug" placeholder="a-z, 0-9, -, _" value="{{ $page->slug }}">
        </div>

        <div class="form-group col-xs-12">
            <label for="params">Params</label>
            <input class="form-control" type="text" name="params" placeholder="Valid JSON only." value="{{ $page->params }}">
        </div>

        <div class="form-group col-xs-12">
            <label for="meta">Meta</label>
            <input class="form-control" type="text" name="meta" placeholder="Valid JSON only." value="{{ $page->meta }}">
        </div>

        <div class="form-group col-xs-12">
            <input class="form-control" id="published" name="published" type="checkbox" value="1" {{ $page->published == true ? 'checked="checked"' : '' }} >
            <label for="published">Published</label>
        </div>

        <div class="row text-center">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </div>
    </form>
@endsection
