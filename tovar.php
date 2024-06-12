<?php
include 'connect.php';
$maintable = json_decode(urldecode($_GET['value1']));
$id_tovar = json_decode(urldecode($_GET['value2']));


[$needColumns, $data] = getInfoTovar($maintable, $id_tovar);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title_type_tovar']." ". $data[$needColumns[0]]?></title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/tovar.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

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
            <h2><?php echo $data['title_type_tovar'] . " " . $data[$needColumns[0]]?></h2>
            <div class="tovar-content">
                <div class="img-tovar"><img src="data:image/png;base64,<?php echo base64_encode($data['img']) ?>"></div>
                <div class="tovar-description">
                    <div class="wrapper-tovar-description">
                        <h5>Характеристики</h5>

                        <div class="specifications">
                            <ul class="list-unstyled">
                                <?php for($i=0; $i < count($needColumns[1]); $i++):?>
                                <li>
                                    <span class="label-spespecification"><?php echo $needColumns[1][$i]?></span>
                                    <span class="value-specification"><?php echo $data[$needColumns[1][$i]]?></span>
                                </li>
                                <?php endfor ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="price-button">
                    <div class="wrapper-price-button">
                        <h5><?php echo number_format($data['price'], 0, '', ' ') ." ₽"?></h5>
                        <div class="button-container"><button type="button" class="btn btn-use add-to-Cart" data-bs-id="<?php echo $data['id_tovar']?>">Купить</button></div>
                    </div>

                </div>
            </div>

        </div>
    </main>
    <footer>
        <div class="foot-container">
            <p>Copyright &copy; 2024 TECH PLACE - Все права защищены.</p>
        </div>
    </footer>
    <script src="libs/jquery/jquery-3.7.1.min.js"></script>
    <?php if (isset($_COOKIE['id_user_login']) && $_COOKIE['id_user_login']) {
        echo '<script src="js/functions.js"></script>';}
    ?>

    <script src="js/exit.js"></script
</body>
</html>
