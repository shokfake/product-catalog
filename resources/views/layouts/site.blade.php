<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Bootstrap-ecommerce by Vosidiy">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">

    <!-- jQuery -->
    {{--    <script src="{{ asset('js/jquery-2.0.0.min.js') }}" defer></script>--}}
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Bootstrap4 files-->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('css/bootstrap.css') }}" defer></script>
    <script src="{{ asset('fonts/fontawesome/css/fontawesome-all.min.css') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ui.css') }}" rel="stylesheet">

</head>
<body>
<header class="section-header">
   @auth
    <nav class="navbar navbar-top navbar-expand-lg navbar-dark bg-secondary">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTop" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTop">
                <ul class="navbar-nav ml-auto">
                    @can('user-list')
                        <li><a class="nav-link" href="{{ route('users.index') }}">Manage Users</a></li>
                    @endcan
                    @can('role-list')
                        <li><a class="nav-link" href="{{ route('roles.index') }}">Manage Role</a></li>
                    @endcan
                    @can('category-list')
                        <li><a class="nav-link" href="{{ route('categories.index') }}">Manage Category</a></li>
                    @endcan
                    @can('product-list')
                        <li><a class="nav-link" href="{{ route('products.index') }}">Manage Product</a></li>
                    @endcan
                </ul> <!-- list-inline //  -->
            </div> <!-- navbar-collapse .// -->
        </div> <!-- container //  -->
    </nav>
   @endauth
    <section class="header-main">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5-24 col-sm-5 col-4">
                    <div class="brand-wrap">
                        <img class="logo" src="{{asset('images/logo-dark.png')}}">
                        <h2 class="logo-text">LOGO</h2>
                    </div> <!-- brand-wrap.// -->
                </div>
                <div class="col-lg-13-24 col-sm-12 order-3 order-lg-2">
                    <form action="#">
                        <div class="input-group w-100">
                            <select class="custom-select" name="category_name">
                                @foreach($categories as $category)
                                    <option value="">All type</option>
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            <input type="text" class="form-control" style="width:60%;" placeholder="Search">

                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="glyphicon glyphicon-search" aria-hidden="true">search</i>
                                </button>
                            </div>
                        </div>
                    </form> <!-- search-wrap .end// -->
                </div> <!-- col.// -->
                @guest
                <div class="col-lg-6-24 col-sm-7 col-8  order-2  order-lg-3">
                    <div class="d-flex justify-content-end">
                        <div class="widget-header">
                                <small class="title text-muted">Welcome guest!</small>
                                <div><a href=href="{{route('login')}}">Sign in</a> <span
                                            class="dark-transp"> | </span>
                                    <a href=href="{{ route('register') }}"> Register</a></div>
                        </div>
                    </div> <!-- widgets-wrap.// -->
                </div> <!-- col.// -->
                @endguest
            </div> <!-- row.// -->
        </div> <!-- container.// -->
    </section> <!-- header-main .// -->
</header> <!-- section-header.// -->
<main class="py-4">
    <div class="container">
        @yield('content')
    </div>
</main>
</body>
</html>
