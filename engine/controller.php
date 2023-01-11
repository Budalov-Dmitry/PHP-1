<?php

function preparepages($page, $action) {

    $params['layout'] = 'main';
    $params['count'] = getBasketCount();
    $params['auth'] = isAuth();
    $params['admin'] = isAdmin();
    $params['name'] = getUser();

    switch ($page) {
        case 'index':
            $params['title'] = 'Главная';
            break;
            case 'product': 
                $params['array_request'] = doFeebackAction($action);
                $params['feedback'] = getOneFeedback($_GET['id']);
                $params['product'] = getOneProduct($_GET['id']);
                break;  
        case 'login':
            $login = $_POST['login'];
            $pass = $_POST['pass'];
            if (auth($login, $pass)) {
                if (isset($_POST['save'])) {
                    $hash = uniqid(rand(), true);
                    $id = $_SESSION['id'];
                    //TODO завернуть рабоуту с хеш в модель
                    $sql = "UPDATE users SET hash = '{$hash}' WHERE id = {$id}";
                    $result = mysqli_query(getDb(), $sql);
                    setcookie("hash", $hash, time() + 3600, "/");
                }
                header("Location: /");
                die();
            } else {
                die("Не верный логин пароль");
            }
            break;

        case 'logout':
            setcookie("hash", "", time()-1, "/");
            session_regenerate_id();
            session_destroy();
            header("Location: /");
            die();
            break;        
        case 'catalog':
            $params['products'] = getProducts();
            break;   
        case 'basket':
            $session_id = session_id();
            $params['table'] = 'basket';
            if ($action == 'delete') {
                deleteFromBasket($_POST['id'],$params['table'],$session_id);
            }
            if ($action == 'buy') {
                buyFromBasket($_POST['id'],$_POST['image'],$_POST['description'],$_POST['price'],$_POST['firstname'],$_POST['lastname'],$_POST['phone'],$params['table'],$session_id);
                deleteFromBasket($_POST['id'],$params['table'],$session_id);
            }
            $params['products'] = getBasket($session_id);
            $params['summ'] = mysqli_fetch_assoc(getSumm($session_id))['summ'];
           
            break;  
            case 'orders':
                $session_id = session_id();
                $params['table'] = 'orders';
                if ($action == 'delete') {
                    deleteFromBasket($_POST['id'], $params['table'], $session_id,$_POST['basket_id']);
                }
                $params['products'] = getOrders(); 
                break;     
    }
    return $params;
}