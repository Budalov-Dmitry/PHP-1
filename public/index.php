<?php
session_start();
$session_id = session_id();
include "../config/config.php";


$url_array = explode('/', $_SERVER['REQUEST_URI']);

$action = $url_array[2];

if ($url_array[1] == "") {
    $page = 'index';
} else {
    $page = $url_array[1];
}
          
$params = preparepages($page, $action);
//var_dump($count); //проверка на приход кол-ва товаров в корзине
echo render($page, $params);