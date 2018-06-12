<div id="AuthorTaskList">
    <div>
        <button id="NewTaskButton" class="btn btn-success">Новая задача</button>
    </div>
    <hr>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Задача</th>
            <th>Дата</th>
            <th>Исполнитель</th>
            <th>Состояние</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        {foreach $authorTaskListVM as $task}
            <tr>
                <td><a href="#" data-id="{$task->taskId}" data-action="ShowTask">{$task->taskTitle}</a></td>
                <td>{$task->taskDate}</td>
                <td>{$task->agentEmail}</td>
                {if $task->taskStateId == 10}
                    <td>ожидание</td>
                    <td>
                        <button class="btn btn-success pull-left" data-action="PlayTaskButton"
                                data-id="{$task->taskId}">Выполнить
                        </button>
                        <button class="btn btn-danger pull-right" data-action="CloseTaskButton"
                                data-id="{$task->taskId}">Закрыть
                        </button>
                    </td>
                {elseif $task->taskStateId == 11}
                    <td>выполняется</td>
                    <td class="clearfix">
                        <button class="btn btn-primary pull-left" data-action="PauseTaskButton"
                                data-id="{$task->taskId}">Приостановить
                        </button>
                        <button class="btn btn-danger pull-right" data-action="CloseTaskButton"
                                data-id="{$task->taskId}">Закрыть
                        </button>
                    </td>
                {elseif $task->taskStateId == 12}
                    <td>закрыта</td>
                    <td></td>
                {elseif $task->taskStateId == 20}
                    <td>ожидание</td>
                    <td class="clearfix">
                        <button class="btn btn-warning pull-right" data-action="TakeTaskButton"
                                data-id="{$task->taskId}">Забрать
                        </button>
                    </td>
                {elseif $task->taskStateId == 21}
                    <td>выполняется</td>
                    <td class="clearfix">
                        <button class="btn btn-warning pull-right" data-action="TakeTaskButton"
                                data-id="{$task->taskId}">Забрать
                        </button>
                    </td>
                {/if}
            </tr>
        {/foreach}
        </tbody>
    </table>
</div>