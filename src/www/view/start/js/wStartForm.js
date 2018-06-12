$(function () {
    // нажата кнопка Зарегистрироваться
    $("body").on("click", "button#RegisterButton", function (e) {
        console.log("нажата кнопка Зарегистрироваться");

        var email = $("#inputEmail").val();
        var password = $("#inputPassword").val();
        console.log("Email = " + email);
        console.log("Password = " + password);

        Ajax.postJson("action/aRegister.php", {
                data: {
                    email: email,
                    password: password,
                }
            }
        );

        return false;
    });

    // нажата кнопка Войти
    $("body").on("click", "button#EnterButton", function (e) {
        console.log("нажата кнопка Войти");

        var email = $("#inputEmail").val();
        var password = $("#inputPassword").val();
        console.log("Email = " + email);
        console.log("Password = " + password);

        Ajax.postJson("action/aLogin.php", {
                data: {
                    email: email,
                    password: password,
                }
            }
        );

        return false;
    });

});
