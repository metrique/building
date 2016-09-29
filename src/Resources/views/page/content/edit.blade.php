@extends('metrique-building::main')

@section('content')
    @include('metrique-building::partial.header', [
        'heading'=>'Page sections',
    ])
    
    @include($views['form'], [
        'action' => route($routes['update'], [$data['section']->page->id, $data['section']->id, 0]),
        'edit' => true,
        'data' => $data
    ])
@endsection
