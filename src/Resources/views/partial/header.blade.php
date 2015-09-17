<div class="row header">
	<div class="small-12 medium-6 column">
		<h1>{{ $heading }}</h1>
	</div>
	@if(isset($link))
	<div class="small-12 medium-6 column text-right">
		<a href="{{ $link }}" class="button small margin-vertical"><i class="fa fa-lg {{ $icon or '' }}"></i> {{ $title }}</a>
	</div>
	@endif
</div>