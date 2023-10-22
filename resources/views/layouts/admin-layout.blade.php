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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>
<body>
    <div id="app">

        <b-navbar>
            <template #brand>
                <b-navbar-item>
                    <img
                        src=""
                        alt=""
                    >
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
                <b-navbar-item href="/dashboard">
                    Home
                </b-navbar-item>

                <b-navbar-dropdown label="Settings">

                    <b-navbar-item href="/academic-years">
                        Academic Years
                    </b-navbar-item>
                    <b-navbar-item href="/allotment-classes">
                        Allotment Class
                    </b-navbar-item>
                    <b-navbar-item href="/allotment-class-accounts">
                        Allotment Class Accounts
                    </b-navbar-item>
                    <b-navbar-item href="/supplier-payee">
                        Supplier/Payee
                    </b-navbar-item>
                    <b-navbar-item href="/transaction-types">
                        Transaction Types
                    </b-navbar-item>
                    <b-navbar-item href="/documentary-attachments">
                        Documentary Attachments
                    </b-navbar-item>
                    <b-navbar-item href="/offices">
                        Office/Institutes
                    </b-navbar-item>

                </b-navbar-dropdown>

                <b-navbar-dropdown label="Services">

                    <b-navbar-item href="/accounting">
                        Accounting
                    </b-navbar-item>
                    <b-navbar-item href="/budgeting">
                        Budgeting
                    </b-navbar-item>
                    <b-navbar-item href="/procurement">
                        Procurement
                    </b-navbar-item>

                </b-navbar-dropdown>


                <b-navbar-item href="/users">
                    Users
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
