@extends('layouts.main')

@section('title', 'United Events')

@section('content')
    @foreach($events as $event)
        <p>{{ $event->title }} - {{ $event->description }}</p>
    @endforeach
@endsection
