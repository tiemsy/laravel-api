<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- CSRF Token for Ajax -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet"/>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper" id="app">
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
                        <li class="nav-item">
                            <router-link to="/users" class="nav-link">
                                <p>Users</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/tasks" class="nav-link">
                                <p>Tasks</p>
                            </router-link>
                        </li>

                    </ul>
                </div>
            </nav>
        @show

        <div class="content-wrapper">
            <div class="content">
                <div class="container-fluid">
                    <div class="w-100 h-100 d-flex flex-column justify-content-center align-items-center mt-2">
                        <h1 class="h1 display-4 text-white">{{ config('app.name', 'Laravel') }}</h1>
                    </div>
                    <router-view></router-view>
                    <vue-progress-bar></vue-progress-bar>
                </div>
            </div>
        </div>

    </div>
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
