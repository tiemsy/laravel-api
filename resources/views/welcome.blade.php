@extends('layout')
@section('title', 'Home')
@section('content')
    <div class="w-100 h-100 d-flex flex-column justify-content-center align-items-center">
        <h1 class="h1 display-4 text-white">Welcome on {{ config('app.name', 'Laravel') }}</h1>
    </div>
@endsection
