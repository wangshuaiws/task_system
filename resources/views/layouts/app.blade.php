<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('customHeader')
    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="http://apps.bdimg.com/libs/fontawesome/4.4.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css')  }}">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
        .navbar-default .navbar-collapse, .navbar-default .navbar-form{
            height: 3em;
        }

        .navbar-form .search-list{
            height: 20em;
            overflow: auto;
            position: absolute;
            z-index: -1;
        }

    </style>
</head>
<body id="app-layout">
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                Laravel
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <!-- <li><a href="{{ route('tasks.index') }}">所有任务</a></li>-->
                <li>{{ link_to_route('tasks.index','所有任务') }}</li>
                <li>{{ link_to_route('tasks.charts','图标统计') }}</li>
                @role('admin')
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="
                        true" aria-expanded="false">用户权限管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>{{ link_to_route('admin.roles.index','角色权限') }}</li>
                        <li>{{ link_to_route('admin.users.index','用户概览') }}</li>
                    </ul>
                </li>
                @endrole
            </ul>

            @if(Auth::user())
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" v-model = "searchString" @focus="fetchTasks" @blur="leave" placeholder="Search">
                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <ul class="list-group search-list" v-if="show">
                        <li class="list-group-item" v-for="task in tasks | searchFor searchString">
                            <a href="/tasks/@{{ task.id }}"><p>  @{{ task.title }} </p></a>
                        </li>
                    </ul>
                </form>
                @endif

                        <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
        </div>
    </div>
</nav>

@yield('content')
<footer class="footer">
    <div class="container">
        当前总共有{{ $total }}个任务,已完成的任务{{ $doneCount }}个,未完成的{{ $toDoCount }}个
    </div>
</footer>



<!-- JavaScripts -->
<script src="{{ asset('js/search.js') }}"></script>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="{{ asset('js/bootstrap.min.js') }}" ></script>
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
@yield('customJS')
</body>
</html>
