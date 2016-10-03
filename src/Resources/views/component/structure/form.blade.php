@include('metrique-building::partial.errors')

<form action="{{ $action }}" method="POST">
    {!! csrf_field() !!}
    <input type="hidden" name="components_id" value="{{ $data['component']->id }}">

    <fieldset class="panel panel-default">
        <div class="panel-body">
            <div class="col-xs-12">
                @if($edit)
                    <h3>Edit component item.</h3>
                    {{ method_field('PATCH') }}
                @else
                    <h3>New component item.</h3>
                @endif
            </div>
            <div class="form-group col-xs-12">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" placeholder="My new component item title." value="{{ $edit ? $data['structure']->title : old('title') }}">
            </div>

            <div class="form-group col-xs-12">
                <label for="type">Type</label>
                {!! $form->select('component_types_id', $data['types'], $edit ? $data['structure']->component_types_id : null, ['class'=>'form-control', 'placeholder'=>'Select a component item type...']) !!}
            </div>

            <div class="form-group col-xs-12">
                <label for="meta">Order</label>
                <input class="form-control" type="text" name="order" placeholder="Larger numbers take priority." value="{{ $edit ? $data['structure']->order : old('order') }}">
            </div>
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
