@extends('metrique-building::main')

@section('content')
    @include('metrique-building::partial.header', [
        'heading'=>'Block structure',
    ])

    @include('metrique-building::block.structure.form', [
        'action' => route($routes['update'], [$data['block']->id, $data['structure']->id]),
        'edit' => true,
        'data' => $data
    ])

@endsection
