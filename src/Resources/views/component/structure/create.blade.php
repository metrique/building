@extends('metrique-building::main')

@section('content')
    @include('metrique-building::partial.header', [
        'heading'=>'Component structure',
    ])

    @include('metrique-building::component.structure.form', [
        'action' => route($routes['store'], $data['component']->id),
        'edit' => false,
        'data' => $data
    ])

@endsection
