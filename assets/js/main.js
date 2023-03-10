/*
Авторизация
 */

$('.login-btn').click(function (e) {
    e.preventDefault();
    $(`input`).removeClass('error');
    let login = $('input[name = "login"]').val(),
        password = $('input[name="password"]').val();


    $.ajax({
        url: "vendor/signin.php",
        type: 'POST',
        dataType: 'JSON',
        data: {
            login: login,
            password: password
        },
        success(data) {
            if (data.status) {
                document.location.href = 'profile.php';
            } else {
                if (data.type === 1) {
                    data.fields.forEach(function (field) {
                        $(`input[name="${field}"]`).addClass('error');
                    })
                }
                $('.msg').removeClass('none').text(data.message);
            }
        }

    });
});


// Регистрация
$('.register-btn').click(function (e) {
    e.preventDefault();
    $(`input`).removeClass('error');
    let name = $('input[name="name"]').val(),
        login = $('input[name="login"]').val(),
        email = $('input[name="email"]').val(),
        password = $('input[name="password"]').val(),
        password_confirm = $('input[name="password_confirm"]').val();

    $.ajax({
        url: 'vendor/signup.php',
        type: 'POST',
        dataType: 'json',
        data: {
            name: name,
            login: login,
            email: email,
            password: password,
            password_confirm: password_confirm
        },
        success(data) {
            if (data.status === true) {
                document.location.href = 'index.php';
            } else {
                if (data.type === 1) {
                    data.fields.forEach(function (field) {
                        $(`input[name="${field}"]`).addClass('error');
                    })
                }
                $('.msg').removeClass('none').text(data.message);

            }



        }
    });
});