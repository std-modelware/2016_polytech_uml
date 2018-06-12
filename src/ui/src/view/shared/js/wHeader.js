$(function () {
    // открытие страницы Автора
    $("body").on("click", "a[data-action=OpenAuthorPage]", function (e) {

        console.log("открытие страницы Автора");

        return false;
    });

    // открытие страницы Исполнителя
    $("body").on("click", "a[data-action=OpenAgentPage]", function (e) {

        console.log("открытие страницы Исполнителя");

        return false;
    });

    // Выход из системы
    $("body").on("click", "a[data-action=Logout]", function (e) {

        console.log("Выход из системы");

        return false;
    });

});
