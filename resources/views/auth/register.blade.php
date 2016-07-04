<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Регистрация</title>
    <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/jquery.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ asset('/js/bootstrap.js') }}" type="text/javascript" charset="utf-8"></script>
</head>
<body>
<div class="container">
    <nav class="navbar" role="navigation">
        <ul class="nav navbar-nav">
            <li class="active">
                <a href="{{ url('auth/login') }}">Вход</a>
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
    <form role="form" method="post" action="{{ url('auth/register') }}">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Email" name='email'>
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" class="form-control" id="password" placeholder="Пароль" name="password">
        </div>
        <div class="form-group">
            <label for="confirm_password">Повторите пароль</label>
            <input type="password" class="form-control" id="confirm_password" placeholder="Повторите пароль" name="password_confirmation">
        </div>
        <button type="submit" class="btn btn-default">Отправить</button>
    </form>
</div>
</body>
</html>