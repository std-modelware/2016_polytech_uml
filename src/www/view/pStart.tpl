{include file="view/shared/htmlHeader1.tpl" Title="Start"}

<link href="../view/start/css/wStartForm.css" rel="stylesheet">

{include file="view/shared/htmlHeader2.tpl"}



{assign var=startFormVM value=$startVM->startFormVM}
{include file="view/start/wStartForm.tpl"}


{include file="view/shared/htmlFooter1.tpl"}

<script src="../view/start/js/wStartForm.js"></script>

{include file="view/shared/htmlFooter2.tpl"}
