@include('metrique-building::partial.errors')

<form action="{{ $action }}" method="POST">
    {!! csrf_field() !!}

    <fieldset class="panel panel-default">
        <div class="panel-body">
            <div class="col-xs-12">
                @if($edit)
                    <h3>Edit page</h3>
                    <input type="hidden" name="_method" value="PATCH">
                @else
                    <h3>Create page</h3>
                @endif
            </div>

            <div class="form-group col-xs-12">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" placeholder="My new page title." value="{{ $edit ? $data->title : old('title') }}">
            </div>

            <div class="form-group col-xs-12">
                <label for="slug">Slug</label>
                <input class="form-control" type="text" name="slug" placeholder="a-z, 0-9, -, _" value="{{ $edit ? $data->slug : old('slug') }}">
            </div>

            <div class="form-group col-xs-12">
                <label for="params">Params</label>
                <input class="form-control" type="text" name="params" placeholder="Valid JSON." value="{{ $edit ? $data->params : old('params') }}">
            </div>

            <div class="form-group col-xs-12">
                <label for="meta">Meta</label>
                <input class="form-control" type="text" name="meta" placeholder="Valid JSON." value="{{ $edit ? $data->meta : old('meta')}}">
            </div>

            <div class="col-xs-12">
                <input id="published" name="published" type="checkbox" value="1" {{ $edit ? $building->checked($data->published) : '' }}>
                <label for="published">Published</label>
            </div>

            <div class="row text-center">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </div>
    </fieldset>
</form>