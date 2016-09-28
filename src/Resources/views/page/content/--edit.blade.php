@extends('metrique-building::master')

@section('content')
	@include('metrique-building::partial.header', [
			'heading'=>'Page content',
			'link'=>route($routes['create'], [$pageId, $sectionId]),
			'title'=>'New item',
			'icon'=>'fa-plus'
		])

	<form action="{{ route($routes['store'], [$pageId, $sectionId]) }}" method="POST" data-abide>
		{!! csrf_field() !!}
		<input type="hidden" name="type" value="{{ $singleItem ? 'single' : 'multi' }}">
			{{-- Loop through groups --}}
			@foreach($content as $groupId => $content)

			<fieldset>
				@if($singleItem)
					<legend>Edit content</legend>
				@else
					<legend>Item {{ ++$counter }}</legend>
				@endif
					@if(!$singleItem)
					<div class="row">
						<div class="small-12 column text-right">
							<button 
							type="submit"
							class="tiny" 
							data-role="destroy" 
							data-route="{{ route($routes['destroy'], [$pageId, $sectionId, $groupId]) }}" 
							onclick="
								(function(e){
									console.log(e);
									alert('omg');
								})()">
							<i class="fa fa-trash-o"></i> Delete
							</button>
						</div>
					</div>
					@endif

					{{-- Loop through structure --}}
					@foreach($structure as $key => $value)
						{{-- Heads up, the format is... Group::Structure::Content, zero indicates a new group and content is to be made... 
						This should probably be moved back to the repository...
						*/
							$name = sprintf('%d::%d::%d', $groupId, $value['id'], $content[$value['id']]['id']);
						/* --}}
						
						<div class="row">
							<div class="small-12 column">
								{!! \Building::input($value['type']['slug'], $name, $value['title'], $content[$value['id']]['content']) !!}
							</div>
						</div>
					@endforeach
					
					@if(!$singleItem)
					<div class="row">
						<div class="small-12 medium-2 column">
							<label for="order-{{ $groupId }}">Order</label>
							<input type="text" name="order-{{ $groupId }}" value="{{ $content[$value['id']]['order'] }}">
						</div>
					</div>
					@endif
					
					<div class="row">
						<div class="small-12 medium-6 column">
							<input type="checkbox" id="published-{{ $groupId }}" name="published[]" value="{{ $groupId }}" {{ $content[$value['id']]['published'] == 1 ? 'checked' : '' }}>
							<label for="published-{{ $groupId }}">Publish</label>
						</div>
					</div>

				</fieldset>
			@endforeach

		<div class="row text-center">
			<div class="small-12">
				<button type="submit"><i class="fa fa-lg fa-check"></i> {{ trans('common.save') }}</button>
			</div>
		</div>
	</form>
@endsection