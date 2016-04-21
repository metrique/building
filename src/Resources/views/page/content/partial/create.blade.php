<form action="{{ route('cms.page.section.content.store', [$pageId, $sectionId]) }}" method="POST" data-abide>
	{!! csrf_field() !!}
	<input type="hidden" name="type" value="{{ $singleItem ? 'single' : 'multi' }}">

	<fieldset>
		<legend>New item</legend>
		@foreach($section['block']['structure'] as $key => $value)
			
			{{--
			Heads up, the format is... Group::Structure::Content, zero indicates a new group and content is to be made... 
			This should probably be moved back to the repository...
			*/
				$name = sprintf('%d::%d::%d', 0, $value['id'], 0)
			/*
			--}}
			<div class="row">
				<div class="small-12 column">
					{!! \Building::input($value['type']['slug'], $name, $value['title'], '') !!}					
				</div>
			</div>
		@endforeach

		@if(!$singleItem)
		<div class="row">
			<div class="small-12 medium-2 column">
				<label for="order-0">Order</label>
				<input type="text" name="order-0" value="0">
			</div>
		</div>
		@endif
		
		<div class="row">
			<div class="small-12 medium-6 column">
				<input type="checkbox" id="published-0" name="published[]" value="0">
				<label for="published-0">Publish</label>
			</div>
		</div>
	</fieldset>

	<div class="row text-center">
		<div class="small-12">
			<button type="submit"><i class="fa fa-lg fa-check"></i> {{ trans('common.save') }}</button>
		</div>
	</div>
</form>