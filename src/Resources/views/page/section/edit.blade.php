@extends('metrique-building::master')

@section('content')
    @include('metrique-building::partial.header', [
        'heading'=>'Page section',
        'link'=>route($routes['index'], [$page->id, $section->id]),
        'title'=>'Edit content',
        'icon'=>'fa-pencil',
    ])

    <form action="{{ route($routes['update'], [$page->id, $section->id]) }}" method="POST" data-abide>
        {!! csrf_field() !!}
        <input type="hidden" name="_method" value="PATCH">

        <fieldset>
            <legend>Edit section</legend>

            {{-- Form --}}
            <div class="row">
                <div class="small-12 column">
                    <label for="title">Title</label>
                    <input type="text" name="title" placeholder="My section title." value="{{ $section->title }}" required>
                    <small class="error">Title is required.</small>
                </div>
                
                <div class="small-12 column">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" placeholder="a-z, 0-9, -, _" value="{{ $section->slug }}" pattern="slug" required>
                    <small class="error">Slug is required, and may only use the following characters. "a-z", "0-9", "-", "_".</small>
                </div>
                
                <div class="small-12 column">
                    <label for="params">Params</label>
                    <input type="text" name="params" placeholder="Valid JSON only." value="{{ $section->params }}" data-abide-validator="json">
                    <small class="error">Invalid JSON</small>
                </div>
                
                <div class="small-12 medium-8 column">
                    <label for="type">Block</label>
                    {!! Form::select('building_blocks_id', $blocks, $section->building_blocks_id, ['placeholder'=>'Select a block type...']) !!}
                    <small class="error">Type is required.</small>
                </div>
                <div class="small-12 medium-4 column">
                    <label for="meta">Order</label>
                    <input type="text" name="order" placeholder="Larger numbers take priority." value="{{ $section->order }}" pattern="unsigned_integer">
                    <small class="error">Only digits allowed</small>
                </div>
            </div>
        </fieldset>

        <div class="row text-center">
            <div class="small-12">
                <button type="submit"><i class="fa fa-lg fa-check"></i> {{ trans('common.save') }}</button>
            </div>
        </div>
    </form>
@endsection