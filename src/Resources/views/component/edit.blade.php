@extends('metrique-building::main')

@section('content')
    @include('metrique-building::partial.header', [
        'heading'=>'Components',
    ])
    @include('metrique-building::component.form', [
        'action' => route($routes['update'], $data->id),
        'edit' => true,
    ])
@endsection
