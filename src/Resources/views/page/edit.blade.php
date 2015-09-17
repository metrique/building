@extends('metrique-building::master')

@section('content')
    @include('metrique-building::partial.header', [
        'heading'=>'Page',
        'link'=>route($routes['section.index'], $page->id),
        'title'=>'Edit sections',
        'icon'=>'fa-pencil',
    ])
    
    <form action="{{ route($routes['update'], $page->id) }}" method="POST" data-abide>
        {!! csrf_field() !!}
        <input type="hidden" name="_method" value="PATCH">

        <fieldset>
            <legend>Edit page</legend>

            {{-- Form --}}
            <div>
                <label for="title">Title</label>
                <input type="text" name="title" placeholder="My new page title." value="{{ $page->title }}" required>
                <small class="error">Title is required.</small>
            </div>
            
            <div>
                <label for="slug">Slug</label>
                <input type="text" name="slug" placeholder="a-z, 0-9, -, _" value="{{ $page->slug }}" pattern="slug" required>
                <small class="error">Slug is required, and may only use the following characters. "a-z", "0-9", "-", "_".</small>
            </div>
            
            <div>
                <label for="params">Params</label>
                <input type="text" name="params" placeholder="Valid JSON only." value="{{ $page->params }}" data-abide-validator="json">
                <small class="error">Invalid JSON</small>
            </div>
            
            <div>
                <label for="meta">Meta</label>
                <input type="text" name="meta" placeholder="Valid JSON only." value="{{ $page->meta }}" data-abide-validator="json">
                <small class="error">Invalid JSON</small>
            </div>
            
            <div>
                <input id="published"  name="published" type="checkbox" value="1" {{ $page->published == 1 ? 'checked="checked"' : '' }} >
                <label for="published">Published</label>
            </div>
        </fieldset>

        <div class="row text-center">
            <div class="small-12">
                <button type="submit">{{ trans('common.save') }}</button>
            </div>
        </div>
    </form>
@endsection