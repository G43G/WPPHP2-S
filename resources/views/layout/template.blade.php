<!DOCTYPE HTML>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <meta name="description" content="Photos"/>
        <meta name="keywords" content="Photos, Gallery, Category, People, Nature, Animals, Places, Objects, Upload, Like"/>
        <meta name="author" content="Bogdan Matorkić">
        <link rel="stylesheet" href="{{ asset('/') }}css/main.css"/>
        <link rel="shortcut icon" href="{{ asset('/') }}images/favicon.ico"/>
        <title>@yield('title')</title>
        
    </head>
    <body>
        <div class="page-wrap">

            <!-- Nav -->
            @include('components.navigation')

            <!-- Main -->
            <section id="main">
                
            @if(session()->has('user'))
                <div class="login-message">
                    <h3>Logged in as: {{ session()->get('user')[0]->user_name }}</h3>
                    <div class="arrow-down"></div>
                </div>
            @endif
                
            @yield('center')
            
            <div class="messages">
                @isset($errors)
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="error"><i class="fa fa-exclamation-triangle"></i><p>{{ $error }}</p><i class="fa fa-times-circle close"></i></div>
                        @endforeach
                      @endif
                @endisset

                @empty(!session('error'))
                    <div class="error"><i class="fa fa-exclamation-triangle"></i><p>{{ session('error') }}</p><i class="fa fa-times-circle close"></i></div>
                @endempty

                @empty(!session('success'))
                    <div class="success"><i class="fa fa-thumbs-up"></i><p>{{ session('success') }}</p><i class="fa fa-times-circle close"></i></div>
                @endempty
            </div>
            
            <!-- Footer -->
            @include('components.footer')
            </section>
        </div>

        <!-- Scripts -->
        @section('scripts')
        
        <script>
            const baseUrl = "{{ asset('/') }}";
            const token = "{{ csrf_token() }}";
        </script>
        <script src="{{ asset('/') }}js/jquery.min.js"></script>
        <script src="{{ asset('/') }}js/jquery.poptrox.min.js"></script>
        <script src="{{ asset('/') }}js/jquery.scrolly.min.js"></script>
        <script src="{{ asset('/') }}js/skel.min.js"></script>
        <script src="{{ asset('/') }}js/util.js"></script>
        <script src="{{ asset('/') }}js/main.js"></script>
        <script src="{{ asset('/') }}js/my.js"></script>
        @show
    </body>
</html>
