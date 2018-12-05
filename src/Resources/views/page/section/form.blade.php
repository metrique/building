<div class="card">
    <div class="card-header">
        @if($edit)
            Configure page section
        @else
            Create a new page section
        @endif
    </div>

    <div class="card-body">
        <form class="form-horizontal" role="form" method="POST" action="{{ $action }}">
            
            @include('laravel-building::partial.form-requisites')
            
            @constituent('laravel-building::partial.input-hidden', [
                'name' => 'pages_id',
                'value' => $data['page']->id
            ])
            
            @constituent('laravel-building::partial.input-text', [
                'name' => 'title',
                'value' => $edit ? $data['section']->title : '',
                'attributes' => [
                    'autofocus',
                    'placeholder' => 'My new section title.',
                    'required',
                ],
            ])
            
            @constituent('laravel-building::partial.input-text', [
                'name' => 'params',
                'value' => $edit ? $data['section']->params : '',
                'attributes' => [
                    'placeholder' => 'Valid JSON only.',
                    'required',
                ],
            ])
            
            @constituent('laravel-building::partial.input-select', [
                'name' => 'components_id',
                'label' => 'Component',
                'value' => $edit ? $data['section']->components_id : null,
                'values' => $data['components'],
                'attributes' => [
                    'disabled' => $edit,
                    'placeholder' => 'Select a component',
                    'required',
                ]
            ])
            
            @if($edit)
                @constituent('laravel-building::partial.input-hidden', [
                    'name' => 'components_id',
                    'value' => $data['section']->components_id,
                ])
            @endif
        
            @constituent('laravel-building::partial.input-number', [
                'name' => 'order',
                'value' => $edit ? $data['section']->order : '',
                'attributes' => [
                    'placeholder' => 'Larger numbers take priority.',
                    'required',
                    'steps' => 1,
                ],
            ])

            @constituent('laravel-building::partial.resource-button-save')
            
        </form>
    </div>
</div>
