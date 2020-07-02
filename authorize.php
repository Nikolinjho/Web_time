<?php
if (parse_url($_SERVER["HTTP_REFERER"])["host"] !== $_SERVER["SERVER_NAME"])
    die();
?>

<div class="auth">
    <div class="auth__header">
        <a href="">
            <img src="/img/logo.svg" alt="WTIME">
        </a>
    </div>
    <div class="auth-body">
        <div class="auth-body__title">
            Выполните вход <br>в Work ID
        </div>
        <div class="auth-form">
            <form>
                <div class="auth-form__login">
                    <input type="text" name="login" class="user-login" placeholder="Введите ваш Work ID" required>
                </div>
                <div class="auth-form__password">
                    <input type="password" name="password" class="user-password" placeholder="Пароль" required>
                    <div class="toggle-password show-password"></div>
                </div>
                <div class="auth-form__btn">
                    <button class="login-btn" type="button">Войти</button>
                </div>
                <div class="auth-form__forget">
                    Забыли ваш Work ID или пароль?
                    <a href="">Восстановите доступ.</a> 
                </div>
            </form>
        </div>
    </div>
</div>

