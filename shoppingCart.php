<?php
include 'connect.php';
$id_user = $_COOKIE['id_user_login'];
$result = getFromShoppingCart($id_user);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/shoppingCart.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="libs/jquery/jquery-3.7.1.min.js"></script>
    <script src="js/functions.js"></script>
    <script src="js/exit.js"></script
</head>
<body>
<?php if (isset($_COOKIE['id_user_login']) && $_COOKIE['id_user_login']) {
    include "header_login.php";
} else {
    include "header_no_login.php";
}
?>
<main>
    <div class="container">
        <h2>Корзина</h2>

        <div class="list-tovars-and-btn-del-all">
            <div>
                <div class="list-tovars">
                    <?php foreach ($result as $key => $value):?>
                        <div class="item">
                            <a href="tovar.php?value1=<?php echo urlencode(json_encode($value['table']))?>&value2=<?php echo urlencode(json_encode($key))?>">
                                <h5><?php echo $value['title_type_tovar']. " ". $value['title']?></h5>
                            </a>

                            <div class="button-and-price">
                                <span class="price"><?php echo number_format($value['price'], 0, '', ' ')." ₽"?></span>
                                <a href="#" class="btn-delete-item" data-bs-id="<?php echo $key?>">
                                    <span class="del-btn-container"><img src="icons/delete.svg"></span>
                                </a>

                            </div>
                        </div>
                    <?php endforeach?>

                </div>

                <button class="btn" type="button" id="delAllTovars">Удалить все</button>

            </div>
        </div>

        <div class="empty">Пусто, попробуйте добавить товары</div>

    </div>

</main>
<footer>
    <div class="foot-container">
        <p>Copyright &copy; 2024 TECH PLACE - Все права защищены.</p>
    </div>
</footer>

</body>
</html>
