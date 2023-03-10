<!DOCTYPE html>
<html lang="ru" class="unselectable">
<head>
    <title>Создание нового пользователя</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <meta name="theme-color" content="#42A5F5">
    <meta name="description" content="Test project"/>
    <link href="/manifest.json" rel="manifest">
    <link rel="stylesheet" href="/sources/css/materialize.min.css">
    <link rel="stylesheet" href="/sources/css/theme.default.css">
    <script src="/sources/js/materialize.min.js" type="text/javascript"></script>
    <script src="/sources/js/jquery.min.js" type="text/javascript"></script>
    <script src="/sources/js/module.users.js" type="text/javascript"></script>
</head>
<body style="display: flex">
<div class="item-center item-halign-wrapper">
    <div style="padding-bottom: 50px">
        <div class="card" style="margin-top: 25px; padding: 20px; min-width: 400px; max-width: 600px">
            <div class="center login-message" style="padding: 10px;">
                Создание нового пользователя
            </div>
            <form action="/users/create_new" method="post" id="create_form">
                <div class="input-field">
                    <input id="first_name" type="text" name="first_name" class="validate">
                    <label for="first_name">Имя</label>
                </div>
                <div class="input-field">
                    <input id="last_name" type="text" name="last_name" class="validate">
                    <label for="last_name">Фамилия</label>
                </div>
                <div class="input-field">
                    <input id="age" type="number" name="age" class="validate">
                    <label for="age">Возраст</label>
                </div>
                <div class="input-field">
                    <input id="login" type="text" name="login" class="validate">
                    <label for="login">Логин</label>
                </div>
                <div class="input-field">
                    <input id="password" type="password" name="password" class="validate">
                    <label for="password">Пароль</label>
                </div>
                <div class="center">
                    <button class="btn blue btn-large waves-effect waves-light" type="submit" name="action">Создать</button>
                </div>
            </form>
            <br>
            <div class="center">
                <a href="/">Назад</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>