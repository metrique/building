@extends('metrique-building::main')

@section('content')
    @include('metrique-building::partial.header', [
        'heading'=>'Component structure',
    ])

    @include('metrique-building::component.structure.form', [
        'action' => route($routes['update'], [$data['component']->id, $data['structure']->id]),
        'edit' => true,
        'data' => $data
    ])

@endsection
