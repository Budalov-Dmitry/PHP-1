<?php
function getProducts() {
    return getAssocResult(
        "SELECT
            id,
            image
        FROM products
        order by products.id ");
}

function getOneProduct($id) {
    return getAssocResult("SELECT * FROM products where id = '{$id}'");
}


