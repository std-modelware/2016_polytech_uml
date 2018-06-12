$(function () {
    // добавление новой Задачи
    $("body").on("click", "button#NewTaskButton", function (e) {

        console.log("добавление новой Задачи");
        $("#modal-content").load("/view/mNewTaskForm.html", function () {
            $('.modal').modal();
        });
        return false;
    });

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

    // закрыть Задачу
    $("body").on("click", "button[data-action=CloseTaskButton]", function (e) {

        console.log("закрыть Задачу");
        var dataid = $(this).attr("data-id");

        console.log("Задача = " + dataid);

        return false;
    });

    // забрать Задачу
    $("body").on("click", "button[data-action=TakeTaskButton]", function (e) {

        console.log("забрать Задачу");
        var dataid = $(this).attr("data-id");

        console.log("Задача = " + dataid);

        return false;
    });

    // показать Задачу
    $("body").on("click", "a[data-action=ShowTask]", function (e) {

        console.log("показать Задачу (автор)");
        var dataid = $(this).attr("data-id");

        console.log("Задача = " + dataid);

        $("#modal-content").load("/view/mTaskForm.html", function () {
            $('.modal').modal();
        });

        return false;
    });

});
