<?php

include 'connect.php';
$id_user = $_COOKIE['id_user_login'];
$table = $_GET["table"];
[$res, $needColumns] = getListTovarsSameCategory($table);
$response = [];
$tovars = [];
$arr = [];
$pdo = ConnectToDataBase();

$select = $pdo->query("SELECT id_tovar FROM shopping_cart where shopping_cart.id_user = $id_user")->fetchAll(pdo::FETCH_ASSOC);
foreach ($select as $key => $value) {
    $tovars[] = $value['id_tovar'];
}

for($i = 0; $i < count($res); $i++ ) {
    $str = '';

    $str .='<div class="item">
        <div class="img-tovar">
            <a href="tovar.php?value1='.urlencode(json_encode($table)).'&value2='.urlencode(json_encode($res[$i]['id_tovar'])).'"><img src="data:image/png;base64,'.base64_encode($res[$i]['img']).'"></a>
        </div>
        <div class="tovar-description">
            <h4><a href="tovar.php?value1='.urlencode(json_encode($table)).'&value2='.urlencode(json_encode($res[$i]['id_tovar'])).'">'.$res[$i][$needColumns[3]].'</a></h4>
            <ul class="list-unstyled">';
    for($j = 0; $j < 3; $j++) {
        $str .='<li>'.$needColumns[count($needColumns) - 1][$j].': '.$res[$i][$needColumns[count($needColumns) - 1][$j]].'</li>';
    }
    $str .='   </ul>
        </div>
        <div class="price-button">
            <h5>'.number_format($res[$i][$needColumns[count($needColumns) - 2]], 0, '', ' ').' ₽</h5>
            <div class="button-container"><button type="button" class="btn btn-use add-to-Cart" data-bs-id="'.$res[$i]['id_tovar'].'">Купить</button></div>
        </div>
    </div>';
    $arr[] = $str;
}
$pdo = null;
$response['content'] = $arr;
$response['tovars'] = $tovars;
ob_end_clean();

header('Content-Type: application/json');
echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>

