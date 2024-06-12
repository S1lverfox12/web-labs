<?php

include 'connect.php';
$pdo = connectToDatabase();

if (isset($_GET['action']) && $_GET['action'] = 'getCounterTovars') {
    $id_user = $_COOKIE["id_user_login"];

    $sql = "select count(*) from user join shopping_cart on shopping_cart.id_user = user.id_user 
                where user.id_user = $id_user";
    $cartItemCount = $pdo->query($sql)->fetch()[0];
    $response = [];
    echo json_encode(['cartItemCount' => $cartItemCount]);
}

if (isset($_POST['action']) && $_POST['action'] == 'addToCart') {
    $id_user = $_COOKIE["id_user_login"];
    $id_tovar = $_POST['id_tovar'];
    $sql = "insert into shopping_cart (id_user, id_tovar) values ($id_user, $id_tovar)";
    $pdo->query($sql);
}

if (isset($_POST['action']) && $_POST['action'] == 'delToCart') {
    $id_user = $_COOKIE["id_user_login"];
    $id_tovar = $_POST['id_tovar'];
    $sql = "delete from shopping_cart where id_user = $id_user and id_tovar = $id_tovar";
    $pdo->query($sql);
}

if (isset($_POST['action']) && $_POST['action'] == 'delAllTovars'){
    $id_user = $_COOKIE["id_user_login"];
    $sql = "delete from shopping_cart where id_user = $id_user";
    $pdo->query($sql);
}
$pdo = null;

