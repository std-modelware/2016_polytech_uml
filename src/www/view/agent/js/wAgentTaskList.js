$(function () {

    // приостановить Задачу
    $("body").on("click", "button[data-action=PauseTaskButton]", function (e) {

        console.log("приостановить Задачу");
        var dataid = $(this).attr("data-id");

        console.log("Задача = " + dataid);

        return false;
    });

    // продолжить/выполнить Задачу
    $("body").on("click", "button[data-action=PlayTaskButton]", function (e) {

        console.log("продолжить/выполнить Задачу");
        var dataid = $(this).attr("data-id");

        console.log("Задача = " + dataid);

        return false;
    });

    // вернуть Задачу
    $("body").on("click", "button[data-action=ReturnTaskButton]", function (e) {

        console.log("вернуть Задачу");
        var dataid = $(this).attr("data-id");

        console.log("Задача = " + dataid);

        return false;
    });

    // показать Задачу
    $("body").on("click", "a[data-action=ShowTask]", function (e) {

        console.log("показать Задачу (исполнитель)");
        var dataid = $(this).attr("data-id");

        console.log("Задача = " + dataid);

        $("#modal-content").load("/view/mTaskForm.html", function () {
            $('.modal').modal();
        });

        return false;
    });

});
