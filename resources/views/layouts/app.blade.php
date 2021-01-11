<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FINANCE') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/ajax.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/my.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <div class="modal fade" id="modalPeriod" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Задать период отображаемых данных</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <a class="btn btn-success button-period" href="{{route('period.set',['pr'=>'year'])}}" role="button">Сначала года</a><br>
                    <a class="btn btn-success button-period" href="{{route('period.set',['pr'=>'quarter'])}}" role="button">Этот квартал</a><br>
                    <a class="btn btn-success button-period" href="{{route('period.set',['pr'=>'month'])}}" role="button">Этот месяц</a><br>
                    <div class="modal-footer">
                        <form action="{{route('period.range')}}" method="post">
                            @csrf
                            <label>
                                <input type="date" name="begin" value="{{now()->format('Y-m-d')}}">
                            </label>
                            <label>
                                <input type="date" name="end" value="{{now()->format('Y-m-d')}}">
                            </label>
                            <button type="submit" class="btn btn-sm btn-success">Отразить диапазон</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-xl navbar-dark " style="background-color: #409000;">
        <div class="container">
            <a class="navbar-brand" href="{{ route('main') }}">
                <img src="/images/logo.png">
                finance
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse flex-column ml-lg-0 ml-3" id="navbarSupportedContent">
            @auth
                <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @foreach($invoices as $k => $invoice)
                            @if ($k % 10 == 0)
                    </ul>
                    <ul class="navbar-nav mr-auto">
                        @endif
                        <li class="nav-item">
                            <a class="nav-link {{$invoice['id'] == session('invoice') ? 'active' : ''}}"
                               href="{{route('invoice.score', ['id' => $invoice['id']])}}"> {{$invoice['invoice_name']}}</a>
                        </li>
                        @endforeach
                    </ul>

            @endauth
            <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item {{$loginActive ?? ''}}">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item {{$registerActive ?? ''}}">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <button class="nav-link btn btn-outline-success btn-sm" title="период" data-toggle="modal" data-target="#modalPeriod">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-calendar-range" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                    <path d="M9 7a1 1 0 0 1 1-1h5v2h-5a1 1 0 0 1-1-1zM1 9h4a1 1 0 0 1 0 2H1V9z"/>
                                </svg>
                            </button>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Отчеты
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        {{--отчеты регистрированных в таблице для пользователя
                                <a class="dropdown-item" href="#">Сводка</a> --}}
                                <button type="button" class="btn btn-light dropdown-item"
                                        onclick='let incoming=window.open("/summary","","width=1010,height=800,screenX=400,screenY=170,status=no,menubar=no,toolbar=no,scrollbars=yes");return false;'>
                                    Сводка за день
                                </button>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Настройка
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('invoice.show') }}">
                                    {{ __('Редактор счетов') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('art.show',['id' => 0]) }}">
                                    {{ __('Редактор статей') }}
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->FullName }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    {{ __('Профиль') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Выход') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
