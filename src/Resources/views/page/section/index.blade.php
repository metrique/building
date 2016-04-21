@extends('metrique-building::master')

@section('content')
	@include('metrique-building::partial.header', [
		'heading'=>'Page sections',
		'link'=>route($routes['create']),
		'title'=>'New section.',
		'icon'=>'fa-plus'
	])
	
	@if(count($section) > 0)
	<table class="row full-width">
		<thead>
			<tr>
				<td>Title</td>
				<td>Slug</td>
				<td>Order</td>
				<td width="1%"></td>
				<td width="1%"></td>
			</tr>
		</thead>
		<tbody>
			@foreach($section as $key => $value)
			<tr>
				<td>
					<a href="{{ route($routes['edit'], [$page->id, $value['id']]) }}">
						{{ $value['title'] }}
					</a>
				</td>
				<td>{{ $value['slug'] }}</td>
				<td>{{ $value['order'] }}</td>
				
				<td class="text-right no-wrap">
					<a href="{{ route($routes['edit'], [$page->id, $value['id']]) }}" class="button tiny">
						<i class="fa fa-pencil"></i> Edit content
					</a>
				</td>

				<td class="text-right no-wrap">
					<form method="POST" action="{{ route($routes['destroy'], [$page->id, $value['id']]) }}">
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
		This page doesn't have any sections.
	@endif
@endsection