<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Blog') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">

        {{-- datable --}}
        <link href="{{ asset('DataTables/datatables.min.css')}}" rel="stylesheet">
        <link href="{{ asset('DataTables/datatables.css')}}" rel="stylesheet">
        {{-- bootstrap --}}
        <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css')}}">


        <!-- Scripts -->
        <script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
        <script src="{{ asset('DataTables/datatables.min.js')}}"></script>
        <script src="{{ asset('DataTables/datatables.js')}}"></script>
        <script src="{{ asset('sweetalert/sweetalert.min.js')}}"></script>


        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @include('sweetalert::alert')
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
