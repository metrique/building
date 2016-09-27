@extends('metrique-building::main')

@section('content')
    @include('metrique-building::partial.header', [
        'heading'=>'Block structure',
    ])

    @include('metrique-building::block.structure.form', [
        'action' => route($routes['store'], $data['block']->id),
        'edit' => false,
        'data' => $data
    ])

@endsection
