<div class="card">
    <div class="card-header">
        @if($edit)
            Edit content
        @else
            Create content
        @endif
    </div>

    <div class="card-body">
        <form class="form-horizontal" role="form" method="POST" action="{{ $action }}">
            
            @include('laravel-building::partial.form-requisites')

            @constituent('laravel-building::partial.input-hidden', [
                'name' => 'type',
                'value' => $data['section']->component->single_item ? 'single' : 'multi'
            ])

            {{-- Create form --}}
            @if(!$edit)
                @foreach($data['section']->component->structure as $structure)
                    <div class="form-group">
                        {!!
                            \Metrique\Building\Support\Input::input([
                                'type' => $structure->type->slug,
                                'name' => Metrique\Building\Support\Input::inputName([
                                    'structure_id' => $structure->id
                                ]),
                                'label' => $structure->title,
                            ]);
                        !!}
                    </div>
                @endforeach
                
                @constituent('laravel-building::partial.input-checkbox', [
                    'name' => 'published[]',
                    'label' => 'Published',
                    'checked' => false,
                    'value' => 0,
                    'attributes' => [
                        'id' => 'published-0',
                    ],
                ])
            @endif

            {{-- Edit form --}}
            @if($edit)
                @foreach($data['content'] as $groupId => $group)
                    @foreach($data['section']->component->structure as $structure)
                        <div class="form-group">
                            {!!
                                Metrique\Building\Support\Input::input([
                                    'type' => $structure->type->slug,
                                    'name' => Metrique\Building\Support\Input::inputName([
                                        'structure_id' => $structure->id,
                                        'group_id' => $groupId,
                                        'content_id' => $content->fromGroupByStructure($group, $structure->id)->id,
                                    ]),
                                    'label' => $structure->title,
                                    'value' => $content->fromGroupByStructure($group, $structure->id)->content ?? '',
                                ]);
                            !!}
                        </div>
                    @endforeach
                    
                    @constituent('laravel-building::partial.input-checkbox', [
                        'name' => 'published[]',
                        'label' => 'Published',
                        'checked' => $group->first()->published == 1 ? 'checked' : '',
                        'value' => $groupId,
                        'attributes' => [
                            'id' => sprintf('published-%s', $groupId),
                        ],
                    ])
                @endforeach
            @endif

            @constituent('laravel-building::partial.resource-button-save', [
                'title' => 'Save',
            ])
        </form>
    </div>
</div>
