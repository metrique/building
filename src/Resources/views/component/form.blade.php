<div class="card">
    <div class="card-header">
        @if($edit)
            Configure component
        @else
            Create a new component
        @endif
    </div>
    <div class="card-body">
        <form class="form-horizontal" role="form" method="POST" action="{{ $action }}">
            
            @include('laravel-building::partial.form-requisites')
            
            @constituent('laravel-building::partial.input-text', [
                'name' => 'title',
                'value' => $edit ? $data['component']->title : '',
                'attributes' => [
                    'autofocus',
                    'placeholder' => 'Title',
                    'required'
                ],
            ])
            
            @constituent('laravel-building::partial.input-text', [
                'name' => 'slug',
                'value' => $edit ? $data['component']->slug : '',
                'attributes' => [
                    'placeholder' => 'a-z, 0-9, -, _',
                    'required'
                ],
            ])
            
            @constituent('laravel-building::partial.input-text', [
                'name' => 'params',
                'value' => $edit ? $data['component']->params : '',
                'attributes' => [
                    'placeholder' => 'Valid JSON.',
                    'required',
                ],
            ])
            
            @constituent('laravel-building::partial.input-checkbox', [
                'name' => 'single_item',
                'checked' => $edit ? $data['component']->single_item ? 'checked' : '' : '',
                'value' => 1,
                'attributes' => [
                ],
            ])
            
            @constituent('laravel-building::partial.resource-button-save', [
                'title' => 'Save',
            ])

        </form>
    </div>
</div>
