<?php
include "connect.php";

if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
    && !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
    && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    $request = $_POST;
    $response = [];
    $pdo = ConnectToDataBase();
    $tovars = [];
    $Email = $request['email'];
    $select = $pdo->query("SELECT * FROM user WHERE email='$Email'")->fetch(PDO::FETCH_ASSOC);

    if ($select) {
        $response['success'] = false;
    }
    else {
        $sql = 'INSERT INTO user (email, password, phone, first_name, last_name) 
VALUES(:email, :password, :phone, :firstname, :lastname)';
        $response['values'] = $pdo->prepare($sql)->execute($request);
        $sql = "select id_user from user where email = '$Email'";
        $id_user = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC)['id_user'];
        var_dump($id_user);
        setcookie('id_user_login', $id_user);
        setcookie('password', $request['password']);
        setcookie('firstname', $request['firstname']);
        setcookie('lastname', $request['lastname']);
        $response['success'] = true;
        $sel = $pdo->query("select id_tovar from shopping_cart where shopping_cart.id_user = $id_user")->fetchAll(pdo::FETCH_ASSOC);
        foreach ($sel as $key => $value) {
            $tovars[] = $value['id_tovar'];
        }
        $response['tovars'] = $tovars;

    }
    $pdo = null;
    ob_end_clean();

    header('Content-Type: application/json');
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}