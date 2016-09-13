@extends('metrique-building::main')

@section('content')
    @include('metrique-building::partial.header', [
        'heading'=>'Blocks',
    ])
    @include('metrique-building::block.form', [
        'action' => route($routes['store']),
        'edit' => false,
    ])
@endsection
