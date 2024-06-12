<?php
include 'connect.php';
$id_user = $_COOKIE['id_user_login'];
$result = getFromShoppingCart($id_user);
$response = [];
$tovars = [];
$arr = [];
foreach ($result as $key => $value) {
    $tovars[] = $key;

    $arr[] ='<div class="item">
        <a href="tovar.php?value1=' . urlencode(json_encode($value['table'])) . '&value2=' . urlencode(json_encode($key)) . '">
            <h5>' . $value['title_type_tovar']. " ". $value['title'] . '</h5>
        </a>

        <div class="button-and-price">
            <span class="price">' . number_format($value['price'], 0, '', ' ') . " ₽" . '</span>
            <a href="#" class="btn-delete-item" data-bs-id="' . $key . '">
                <span class="del-btn-container"><img src="icons/delete.svg"></span>
            </a>

        </div>
    </div>';

}
$response['content'] = $arr;
$response['tovars'] = $tovars;
ob_end_clean();

header('Content-Type: application/json');
echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>