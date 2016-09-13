@extends('metrique-building::main')

@section('content')
    @include('metrique-building::partial.header', [
        'heading'=>'Pages',
    ])
    @include('metrique-building::page.form', [
        'action' => route($routes['store']),
        'edit' => false,
    ])
@endsection
