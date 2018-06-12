{include file="view/shared/htmlHeader1.tpl" Title="Agent"}

<link href="../view/agent/css/wAgentTaskList.css" rel="stylesheet">
<link href="../view/shared/css/wHeader.css" rel="stylesheet">
<link href="../view/shared/css/mTaskForm.css" rel="stylesheet">
<link href="../view/shared/css/wNewNoteForm.css" rel="stylesheet">
<link href="../view/shared/css/wTaskInfo.css" rel="stylesheet">
<link href="../view/shared/css/wTaskNote.css" rel="stylesheet">
<link href="../view/shared/css/wTaskState.css" rel="stylesheet">

{include file="view/shared/htmlHeader2.tpl"}

<div class="container">

    {assign var=headerVM value=$agentVM->headerVM}
    {include file="view/shared/wHeader.tpl" ActiveItem="Agent"}

    {assign var=agentTaskListVM value=$agentVM->agentTaskListVM}
    {include file="view/agent/wAgentTaskList.tpl"}

    <div id="modal-content"></div>

</div>

{include file="view/shared/htmlFooter1.tpl"}

<script src="../view/agent/js/wAgentTaskList.js"></script>
<script src="../view/shared/js/wHeader.js"></script>
<script src="../view/shared/js/mTaskForm.js"></script>
<script src="../view/shared/js/wNewNoteForm.js"></script>
<script src="../view/shared/js/wTaskInfo.js"></script>
<script src="../view/shared/js/wTaskNote.js"></script>
<script src="../view/shared/js/wTaskState.js"></script>

{include file="view/shared/htmlFooter2.tpl"}
