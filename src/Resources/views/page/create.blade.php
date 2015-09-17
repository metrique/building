@extends('metrique-building::master')

@section('content')
    @include('metrique-building::partial.header', [
        'heading'=>'Pages',
    ])
    
    <form action="{{ route($routes['store']) }}" method="POST" data-abide>
        {!! csrf_field() !!}
        <fieldset>
            <legend>New page</legend>

            {{-- Form --}}
            <div>
                <label for="title">Title</label>
                <input type="text" name="title" placeholder="My new page title." required>
                <small class="error">Title is required.</small>
            </div>
            
            <div>
                <label for="slug">Slug</label>
                <input type="text" name="slug" placeholder="a-z, 0-9, -, _" pattern="slug" required>
                <small class="error">Slug is required, and may only use the following characters. "a-z", "0-9", "-", "_".</small>
            </div>
            
            <div>
                <label for="params">Params</label>
                <input type="text" name="params" placeholder="Valid JSON only." data-abide-validator="json">
                <small class="error">Invalid JSON</small>
            </div>
            
            <div>
                <label for="meta">Meta</label>
                <input type="text" name="meta" placeholder="Valid JSON only." data-abide-validator="json">
                <small class="error">Invalid JSON</small>
            </div>

            <div>
                <input id="published" name="published" type="checkbox" value="1">
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