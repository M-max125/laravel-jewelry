<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GlamourLANE') }} | @yield('title','')</title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,400;0,700;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/fontawesome.min.css" integrity="sha512-kJ30H6g4NGhWopgdseRb8wTsyllFUYIx3hiUwmGAkgA9B/JbzUBDQVr2VVlWGde6sdBVOG7oU8AL35ORDuMm8g==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    
    <!-- Styles -->
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.3/umd/popper.min.js" integrity="sha512-53CQcu9ciJDlqhK7UD8dZZ+TF2PFGZrOngEYM/8qucuQba+a+BXOIRsp9PoMNJI3ZeLMVNIxIfZLbG/CdHI5PA==" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
    <script src="{{ asset('js/sample.js') }}" ></script>
    @yield('extra-js')
    
    <!-- Fonts -->
    
    
  
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm main-navigation">
            <div class="container">
                <div class="animated fadeInUp">
                <a class="navbar-brand" href="{{ route('home') }}">
                    {{ config('app.name', 'GlamourLANE') }}
                </a>
                </div>

                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto mc-nav">
                        <!-- Authentication Links -->

                        
                        
                        
                        @guest
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                           
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            

                           
                            @else
                            <li class="nav-item dropdown profile">
                                
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                    @if(Auth::user()->avatar)
                                    <img src="{{asset('/storage/images/avatar/'.Auth::user()->avatar)}}" class="rounded-circle" alt="user_photo" width="40" height="40">
                                    @endif
                                   
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                   
                                    <a class="dropdown-item" href="{{route('profile.edit')}}"><i class="fas fa-user-cog"></i>My account</a>
                                      
                                    
                                
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     
                                                       {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                            

                            
                        @endguest
                        <li class="nav-item">
                                    <a class="nav-link" href="{{ route('cart.index') }}">Cart<i class="fa fa-shopping-cart"></i><span>
                                    @if (Cart::instance('default')->count() > 0 )
                                        <span class="bg-danger small text-white px-2 py-1 rounded-circle">{{Cart::instance('default')->count()}}</span></span>
                                    @endif
                                    </a>
                        </li>
                        <li class="nav-item">
                        <form action="{{route('search')}}" method="GET">
                        
                        <input class="form-control mr-sm-2" type="text" 
                        placeholder="Search product" aria-label="Search" name="query" id="query" value="{{request()->input('query')}}">
                        </form>
                        </li>
                        
                      
                         
                    </ul>
                </div>
            </div>
        </nav>

        
        

       <main class="py-1">
           @yield('content')
        </main>
    
       
    </div>
    @yield('stripe-js')
</body>
</html>
