<div id="modal-content">
    <div id="NewTaskForm" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Новая задача</h4>
                </div>
                <div class="modal-body">
                    <div class="container">

                        {assign var=taskInfoVM value=$newTaskFormVM->taskInfoVM}
                        {include file="../../view/shared/wTaskInfo.tpl"}

                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->