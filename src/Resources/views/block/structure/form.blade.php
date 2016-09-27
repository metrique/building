@include('metrique-building::partial.errors')

<form action="{{ $action }}" method="POST">
    {!! csrf_field() !!}
    <input type="hidden" name="building_block_id" value="{{ $data['block']->id }}">

    <fieldset class="panel panel-default">
        <div class="panel-body">
            <div class="col-xs-12">
                @if($edit)
                    <h3>Edit block item.</h3>
                    <input type="hidden" name="_method" value="PATCH">
                @else
                    <h3>New block item.</h3>
                @endif
            </div>
            <div class="form-group col-xs-12">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" placeholder="My new block item title." value="{{ $edit ? $data['structure']->title : old('title') }}">
            </div>

            <div class="form-group col-xs-12">
                <label for="type">Type</label>
                {!! $form->select('building_block_types_id', $data['types'], $edit ? $data['blocks']->building_block_types_id : null, ['class'=>'form-control', 'placeholder'=>'Select a block item type...']) !!}
            </div>

            <div class="form-group col-xs-12">
                <label for="meta">Order</label>
                <input class="form-control" type="text" name="order" placeholder="Larger numbers take priority." value="{{ $edit ? $data['block']->order : old('order') }}">
            </div>
            {{--
            <div class="form-group col-xs-12">
                <label for="slug">Slug</label>
                <input class="form-control" type="text" name="slug" placeholder="a-z, 0-9, -, _" value="{{ $edit ? $data['section']->slug : old('slug') }}">
            </div>

            <div class="form-group col-xs-12">
                <label for="params">Params</label>
                <input class="form-control" type="text" name="params" placeholder="Valid JSON only." value="{{ $edit ? $data['section']->params : old('params') }}">
            </div>


            --}}
        </div>

        {{-- Form --}}
        </div>
    </fieldset>

    <div class="row text-center">
        <div class="col-sm-12">
            @include('metrique-building::partial.button-save')
        </div>
    </div>
</form>
