$(function () {
    // нажата кнопка Сохранить задачу
    $("body").on("click", "button#SaveTaskButton", function (e) {
        console.log("нажата кнопка Сохранить задачу");

        var taskid = $(this).attr("data-id");
        var tasktitle = $("#tasktitle").val();
        var taskdescription = $("#taskdescription").val();
        var taskdate = $("#taskdate").val();
        var taskagent = $("select#taskagent option:selected").attr("data-id")

        console.log("Task Id = " + taskid);
        console.log("Task Title = " + tasktitle);
        console.log("Task Description = " + taskdescription);
        console.log("Task Date = " + taskdate);
        console.log("Task Agent = " + taskagent);

        if (taskid == 0) {
            Ajax.postJson("action/aCreateTask.php", {
                    data: {
                        tasktitle: tasktitle,
                        taskdescription: taskdescription,
                        taskdate: taskdate,
                        taskagent: taskagent
                    }
                }
            );
            $('.modal').modal('hide');
        }
        return false;
    });

});