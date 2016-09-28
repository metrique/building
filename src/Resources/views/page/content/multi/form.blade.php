@extends('metrique-building::master')

@section('content')
	@include('metrique-building::partial.header', [
		'heading'=>'Page content',
		'link'=>route($routes['create'], [$pageId, $sectionId]),
		'title'=>'New item',
		'icon'=>'fa-plus'
	])
	
	{{-- No structure... --}}
	@if(count($section['block']['structure']) == 0)
		<p>Whoops! <a href="{{ route('cms.block.structure.index', $section['block']['id']) }}">{{ $section['block']['title'] }}</a> has no structure.</p>
	@endif
	
	{{-- No content yet... --}}
	@if(count($content) == 0)
		<p>No content exists.</p>
	@else
		@include($views['edit'])
	@endif
@endsection