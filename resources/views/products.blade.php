@extends('layouts.main')

@section('title', 'United Events Products')

@section('content')
    <h1>BORA CARALHOOOOOOOO</h1>
    @if($busca != "")
        <p>Usuario está buscando por {{ $busca }}</p>
    @endif
@endsection
