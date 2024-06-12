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
    $Password = $request['password'];
    $select = $pdo->query("SELECT * FROM user WHERE email='$Email'")->fetch();
    var_dump($select);
    if ($select) {
        if ($select['password'] == $Password) {
            $response['values'] = $select;
            $response['success'] = 'ok';
            setcookie('id_user_login', $select['id_user']);
            setcookie('password', $request['password']);
            setcookie('firstname', $request['firstname']);
            setcookie('lastname', $request['lastname']);
            $id_user = $select['id_user'];
            $sel = $pdo->query("select id_tovar from shopping_cart where shopping_cart.id_user = $id_user")->fetchAll(pdo::FETCH_ASSOC);
            foreach ($sel as $key => $value) {
                $tovars[] = $value['id_tovar'];
            }
            $response['tovars'] = $tovars;

        }
        else {
            $response['success'] = 'fail password';
        }

    }
    else {

        $response['success'] = 'not register';

    }
    $pdo = null;
    ob_end_clean();

    header('Content-Type: application/json');
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}