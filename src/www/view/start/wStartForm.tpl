<div id="StartForm" class="container">

    <form class="form-signin">
        <h2 class="form-signin-heading">Вход</h2>
        <label for="inputLogin" class="sr-only">Логин</label>
        <input type="text" id="inputEmail" class="form-control" placeholder="EMail" required autofocus value="{$startFormVM->email}">
        <label for="inputPassword" class="sr-only">Пароль</label>
        <input type="text" id="inputPassword" class="form-control" placeholder="Пароль" required>
        <hr>
        <div class="clearfix">
            <button id="RegisterButton" class="btn btn-primary pull-left" type="submit">Зарегистрироваться</button>
            <button id="EnterButton" class="btn btn-success pull-right" type="submit">Войти</button>
        </div>
        <hr>
        <h4 class="text-center"><span class="label label-danger">{$startFormVM->message}</span></h4>
    </form>

</div> <!-- /container -->
