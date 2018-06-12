$(function () {
    // нажата кнопка Зарегистрироваться
    $("body").on("click", "button#RegisterButton", function (e) {
        console.log("нажата кнопка Зарегистрироваться");

        var login = $("#inputLogin").val();
        var password = $("#inputPassword").val();
        console.log("Login = " + login);
        console.log("Password = " + password);

        return false;
    });

    // нажата кнопка Войти
    $("body").on("click", "button#EnterButton", function (e) {
        console.log("нажата кнопка Войти");

        var login = $("#inputLogin").val();
        var password = $("#inputPassword").val();
        console.log("Login = " + login);
        console.log("Password = " + password);

        return false;
    });

});
