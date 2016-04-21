@extends('cms.main')

@section('content')
	@include('cms.partial.header', [
		'heading'=>'Page content',
		'link'=>route('cms.page.section.content.create', [$pageId, $sectionId]),
		'title'=>'New item',
		'icon'=>'fa-plus'
	])
	@include('cms.partial.breadcrumbs')
	@include('cms.building.page.content.partial.create')

@endsection