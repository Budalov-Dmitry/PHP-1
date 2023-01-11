<?php
function getOrders() {
    $login = $_SESSION['login'];
    if (isAdmin()) {
        return getAssocResult(
            "SELECT 
            *
            FROM `orders` 
            ORDER BY id; ");
    };
    if (isAuth()) {
        $request = @mysqli_query(getDb(),"SELECT id FROM users WHERE login = '{$login}'");
        if ($request){$user_id = mysqli_fetch_assoc($request)['id'];};
        return getAssocResult(
            "SELECT 
            *
            FROM `orders`
            where user_id = '{$user_id}'
            ORDER BY id; ");
    }
}