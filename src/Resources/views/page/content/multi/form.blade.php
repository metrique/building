<form class="form-horizontal" role="form" method="POST" action="{{ $action }}">
    
    @include('laravel-building::partial.form-requisites')
    
    @constituent('laravel-building::partial.input-hidden', [
        'name' => 'type',
        'value' => $data['section']->component->single_item ? 'single' : 'multi'
    ])
    
    @if(!$edit)
        <div class="card">
            <div class="card-header">
                Create content
            </div>
            <div class="card-body">
                @foreach($data['section']->component->structure as $structure)
                    <div class="form-group">
                        {!!
                            \Metrique\Building\Support\Input::input([
                                'classes' => ['form-control'],
                                'type' => $structure->type->slug,
                                'name' => \Metrique\Building\Support\Input::inputName([
                                    'structure_id' => $structure->id
                                ]),
                                'label' => $structure->title,
                                'value' => $structure->content,
                            ]);
                        !!}
                    </div>
                @endforeach
                
                @constituent('laravel-building::partial.input-number', [
                    'name' => 'order-0',
                    'label' => 'Order',
                    'value' => $edit ? $data['section']->order : old('order'),
                    'attributes' => [
                        'placeholder' => 'Larger numbers take priority.',
                        'required',
                        'steps' => 1,
                    ],
                ])
                
                @constituent('laravel-building::partial.input-checkbox', [
                    'name' => 'published[]',
                    'label' => 'Published',
                    'checked' => $edit ? $data['page']->published ? 'checked' : '' : '',
                    'value' => 0,
                    'attributes' => [
                        'id' => 'published-0',
                    ],
                ])

                @constituent('laravel-building::partial.resource-button-save', [
                    'title' => 'Save',
                ])
                
            </div>
        </div>
    @endif

    {{-- Edit form --}}
    @if($edit)
        @foreach($data['content'] as $groupId => $group)
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            Edit item {{ ++$counter }}
                        </div>
                        <div class="col-md-6 text-right">
                                @constituent('laravel-building::partial.input-submit', [
                                    'level' => 'btn-sm btn-secondary',
                                    'icon' => 'fas fa-trash',
                                    'title' => 'Delete',
                                    'attributes' => [
                                        'data-csrf' => csrf_token(),
                                        'data-role' => 'destroy',
                                        'data-route' => route($routes['destroy'], [
                                            $group->first()->pages_id,
                                            $group->first()->page_sections_id,
                                            $groupId
                                        ])
                                    ]
                                ])
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @foreach($data['section']->component->structure as $structure)
                        <div class="form-group">
                            {!!
                                \Metrique\Building\Support\Input::input([
                                    'classes' => ['form-control'],
                                    'type' => $structure->type->slug,
                                    'name' => \Metrique\Building\Support\Input::inputName([
                                        'structure_id' => $structure->id,
                                        'group_id' => $groupId,
                                        'content_id' => $content->fromGroupByStructure($group, $structure->id)->id ?? 0,
                                    ]),
                                    'label' => $structure->title,
                                    'value' => $content->fromGroupByStructure($group, $structure->id)->content ?? '',
                                ]);
                            !!}
                        </div>
                    @endforeach
                    
                    @constituent('laravel-building::partial.input-number', [
                        'name' => sprintf('order-%s', $groupId),
                        'label' => 'Order',
                        'value' => $group->first()->order,
                        'attributes' => [
                            'placeholder' => 'Larger numbers take priority.',
                            'required',
                            'steps' => 1,
                        ],
                    ])
                    
                    @constituent('laravel-building::partial.input-checkbox', [
                        'name' => 'published[]',
                        'label' => 'Published',
                        'checked' => $group->first()->published == 1 ? 'checked' : '',
                        'value' => $groupId,
                        'attributes' => [
                            'id' => sprintf('published-%s', $groupId),
                        ],
                    ])
                
                    @constituent('laravel-building::partial.resource-button-save', [
                        'title' => 'Save',
                    ])
                </div>
            </div>
        @endforeach
    @endif
</form>
