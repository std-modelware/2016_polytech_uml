<div id="TaskInfo">
    <div class="row vcenter">
        <div class="col-md-9">
            <div class="form-group">
                <label for="tasktitle">Наименование</label>
                <input type="text" class="form-control" id="tasktitle"
                       placeholder="" value="">
            </div>
        </div>
    </div>
    <div class="row vcenter">
        <div class="col-md-9">
            <div class="form-group">
                <label for="taskdescription">Описание</label>
                <textarea class="form-control" id="taskdescription" rows="5"
                          placeholder="" value=""/>
            </div>
        </div>
    </div>
    <div class="row vcenter">
        <div class="col-md-3">
            <div class="form-group">
                <label for="taskdate">Дата окончания</label>
                <input type="date" class="form-control" id="taskdate"
                       placeholder="" value="">
            </div>
        </div>
    </div>

    <div class="row vcenter">
        <div class="col-md-6">
            <div class="form-group">
                <label for="taskagent">Исполнитель</label>
                <select id="taskagent" class="form-control">
                    {foreach $taskInfoVM->accountList as $account}}
                        <option data-id="{$account->id}">{$account->email}</option>
                    {/foreach}
                </select>
            </div>
        </div>
    </div>

    <div class="row vcenter">
        <div class="col-md-3 col-md-offset-3">
            <button id="SaveTaskButton" type="button" data-id="{$taskInfoVM->taskId}" class="btn btn-success btn-block">
                Сохранить
            </button>
        </div>
    </div>
</div>