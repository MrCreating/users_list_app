<!DOCTYPE html>
<html lang="ru" class="unselectable">
    <head>
        <title>Авторизация</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
        <meta name="theme-color" content="#42A5F5">
        <meta name="description" content="Test project"/>
        <link href="/manifest.json" rel="manifest">
        <link rel="stylesheet" href="/sources/css/materialize.min.css">
        <link rel="stylesheet" href="/sources/css/theme.default.css">
        <script src="/sources/js/materialize.min.js" type="text/javascript"></script>
        <script src="/sources/js/jquery.min.js" type="text/javascript"></script>
        <script src="/sources/js/module.auth.js" type="text/javascript"></script>
    </head>
    <body style="display: flex">
        <div class="item-center item-halign-wrapper">
            <div style="padding-bottom: 100px">
                <div class="card" style="margin-top: 25px; padding: 20px; min-width: 400px; max-width: 600px">
                    <div class="center login-message" style="padding: 10px;">
                        Добро пожаловать!
                    </div>
                    <form action="/login" method="post" id="auth_form">
                        <div class="input-field">
                            <input id="login" type="text" name="login" class="validate">
                            <label for="login">Логин</label>
                        </div>
                        <div class="input-field">
                            <input id="password" type="password" name="password" class="validate">
                            <label for="password">Пароль</label>
                        </div>
                        <div class="center">
                            <button class="btn blue btn-large waves-effect waves-light" type="submit" name="action">Войти</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>