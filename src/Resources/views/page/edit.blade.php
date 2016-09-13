@extends('metrique-building::main')

@section('content')
    @include('metrique-building::partial.header', [
        'heading'=>'Page',
        'link'=>route($routes['section.index'], $data->id),
        'title'=>'Edit sections',
        'icon'=>'fa-pencil',
    ])
    
    @include('metrique-building::page.form', [
        'action' => route($routes['update'], $data->id),
        'edit' => true,
        'data' => $data,
    ])
@endsection
