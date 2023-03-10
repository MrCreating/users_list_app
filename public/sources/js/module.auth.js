$(document).ready(function () {
    M.AutoInit();
    M.updateTextFields();

    $('body').on('submit', '#auth_form', function () {
        let login = $('#login').val();
        let password = $('#password').val();

        start_auth(login, password);

        return false;
    });
});

function start_auth (login, password) {
    $.ajax({
        type: 'POST',
        url: '/auth/start',
        data: {
            login: login,
            password: password
        },
        success: function (response) {
            console.log(response);
        },
        error: function () {
            return M.toast({html: 'Не удалось войти! Ошибка при ответе с сервера'});
        }
    })
}