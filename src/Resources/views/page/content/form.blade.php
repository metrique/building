<form action="{{ $action }}" method="POST">
    {!! csrf_field() !!}
    <input type="hidden" name="type" value="{{ $data['section']->block->single_item ? 'single' : 'multi' }}">

    <fieldset class="panel panel-default">
        <div class="panel-body">
            <div class="col-xs-12">
                @if($edit)
                    <h3>Edit content</h3>
                    <input type="hidden" name="_method" value="PATCH">
                @else
                    <h3>Create content</h3>
                @endif
            </div>

            @if($data['section']->block->single_item)
                @include($views['single.form'])
            @else
                @include($views['multi.form'])
            @endif
        </div>

    </fieldset>

    <div class="row text-center">
        <div class="col-sm-12">
            @include('metrique-building::partial.button-save')
        </div>
    </div>
</form>
