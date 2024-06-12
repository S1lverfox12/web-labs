<?php
include 'connect.php';
$maintable = json_decode(urldecode($_GET['value1']));
$id_tovar = json_decode(urldecode($_GET['value2']));


[$needColumns, $data] = getInfoTovar($maintable, $id_tovar);
$id_user = $_COOKIE['id_user_login'];
$response = [];
$tovars = [];
$pdo = ConnectToDataBase();

$select = $pdo->query("SELECT id_tovar FROM shopping_cart where shopping_cart.id_user = $id_user and shopping_cart.id_tovar = $id_tovar")->fetch();

if ($select) {$tovars[] = $select[0];}


$str = '<h2>'.$data['title_type_tovar'].' '.$data[$needColumns[0]].'</h2>
            <div class="tovar-content">
                <div class="img-tovar"><img src="data:image/png;base64,'.base64_encode($data['img']).'"></div>
                <div class="tovar-description">
                    <div class="wrapper-tovar-description">
                        <h5>Характеристики</h5>

                        <div class="specifications">
                            <ul class="list-unstyled">';
                            for($i=0; $i < count($needColumns[1]); $i++) {
                                $str .='<li>
                                    <span class="label-spespecification">'.$needColumns[1][$i].'</span>
                                    <span class="value-specification">'.$data[$needColumns[1][$i]].'</span>
                                </li>';
                            }
                       $str .= '</ul>
                        </div>
                    </div>
                </div>
                <div class="price-button">
                    <div class="wrapper-price-button">
                        <h5>'.number_format($data['price'], 0, '', ' ')." ₽".'</h5>
                        <div class="button-container"><button type="button" class="btn btn-use add-to-Cart" data-bs-id="'.$data['id_tovar'].'">Купить</button></div>
                    </div>

                </div>
            </div>';
$pdo = null;


$response['content'] = $str;
$response['tovars'] = $tovars;

ob_end_clean();

header('Content-Type: application/json');
echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>