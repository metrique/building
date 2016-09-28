@foreach($data['section']->block->structure as $key => $value)
    <div class="form-group col-xs-12">
        {!!
            $content->input([
                'classes' => ['form-control'],
                'type' => $value->type->slug,
                'name' => $content->inputName([
                    'structure' => $value->id
                ]),
                'label' => $value->title,
            ]);
        !!}
    </div>
@endforeach

<div class="form-group col-xs-12">
    <label for="order-0">Order</label>
    <input type="text" name="order-0" value="0">
</div>

<div class="form-group col-xs-12">
    <input type="checkbox" id="published-0" name="published[]" value="0">
    <label for="published-0">Publish</label>
</div>
{{--
@extends('metrique-building::master')

@section('content')
	@include('metrique-building::partial.header', [
		'heading'=>'Page content',
	])

	{{-- No structure... --}}
	@if(count($section['block']['structure']) == 0)
		<p>Whoops! <a href="{{ route('cms.block.structure.index', $section['block']['id']) }}">{{ $section['block']['title'] }}</a> has no structure.</p>
	@endif

	{{-- No content yet... --}}
	@if(count($content) == 0)
		@include('cms.building.page.content.single.create')
	@else
		@include('cms.building.page.content.single.edit')
	@endif
@endsection
--}}
