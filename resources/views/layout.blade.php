<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"></head>
<body>
@section('navbar')
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                       href="#" id="taskNavbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Task
                    </a>
                    <div class="dropdown-menu" aria-labelledby="taskNavbarDropdown">
                        <a class="dropdown-item" href="{{route('task.index')}}">Task list</a>
                        <a class="dropdown-item" href="{{route('task.create')}}">Add task</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                       href="#" id="taskNavbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        User
                    </a>
                    <div class="dropdown-menu" aria-labelledby="taskNavbarDropdown">
                        <a class="dropdown-item" href="{{route('user.index')}}">User list</a>
                        <a class="dropdown-item" href="{{route('user.create')}}">Add user</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
@show

    <div id="app" class="w-100 h-100">
        @yield('content')
    </div>
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
