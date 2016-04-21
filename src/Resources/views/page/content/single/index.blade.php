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