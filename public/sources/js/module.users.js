let userId = 0;

$(document).ready(function () {
    M.AutoInit();
    M.updateTextFields();

    userId = $('#currentUserId').attr('data-id');

    $('body').on('submit', '#create_form', function () {
        let first_name = $('#first_name').val();
        let last_name = $('#last_name').val();
        let age = $('#age').val();
        let login = $('#login').val();
        let password = $('#password').val();

        if (first_name.isEmpty()) {
            M.toast({html: 'Введите Имя'});
            return false;
        }
        if (last_name.isEmpty()) {
            M.toast({html: 'Введите Фамилию'});
            return false;
        }
        if (age.isEmpty()) {
            M.toast({html: 'Введите Возраст'});
            return false;
        }
        if (login.isEmpty()) {
            M.toast({html: 'Введите Логин'});
            return false;
        }
        if (password.isEmpty()) {
            M.toast({html: 'Введите Пароль'});
            return false;
        }

        create_user(first_name, last_name, age, login, password);
        return false;
    });
});

function create_user (first_name, last_name, age, login, password) {
    $.ajax({
        type: 'POST',
        url: '/users/create_new',
        data: {
            first_name: first_name,
            last_name: last_name,
            age: age,
            login: login,
            password: password
        },
        success: function (response) {
            response = JSON.parse(response);

            if (!response.success) {
                return M.toast({html: 'Не удалось выполнить запрос'});
            }

            M.toast({html: 'Пользователь создан. Возвращаемся назад через 2 сек'});
            setTimeout(function () {
                return window.location.href = '/';
            }, 1000);
        },
        error: function () {
            return M.toast({html: 'Не удалось выполнить запрос! Ошибка при ответе с сервера'});
        }
    })
}

function edit_user (user_id, start) {
    if (!start) {
        M.Modal.getInstance(document.getElementById('edit_user_form')).open();

        document.getElementById('edit_user_ok').onclick = function () {
            edit_user(user_id, true);
        }

        $.ajax({
            type: 'POST',
            url: '/users/find_user',
            data: {
                user_id: user_id
            },
            success: function (response) {
                response = JSON.parse(response);

                if (!response.success) {
                    return M.toast({html: 'Не удалось выполнить запрос'});
                }

                let first_name = $('#first_name_edit').val(response.user.first_name);
                let last_name = $('#last_name_edit').val(response.user.last_name);
                let age = $('#age_edit').val(response.user.age);
                let login = $('#login_edit').val(response.user.login);
                let password = $('#password_edit').val(response.user.password);

                M.updateTextFields();
            },
            error: function () {
                return M.toast({html: 'Не удалось выполнить запрос! Ошибка при ответе с сервера'});
            }
        })
    } else {
        let first_name = $('#first_name_edit');
        let last_name = $('#last_name_edit');
        let age = $('#age_edit');
        let login = $('#login_edit');
        let password = $('#password_edit');

        if (first_name.val().isEmpty()) {
            M.toast({html: 'Введите Имя'});
            return false;
        }
        if (last_name.val().isEmpty()) {
            M.toast({html: 'Введите Фамилию'});
            return false;
        }
        if (age.val().isEmpty()) {
            M.toast({html: 'Введите Возраст'});
            return false;
        }
        if (login.val().isEmpty()) {
            M.toast({html: 'Введите Логин'});
            return false;
        }
        if (password.val().isEmpty()) {
            M.toast({html: 'Введите Пароль'});
            return false;
        }

        $.ajax({
            type: 'POST',
            url: '/users/update',
            data: {
                user_id: user_id,
                first_name: first_name.val(),
                last_name: last_name.val(),
                age: age.val(),
                login: login.val(),
                password: password.val()
            },
            success: function (response) {
                response = JSON.parse(response);

                if (!response.success) {
                    return M.toast({html: 'Не удалось выполнить запрос'});
                }

                M.toast({html: 'Пользователь изменён. Возвращаемся назад через 1 сек'});
                setTimeout(function () {
                    return window.location.href = '/';
                }, 1000);
            },
            error: function () {
                return M.toast({html: 'Не удалось выполнить запрос! Ошибка при ответе с сервера'});
            }
        })
    }
}

function delete_user (user_id, start = false) {
    if (Number(userId) === Number(user_id)) {
        return M.toast({html: 'Нельзя удалить самого себя!'});
    }

    if (!start) {
        M.Modal.getInstance(document.getElementById('delete_user_agree')).open();

        document.getElementById('delete_user_ok').onclick = function () {
            delete_user(user_id, true);
        }
    } else {
        $.ajax({
            type: 'POST',
            url: '/users/remove',
            data: {
                user_id: user_id
            },
            success: function (response) {
                response = JSON.parse(response);

                if (!response.success) {
                    return M.toast({html: 'Не удалось выполнить запрос'});
                }

                M.toast({html: 'Пользователь удален. Возвращаемся назад через 1 сек'});
                    setTimeout(function () {
                        return window.location.href = '/';
                    }, 1000);
            },
            error: function () {
                return M.toast({html: 'Не удалось выполнить запрос! Ошибка при ответе с сервера'});
            }
        })
    }
}