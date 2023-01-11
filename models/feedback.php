<?php
function getAllFeedback() {
    $sql = "SELECT * FROM feedbacks ORDER BY id DESC";
    return getAssocResult($sql);
}

function getOneFeedback($id) {
    return getAssocResult("SELECT * FROM feedbacks where product_id = '{$id}'"); 
}

function addFeedBack() {
        $name = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $_POST['name'])));
        $text = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $_POST['text'])));
        $id =  strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $_GET['id'])));;
        mysqli_query(getDb(),"INSERT INTO feedbacks (name, text,product_id) VALUES ('{$name}','{$text}','{$id}')");
}

function saveFeedBack() {
    $name = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $_POST['name'])));
    $text = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $_POST['text'])));
    $id =  strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $_POST['id'])));
        mysqli_query(getDb(),"UPDATE  feedbacks SET name='{$name}', text='{$text}'WHERE id = {$id}");
}

function deleteFeedBack() { 
    $name = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $_POST['id'])));
    @mysqli_query(getDb(),"DELETE FROM feedbacks WHERE id = {$name};");
}

function editFeedBack() {
    $name = strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $_POST['edit_id'])));
    $request = @mysqli_query(getDb(),"SELECT * FROM feedbacks WHERE id = {$name};");
    if ($request){$array_request = mysqli_fetch_assoc($request);};
    return $array_request;
}

function buyProduct() {
    //var_dump($_POST);
    $id =  strip_tags(htmlspecialchars(mysqli_real_escape_string(getDb(), $_POST['id'])));
    $session_id = session_id();
    $login = $_SESSION['login'];
    if (isAuth()) {
        $request = @mysqli_query(getDb(),"SELECT id FROM users WHERE login = '{$login}'");
        if ($request){$user_id = mysqli_fetch_assoc($request)['id'];};
        mysqli_query(getDb(),"INSERT INTO basket (product_id,user_id,session_id) VALUES ('{$id}','{$user_id}','{$session_id}')");
    } else {
        mysqli_query(getDb(),"INSERT INTO basket (product_id,session_id) VALUES ('{$id}','{$session_id}')");
    }
    
    
}

function doFeebackAction($action) {
    switch($action) {
        case 'add':
            if ($_POST['name'] != '' or $_POST['text'] != '') {addFeedBack();}
            break;  
        case 'edit':
            return editFeedBack();   
        case 'save':
            saveFeedBack();
            break;  
        case 'delete':    
            deleteFeedBack();
            break;  
        case 'buy':    
            buyProduct();
            break;        
    }
    
}
