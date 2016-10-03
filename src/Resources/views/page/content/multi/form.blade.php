<form action="{{ $action }}" method="POST">
    {!! csrf_field() !!}
    <input type="hidden" name="type" value="{{ $data['section']->component->single_item ? 'single' : 'multi' }}">

    {{-- Create form --}}
    @if(!$edit)
        <fieldset class="panel panel-default">
            <div class="panel-body">
                <div class="col-xs-12">
                    <h3>Create content</h3>
                </div>

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
            </div>
        </fieldset>
        
        <div class="row text-center">
            <div class="col-sm-12">
                @include('metrique-building::partial.button-save')
            </div>
        </div>
    @endif

    {{-- Edit form --}}
    @if($edit)
        {{ method_field('PATCH') }}

        @foreach($data['content'] as $groupId => $group)
            <fieldset class="panel panel-default">
                <div class="panel-body">
                        <div class="col-xs-6">
                            <h3>Edit item {{ ++$counter }}</h3>
                        </div>
                        <div class="col-xs-6 text-right">
                            <br>
                            <button type="submit" class="btn btn-danger" data-role="destroy" data-route="{{ route($routes['destroy'], [$group->first()->pages_id, $group->first()->page_sections_id, $groupId]) }}"><i class="fa fa-trash-o"></i> Delete</button>
                        </div>
                        <div class="col-xs-12">
                            <hr>
                        </div>
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
                        <input class="form-control" type="text" name="order-{{ $groupId }}" value="{{ $group->first()->order }}">
                    </div>

                    <div class="form-group col-xs-12">
                        <input type="checkbox" id="published-{{ $groupId }}" name="published[]" value="{{ $groupId }}" {{ $group->first()->published == 1 ? 'checked' : '' }}>
                        <label for="published-{{ $groupId }}">Publish</label>
                    </div>
                </div>
            </fieldset>
        @endforeach

        <div class="row text-center">
            <div class="col-sm-12">
                @include('metrique-building::partial.button-save')
            </div>
        </div>
    @endif
</form>
