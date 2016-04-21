@extends('cms.main')

@section('content')
	@include('cms.partial.header', [
		'heading'=>'Page content',
		// 'link'=>route('cms.block.structure.create', $block->id),
		// 'title'=>'New structure',
		// 'icon'=>'fa-plus'
	])
	@include('cms.partial.breadcrumbs')
	
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