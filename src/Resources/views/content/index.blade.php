@extends('metrique-building::main')

@section('content')
    @foreach($contents as $section)
        <section class="{{ $section->component->slug }} {{ $section->slug }}">
            @if($section->component->single_item)
                @foreach($section->content as $content)
                    @include(config('building.component.view_path') . $section->component->slug, [
                        'content' => $content->pluck('content'),
                    ])
                @endforeach
            @endif

            @if(!$section->component->single_item)
                @include(config('building.component.view_path') . $section->component->slug, [
                    'contents' => $section->content,
                ])
            @endif
        </section>
    @endforeach
@endsection
