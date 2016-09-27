@extends('metrique-building::main')

@section('content')
    @include('metrique-building::partial.header', [
        'heading'=>'Page sections',
    ])

    @include('metrique-building::page.section.form', [
        'action' => route($routes['update'], [$data['page']->id, $data['section']->id]),
        'edit' => true,
        'data' => $data
    ])

@endsection
