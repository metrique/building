<div class="card">
    <div class="card-header">
        @if($edit)
            Configure page
        @else
            Create a new page
        @endif
    </div>
    <div class="card-body">
        <form class="form-horizontal" role="form" method="POST" action="{{ $action }}">
            
            @include('laravel-building::partial.form-requisites')
            
            @constituent('laravel-building::partial.input-text', [
                'name' => 'title',
                'value' => $edit ? $data['page']->title : '',
                'attributes' => [
                    'autofocus',
                    'placeholder' => 'Page title',
                    'required'
                ],
            ])
            
            @constituent('laravel-building::partial.input-text', [
                'name' => 'description',
                'value' => $edit ? $data['page']->description : '',
                'attributes' => [
                    'placeholder' => 'Description',
                    'required'
                ],
            ])
            
            @constituent('laravel-building::partial.input-text', [
                'name' => 'slug',
                'value' => $edit ? $data['page']->slug : '',
                'attributes' => [
                    'placeholder' => 'a-z, 0-9, -, _',
                    'required'
                ],
            ])
            
            @constituent('laravel-building::partial.input-text', [
                'name' => 'params',
                'value' => $edit ? $data['page']->params : '',
                'attributes' => [
                    'placeholder' => 'Valid JSON.',
                    'required',
                ],
            ])
            
            @constituent('laravel-building::partial.input-text', [
                'name' => 'meta',
                'value' => $edit ? $data['page']->meta : '',
                'attributes' => [
                    'placeholder' => 'Valid JSON.',
                    'required'
                ],
            ])
            
            @constituent('laravel-building::partial.input-checkbox', [
                'name' => 'published',
                'checked' => $edit ? $data['page']->published ? 'checked' : '' : '',
                'value' => 1,
                'attributes' => [
                    'placeholder' => 'Valid JSON.',
                ],
            ])
            
            @constituent('laravel-building::partial.resource-button-save', [
                'title' => 'Save',
            ])

        </form>
    </div>
</div>
