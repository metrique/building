{{-- Create form --}}
@if(!$edit)
    @foreach($data['section']->component->structure as $structure)
        <div class="form-group col-xs-12">
            {!!
                $content->input([
                    'classes' => ['form-control'],
                    'type' => $structure->type->slug,
                    'name' => $content->inputName([
                        'structure_id' => $structure->id
                    ]),
                    'label' => $structure->title,
                    'value' => $structure->content,
                ]);
            !!}
        </div>
    @endforeach

    <div class="form-group col-xs-12">
        <label for="order-0">Order</label>
        <input class="form-control" type="text" name="order-0" value="0">
    </div>

    <div class="form-group col-xs-12">
        <input type="checkbox" id="published-0" name="published[]" value="0">
        <label for="published-0">Publish</label>
    </div>
@endif

{{-- Edit form}} --}}
@if($edit)
    @foreach($data['content'] as $groupId => $group)
        <fieldset class="panel panel-default">
            <div class="panel-body">
                @foreach($data['section']->component->structure as $structure)
                    <div class="form-group col-xs-12">
                        {!!
                            $content->input([
                                'classes' => ['form-control'],
                                'type' => $structure->type->slug,
                                'name' => $content->inputName([
                                    'structure_id' => $structure->id,
                                    'group_id' => $groupId,
                                    'content_id' => $content->fromGroupByStructure($group, $structure->id)->id,
                                ]),
                                'label' => $structure->title,
                                'value' => $content->fromGroupByStructure($group, $structure->id)->content,
                            ]);
                        !!}
                    </div>
                @endforeach

                <div class="form-group col-xs-12">
                    <label for="order-{{ $groupId }}">Order</label>
                    <input class="form-control" type="text" name="order-{{ $groupId }}" value="0">
                </div>

                <div class="form-group col-xs-12">
                    <input type="checkbox" id="published-{{ $groupId }}" name="published[]" value="{{ $groupId}}" {{ $content->fromGroupByStructure($group, $structure->id)->published == 1 ? 'checked' : '' }}>
                    <label for="published-{{ $groupId }}">Publish</label>
                </div>
            </div>
        </fieldset>
    @endforeach
@endif
