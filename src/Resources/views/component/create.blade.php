@extends('metrique-building::main')

@section('content')
    @include('metrique-building::partial.header', [
        'heading'=>'Components',
    ])
    @include('metrique-building::component.form', [
        'action' => route($routes['store']),
        'edit' => false,
    ])
@endsection
