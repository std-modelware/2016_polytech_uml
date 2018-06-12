<div id="AgentTaskList">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Задача</th>
            <th>Дата</th>
            <th>Состояние</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        {foreach $agentTaskListVM as $task}
            <tr>
                <td><a href="#" data-id="{$task->taskId}" data-action="ShowTask">{$task->taskTitle}</a></td>
                <td>{$task->taskDate}</td>
                {if $task->taskStateId == 20}
                    <td>ожидание</td>
                    <td class="clearfix">
                        <button class="btn btn-success pull-left" data-action="PlayTaskButton" data-id="{$task->taskId}">Выполнить</button>
                        <button class="btn btn-danger pull-right" data-action="ReturnTaskButton" data-id="{$task->taskId}">Вернуть</button>
                    </td>
                {elseif $task->taskStateId == 21}
                    <td>выполняется</td>
                    <td class="clearfix">
                        <button class="btn btn-primary pull-left" data-action="PauseTaskButton" data-id="{$task->taskId}">Приостановить</button>
                        <button class="btn btn-danger pull-right" data-action="ReturnTaskButton" data-id="{$task->taskId}">Вернуть</button>
                    </td>
                {/if}
            </tr>
        {/foreach}

        {*<tr>*}
            {*<td><a href="#" data-id="task10" data-action="ShowTask">Подготовить мастер-класс</a></td>*}
            {*<td>01.12.2016</td>*}
            {*<td>выполняется</td>*}
            {*<td class="clearfix">*}
                {*<button class="btn btn-primary pull-left" data-action="PauseTaskButton" data-id="task10">Приостановить</button>*}
                {*<button class="btn btn-danger pull-right" data-action="ReturnTaskButton" data-id="task10">Вернуть</button>*}
            {*</td>*}
        {*</tr>*}
        {*<tr>*}
            {*<td><a href="#" data-id="task11" data-action="ShowTask">Подготовить мастер-класс</a></td>*}
            {*<td>01.12.2016</td>*}
            {*<td>ожидание</td>*}
            {*<td>*}
                {*<div class="clearfix">*}
                    {*<button class="btn btn-success pull-left" data-action="PlayTaskButton" data-id="task11">Выполнить</button>*}
                    {*<button class="btn btn-danger pull-right" data-action="ReturnTaskButton" data-id="task11">Вернуть</button>*}
                {*</div>*}
            {*</td>*}
        {*</tr>*}
        </tbody>
    </table>
</div>