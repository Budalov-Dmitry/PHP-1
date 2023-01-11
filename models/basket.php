<?php
function getBasket($session_id) {
    $login = $_SESSION['login'];
    if (isAuth()) {
        $request = @mysqli_query(getDb(),"SELECT id FROM users WHERE login = '{$login}'");
        if ($request){$user_id = mysqli_fetch_assoc($request)['id'];};
        return getAssocResult(
            "SELECT 
            basket.id,
            description,
            price,
            image
            FROM `basket` 
            JOIN products ON `basket`.`product_id` = products.id
            where session_id = '{$session_id}' or user_id = '{$user_id}'
            ORDER BY id; ");
    }
    return getAssocResult(
        "SELECT 
        basket.id,
        description,
        price,
        image
        FROM `basket` 
        JOIN products ON `basket`.`product_id` = products.id
        where session_id = '{$session_id}'
        ORDER BY id; ");
}

function deleteFromBasket($id,$table,$session_id,$basket_id = null) {
    $name = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $id)));
    $basket_id = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $basket_id)));
    $curentSession = session_id();
    if ($session_id == $curentSession or isAuth()) {
        @mysqli_query(getDb(),"DELETE FROM {$table} WHERE id = {$name};");
    header("Location: /{$table}");
    die();
    }
    
}
function buyFromBasket($id,$image,$description,$price,$firstname,$lastname,$phone,$session_id) {
    $name = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $id)));
    $image = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $image)));
    $description = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $description)));
    $price = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $price)));
    $firstname = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $firstname)));
    $lastname = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $lastname)));
    $phone = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $phone)));
    $curentSession = session_id();
    $login = $_SESSION['login'];
    if (isAuth()) {
        $request = @mysqli_query(getDb(),"SELECT id FROM users WHERE login = '{$login}'");
        if ($request){$user_id = mysqli_fetch_assoc($request)['id'];};
        mysqli_query(getDb(),"INSERT INTO 
        orders (description,price,user_id,basket_id,firstname,lastname,phone,image) 
        VALUES ('{$description}','{$price}','{$user_id}','{$name}','{$firstname}','{$lastname}','{$phone}','{$image}')");
    }
    if ($session_id == $curentSession) {
        mysqli_query(getDb(),"INSERT INTO 
        orders (description,price,user_id,basket_id,firstname,lastname,phone,image) 
        VALUES ('{$description}','{$price}','{$session_id}','{$name}','{$firstname}','{$lastname}','{$phone}','{$image}')");
    }
    
}

function getSumm($session_id) {
    return @mysqli_query(getDb(),"SELECT sum(price) as summ  FROM `basket` JOIN products ON `basket`.`product_id` = products.id where session_id = '{$session_id}'");
}

function getBasketCount() {
    $session_id = session_id();
    $login = $_SESSION['login'];
    if (isAuth()) {
        $request = @mysqli_query(getDb(),"SELECT id FROM users WHERE login = '{$login}'");
        if ($request){$user_id = mysqli_fetch_assoc($request)['id'];};
        return mysqli_fetch_assoc(@mysqli_query(getDb(),"SELECT 
        COUNT(basket.id) as `count`  
        FROM `basket` 
        JOIN products ON `basket`.`product_id` = products.id 
        where session_id = '{$session_id}' or user_id = '{$user_id}'"))['count'];
    }
    return mysqli_fetch_assoc(@mysqli_query(getDb(),"SELECT 
        COUNT(basket.id) as `count`  
        FROM `basket` 
        JOIN products ON `basket`.`product_id` = products.id 
        where session_id = '{$session_id}'"))['count'];
}