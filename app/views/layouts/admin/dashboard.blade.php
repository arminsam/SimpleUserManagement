<!DOCTYPE html>
<html lang="en">
    <head>
    @section('head')
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>User Management Module</title>

        <!-- Fonts -->
        <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic">
        <link type="text/css" rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}">

        <!-- Plugins style -->
        <link type="text/css" rel="stylesheet" href="{{ asset('assets/vendor/datetimepicker/jquery.datetimepicker.css') }}">

        <!-- App styles -->
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    @show
    </head>

    <body>
        <div id="container">

            @include('layouts.admin.partials.header')

            @include('components.javascript.data')

            @include('layouts.admin.partials.sidebar')

            <section id="main-content">
                <div class="wrapper site-min-height">
                    @yield('content')
                </div>
            </section>

            @include('components.messages.index')

            @include('layouts.admin.partials.footer')

        </div>

    @section('scripts')
        <!-- Scripts -->
        <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/vendor/dcjqaccordion/js/jquery.dcjqaccordion.2.7.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/vendor/jquery.scrollTo/jquery.scrollTo.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/vendor/jquery-nicescroll/dist/jquery.nicescroll.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/vendor/datetimepicker/jquery.datetimepicker.js') }}"></script>
        <script src="{{ asset('assets/vendor/bootstrap-fileinput/js/fileinput.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/vendor/holderjs/holder.min.js') }}" type="text/javascript"></script>
    @show
        <script src="{{ asset('js/main.js') }}" type="text/javascript"></script>
    </body>
</html>