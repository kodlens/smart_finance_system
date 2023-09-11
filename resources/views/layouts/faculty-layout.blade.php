<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
 --}}

</head>
<body>
    <div id="app">
        <b-navbar>
            <template #brand>
                <b-navbar-item>
                    FACULTY PANEL
                </b-navbar-item>
            </template>
            <template #start>
                
                <!-- <b-navbar-dropdown label="Info">
                    <b-navbar-item href="#">
                        About
                    </b-navbar-item>
                    <b-navbar-item href="#">
                        Contact
                    </b-navbar-item>
                </b-navbar-dropdown> -->
            </template>

            <template #end>
                <b-navbar-item href="/faculty-dashboard">
                    Home
                </b-navbar-item>

                <b-navbar-item href="/faculty-faculty-load">
                    Faculty Load
                </b-navbar-item>

                <b-navbar-item href="/faculty-profile">
                    {{ strtoupper(Auth::user()->fname) }}
                </b-navbar-item>

                <b-navbar-item tag="div">
                    <div class="buttons">
                        <b-button 
                            onclick="logout()"
                            icon-left="logout"
                            class="button is-primary" outlined>
                        </b-button>
                    </div>
                </b-navbar-item>
            </template>
        </b-navbar>

        <form action="/logout" id="logout" method="post">
            @csrf
        </form>

    <div>
        @yield('content')
    </div>

    </div>

    <script>
        function logout(){
            document.getElementById('logout').submit();
        }
    </script>
</body>
</html>
