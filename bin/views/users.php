<?php

use App\Models\Session;
use App\Models\User;

/**
 * @var array<User> $users
 * @var User $user;
 */

?>

<!DOCTYPE html>
<html lang="ru" class="unselectable">
    <head>
        <title>Список пользователей</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
        <meta name="theme-color" content="#42A5F5">
        <meta name="description" content="Test project"/>
        <link href="/manifest.json" rel="manifest">
        <link rel="stylesheet" href="/sources/css/materialize.min.css">
        <link rel="stylesheet" href="/sources/css/theme.default.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,1,0" />
        <script src="/sources/js/materialize.min.js" type="text/javascript"></script>
        <script src="/sources/js/jquery.min.js" type="text/javascript"></script>
        <script src="/sources/js/module.users.js" type="text/javascript"></script>
    </head>
    <body style="display: flex">
        <div id="currentUserId" data-id="<?php echo Session::create()->user_id; ?>" style="display: none"></div>
        <div id="delete_user_agree" class="modal">
            <div class="modal-content">
                <h4>Подтверждение</h4>
                <p>Вы действительно хотите удалить этого пользователя?</p>
            </div>
            <div class="modal-footer">
                <a id="delete_user_ok" class="modal-close waves-effect waves-green btn-flat">Да</a>
                <a class="modal-close waves-effect waves-green btn-flat">Нет</a>
            </div>
        </div>
        <div id="edit_user_form" class="modal">
            <div class="modal-content">
                <p>Редактировать пользователя</p>
                <div class="input-field">
                    <input id="first_name_edit" type="text" name="first_name" class="validate">
                    <label for="first_name_edit">Имя</label>
                </div>
                <div class="input-field">
                    <input id="last_name_edit" type="text" name="last_name" class="validate">
                    <label for="last_name_edit">Фамилия</label>
                </div>
                <div class="input-field">
                    <input id="age_edit" type="number" name="age" class="validate">
                    <label for="age_edit">Возраст</label>
                </div>
                <div class="input-field">
                    <input id="login_edit" type="text" name="login" class="validate">
                    <label for="login_edit">Логин</label>
                </div>
                <div class="input-field">
                    <input id="password_edit" type="password" name="password" class="validate">
                    <label for="password_edit">Пароль</label>
                </div>
            </div>
            <div class="modal-footer">
                <a id="edit_user_ok" class="modal-close waves-effect waves-green btn-flat">Сохранить</a>
                <a class="modal-close waves-effect waves-green btn-flat">Отмена</a>
            </div>
        </div>
        <div style="width: 100%">
            <nav style="width: 100%">
                <div class="nav-wrapper">
                    <ul id="nav-mobile" class="right">
                        <li>Вы - <?php echo htmlspecialchars($user->first_name . ' ' . $user->last_name); ?></li>
                        <li><a class="tooltipped" data-tooltip="Создать пользователя" data-position="left" href="/users/new"><span style="margin-top: 20px" class="material-symbols-outlined">add</span></a></li>
                        <li><a class="tooltipped" data-tooltip="Выйти из аккаунта" data-position="left" href="/users/logout"><span style="margin-top: 20px" class="material-symbols-outlined">logout</span></a></li>
                    </ul>
                </div>
            </nav>
            <div style="padding-bottom: 100px;" class="item-center">
                <div class="card" style="margin-top: 25px; padding: 20px; min-width: 90%; max-width: 100%">
                    <?php if (count($users) <= 0): ?>
                        <div class="center"><b>Пользователей нет. Однако Вы можете создать его с помощью кнопки наверху.</b></div>
                    <?php else: ?>
                        <table class="responsive-table centered highlight">
                            <thead>
                                <tr>
                                    <th>Имя</th>
                                    <th>Фамилия</th>
                                    <th>Возраст</th>
                                    <th>
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($user->first_name); ?></td>
                                        <td><?php echo htmlspecialchars($user->last_name); ?></td>
                                        <td><?php echo htmlspecialchars($user->age); ?></td>
                                        <td>
                                            <a onclick="edit_user(<?php echo $user->user_id; ?>)" style="color: black; cursor: pointer">
                                                <span class="material-symbols-outlined">edit</span>
                                            </a>
                                        </td>
                                        <td>
                                            <?php if ($user->user_id !== Session::create()->user_id): ?>
                                                <a onclick="delete_user(<?php echo $user->user_id; ?>)" style="color: black; cursor: pointer">
                                                    <span class="material-symbols-outlined">delete</span>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </body>
</html>