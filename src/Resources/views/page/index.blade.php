@extends('metrique-building::master')

@section('content')
	@include('metrique-building::partial.header', [
		'heading'=>'Pages',
		'link'=>route($routes['create']),
		'title'=>'New page.',
		'icon'=>'fa-plus'
	])
	
	@if(count($pages) > 0)
	<table class="row full-width">
		<thead>
			<tr>
				<th width="45%">Title</th>
				<th width="40%">Slug</th>
				<th width="5%">Published</th>
				<th width="1%"></th>
				<th width="1%"></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($pages as $key => $value)
			<tr>
				<td>
					<a href="{{ route($routes['edit'], $value->id) }}">{{ $value->title }}</a>
				</td>

				<td>{{ $value->slug }}</td>
				
				<td class="text-center">
					<i class="fa fa-lg fa-{{ $value->published ? 'check' : 'times' }}"></i>
				</td>
				
				<td class="text-right no-wrap">
					<a href="{{ route($routes['section.index'], $value->id) }}" class="button tiny">
						<i class="fa fa-pencil"></i> Edit sections</a>
				</td>

				<td class="text-right no-wrap">
					<form method="POST" action="{{ route($routes['destroy'], $value->id) }}">
						{!! csrf_field() !!}
						<input type="hidden" name="_method" value="DELETE">
						<button type="submit" class="tiny" data-role="destroy"><i class="fa fa-trash-o"></i> Delete</button>
					</form>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@else
		<p>No pages exist.</p>
	@endif
@endsection