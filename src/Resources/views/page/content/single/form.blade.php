@foreach($data['section']->block->structure as $key => $value)
    <div class="form-group col-xs-12">
        {!!
            dd($value);
            $content->input([
                'classes' => ['form-control'],
                'type' => $value->type->slug,
                'name' => $content->inputName([
                    'structure_id' => $value->id
                ]),
                'label' => $value->title,
                'value' => $value->content,
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
