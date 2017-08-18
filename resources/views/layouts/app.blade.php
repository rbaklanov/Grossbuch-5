<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Компания ГРОССБУХ') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar has-shadow">
            <div class="container">
                <div class="navbar-brand">
                    <a class="navbar-item" href="{{ route('home') }}">
                        <img src="{{ asset('images/devmarketer-logo.png') }}" alt="LOGO">
                    </a>
                </div>
                <div class="navbar-menu">
                    <div class="navbar-start m-l-10">
                        <button class="navbar-item has-dropdown is-hoverable is-tab">
                            <a class="navbar-item">
                                <i class='fa fa-gears m-r-5'></i>
                                Отчеты
                            </a>
                            <div class="navbar-dropdown ">
                                <a class="navbar-item" href={{ url('/users') }}>
                                    <span class="icon">
                                        <i class="fa fa-fw fa-users m-r-10"></i>
                                    </span>
                                    Ежедневные</a>
                                <a class="navbar-item" href="http://bulma.io/documentation/modifiers/syntax/">
                                    <span class="icon">
                                        <i class="fa fa-fw fa-bell m-r-10"></i>
                                    </span>
                                    Сводные
                                </a>
                                <a class="navbar-item" href="http://bulma.io/documentation/columns/basics/">
                                    <span class="icon">
                                        <i class="fa fa-fw fa-cog m-r-10"></i>
                                    </span>
                                    Роли
                                </a>
                                <hr class="dropdown-divider">
                                <a class="navbar-item" href="http://bulma.io/documentation/layout/container/">
                                    <span class="icon">
                                        <i class="fa fa-fw fa-sign-out m-r-10"></i>
                                    </span>
                                    Отделы
                                </a>
                                <a class="navbar-item" href="http://bulma.io/documentation/layout/container/">
                                    <span class="icon">
                                        <i class="fa fa-fw fa-sign-out m-r-10"></i>
                                    </span>
                                    Должности
                                </a>
                                <a class="navbar-item" href="http://bulma.io/documentation/layout/container/">
                                    <span class="icon">
                                        <i class="fa fa-fw fa-sign-out m-r-10"></i>
                                    </span>
                                    Личный кабинет
                                </a>
                                <a class="navbar-item" href="http://bulma.io/documentation/layout/container/">
                                    <span class="icon">
                                        <i class="fa fa-fw fa-sign-out m-r-10"></i>
                                    </span>
                                    О компании
                                </a>
                            </div>
                        </button>
                        <button class="navbar-item has-dropdown is-hoverable is-tab">
                            <a class="navbar-item">
                                 <span class="icon is-small">
                                    <i class='fa fa-gears m-r-10'></i>
                                 </span>
                                Настройки
                            </a>
                            <div class="navbar-dropdown ">
                                <a class="navbar-item" href={{ url('/users') }}>
                                    <span class="icon is-small">
                                        <i class="fa fa-fw fa-users m-r-10"></i>
                                    </span>
                                    Пользователи</a>
                                <a class="navbar-item" href="http://bulma.io/documentation/modifiers/syntax/">
                                    <span class="icon is-small">
                                        <i class="fa fa-fw fa-bell m-r-10"></i>
                                    </span>
                                    Клиенты
                                </a>
                                <a class="navbar-item" href="http://bulma.io/documentation/columns/basics/">
                                    <span class="icon is-small">
                                        <i class="fa fa-fw fa-cog m-r-10"></i>
                                    </span>
                                    Роли
                                </a>
                                <a class="navbar-item" href="http://bulma.io/documentation/layout/container/">
                                    <span class="icon is-small">
                                        <i class="fa fa-fw fa-sign-out m-r-10"></i>
                                    </span>
                                    Отделы
                                </a>
                                <a class="navbar-item" href="http://bulma.io/documentation/layout/container/">
                                    <span class="icon is-small">
                                        <i class="fa fa-fw fa-sign-out m-r-10"></i>
                                    </span>
                                    Должности
                                </a>
                                <hr class="dropdown-divider">
                                <a class="navbar-item" href="http://bulma.io/documentation/layout/container/">
                                    <span class="icon is-small">
                                        <i class="fa fa-fw fa-sign-out m-r-10"></i>
                                    </span>
                                    Личный кабинет
                                </a>
                                <hr class="dropdown-divider">
                                <a class="navbar-item has-dropdown is-hoverable" href="http://bulma.io/documentation/layout/container/">
                                    <span class="icon is-small">
                                        <i class="fa fa-fw fa-sign-out m-r-10"></i>
                                    </span>
                                    О компании
                                </a>
                            </div>
                        </button>
                    </div>
                </div>
                <div class="nav-right nav-menu" style="overflow: visible">
                    @if(Auth::guest())
                        <a href="{{ route('login') }}" class="nav-item is-tab">Login</a>
                        <a href="{{ route('register') }}" class="nav-item is-tab">Register</a>
                    @else
                        <div class="dropdown">
                            {{--<button class="nav-item is-tab dropdown-toggle">--}}
                                {{--<figure class="image is-16x16" style="margin-right: 8px;">--}}
                                    {{--<img src="http://bulma.io/images/jgthms.png">--}}
                                {{--</figure>--}}
                            {{--</button>--}}
                            <button class="dropdown is-aligned-right nav-item is-tab">
                                Hey, {{ Auth::user()->name }} !
                                <ul class="dropdown-menu" style="overflow: visible;">
                                    <li><a href="#">
                                          <span class="icon">
                                            <i class="fa fa-fw fa-user-circle-o m-r-10"></i>
                                          </span>Profile
                                        </a>
                                    </li>
                                    <li><a href="#">
                                          <span class="icon">
                                            <i class="fa fa-fw fa-bell m-r-5"></i>
                                          </span>Notifications
                                        </a>
                                    </li>
                                    <li><a href="#">
                                          <span class="icon">
                                            <i class="fa fa-fw fa-cog m-r-5"></i>
                                          </span>Manage
                                        </a>
                                    </li>
                                    <li class="separator"></li>
                                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                          <span class="icon">
                                            <i class="fa fa-fw fa-sign-out m-r-5"></i>
                                          </span>
                                            Logout
                                        </a>
                                        @include('_includes.forms.logout')
                                    </li>
                                </ul>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </nav>
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
