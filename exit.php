<?php
if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
    && !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
    && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    setcookie("id_user_login", null);
    setcookie("password", null);
    setcookie("firstname", null);
    setcookie("lastname", null);
}