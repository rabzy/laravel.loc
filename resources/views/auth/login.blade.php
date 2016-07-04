<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Авторизация</title>
    <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/jquery.js') }}" type="text/javascript" charset="utf-8" ></script>
    <script src="{{ asset('/js/bootstrap.js') }}" type="text/javascript" charset="utf-8"></script>
</head>
<body>
    <div class="container">
        <nav class="navbar" role="navigation">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{ url('auth/register') }}">Регистрация</a>
                </li>
            </ul>
        </nav>
        {{--Ошибки--}}
        @if ($errors->has())
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="alert alert-danger" role="alert">
                        <button class="close" aria-label="Close" data-dismiss="alert" type="button">
                            <span aria-hidden="true">×</span>
                        </button>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        {{--Успех--}}
        @if (Session::has('message'))
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="alert alert-success" role="alert">
                        <button class="close" aria-label="Close" data-dismiss="alert" type="button">
                            <span aria-hidden="true">×</span>
                        </button>
                        {{ Session::get('message') }}
                    </div>
                </div>
            </div>
        @endif
        <form role="form" method="post" action="{{ url('auth/login') }}">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Email" name='email'>
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" class="form-control" id="password" placeholder="Пароль" name="password">
            </div>
            <button type="submit" class="btn btn-default">Войти</button>
        </form>
    </div>
</body>
</html>