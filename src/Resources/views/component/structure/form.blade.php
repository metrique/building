<div class="card">
    <div class="card-header">
        @if($edit)
            Configure component structure
        @else
            Create a new component structure
        @endif
    </div>
    <div class="card-body">
        <form class="form-horizontal" role="form" method="POST" action="{{ $action }}">
            
            @include('laravel-building::partial.form-requisites')
            
            @constituent('laravel-building::partial.input-hidden', [
                'name' => 'components_id',
                'value' => $data['component']->id
            ])
            
            @constituent('laravel-building::partial.input-text', [
                'name' => 'title',
                'value' => $edit ? $data['structure']->title : '',
                'attributes' => [
                    'autofocus',
                    'placeholder' => 'Title',
                    'required'
                ],
            ])
            
            @if($edit)
                @constituent('laravel-building::partial.input-hidden', [
                    'name' => 'component_types_id',
                    'value' => $data['structure']->components_id 
                ])
            @endif
            
            @constituent('laravel-building::partial.input-select', [
                'name' => sprintf('component_types_id%s', $edit ? '_disabled': ''),
                'label' => 'Component type',
                'value' => $edit ? $data['structure']->components_id : '',
                'values' => $data['types'],
                'attributes' => [
                    'disabled' => $edit,
                    'placeholder' => 'Select a component',
                    'required',
                ]
            ])
            
            @constituent('laravel-building::partial.input-number', [
                'name' => 'order',
                'value' => $edit ? $data['structure']->order : '',
                'attributes' => [
                    'placeholder' => 'Larger numbers take priority.',
                    'required',
                    'steps' => 1,
                ],
            ])
            
            @constituent('laravel-building::partial.resource-button-save', [
                'title' => 'Save',
            ])
        </form>
    </div>
</div>
