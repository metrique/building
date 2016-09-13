@include('metrique-building::partial.errors')

<form action="{{ $action }}" method="POST">
    {!! csrf_field() !!}

    <fieldset class="panel panel-default">
        <div class="panel-body">
            <div class="col-xs-12">
                @if($edit)
                    <h3>Edit section</h3>
                    <input type="hidden" name="_method" value="PATCH">
                @else
                    <h3>Create section</h3>
                @endif
            </div>
            <div class="form-group col-xs-12">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" placeholder="My new section title.">
            </div>

            <div class="form-group col-xs-12">
                <label for="slug">Slug</label>
                <input class="form-control" type="text" name="slug" placeholder="a-z, 0-9, -, _">
            </div>

            <div class="form-group col-xs-12">
                <label for="params">Params</label>
                <input class="form-control" type="text" name="params" placeholder="Valid JSON only.">
            </div>

            <div class="form-group col-xs-12">
                <label for="type">Block</label>
                {!! $form->select('building_blocks_id', $data['blocks'], null, ['class'=>'form-control', 'placeholder'=>'Select a block type...']) !!}
            </div>

            <div class="form-group col-xs-12">
                <label for="meta">Order</label>
                <input class="form-control" type="text" name="order" placeholder="Larger numbers take priority.">
            </div>
        </div>

        {{-- Form --}}
        </div>
    </fieldset>

    <div class="row text-center">
        <div class="small-12">
            <button type="submit"><i class="fa fa-lg fa-check"></i>Save</button>
        </div>
    </div>
</form>
