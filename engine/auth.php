<?php
function getUser()
{
    return $_SESSION['login'];
}

function isAuth() {
    //TODO оптимизируйте if, и учтите что пользователь уже может быть авторизован по сессии
    if (isset($_COOKIE["hash"])) {
        $hash = $_COOKIE["hash"];
        $sql = "SELECT * FROM users WHERE hash='{$hash}'";
        $result = mysqli_query(getDb(), $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $user = $row['login'];
            if (!empty($user)) {
                $_SESSION['login'] = $user;
            }
        }
    }
    return isset($_SESSION['login']);
}

function auth($login, $pass) {
    //$db = getDb();
    $login = mysqli_real_escape_string(getDb(), strip_tags(stripslashes($login)));
    $result = mysqli_query(getDb(), "SELECT * FROM users WHERE login = '{$login}'");
    $row = mysqli_fetch_assoc($result);
    //password_verify()
    if ($pass == $row['password']) {
        $_SESSION['login'] = $login;
        $_SESSION['id'] = $row['id'];
        return true;
    }
    return false;
}

function isAdmin() {
    return $_SESSION['login'] == 'admin';
}