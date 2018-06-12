$(function () {
    // добавление комментария
    $("body").on("click", "button#AddNoteButton", function (e) {
        console.log("добавление комментария");

        var tasknote = $("input#tasknote").val();

        console.log("Task Note = " + tasknote);

        return false;
    });

});
