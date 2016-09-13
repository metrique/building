@extends('metrique-building::main')

@section('content')
    @include('metrique-building::partial.header', [
        'heading'=>'Page sections',
    ])

    @include('metrique-building::page.section.form', [
        'action' => route($routes['store'], $data['page']->id),
        'edit' => false,
        'data' => $data
    ])

@endsection
