
<?php
include 'connect.php';

$table = $_GET["table"];
[$res, $needColumns] = getListTovarsSameCategory($table);
foreach ($res as $needColumn) {}
?>


<!DOCTYPE html>
<html lang="en ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Категория товара</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/category.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>-->
    <script src="libs/jquery/jquery-3.7.1.min.js"></script>
    <?php if (isset($_COOKIE['id_user_login']) && $_COOKIE['id_user_login']) {
        echo '<script src="js/functions.js"></script>';
    } ?>
    <script src="js/searchFilter.js"></script>
    <script src="js/exit.js"></script>
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
            <h2><?php echo $res[0]['plural_title_type_tovar']?></h2>
            <div class="content-plus-pagingation">
                <div class="filter-and-tovars">
                    <div class="menu-filter">

                            <div class="block-filter">
                                <div class="input-search-line">
                                    <span class="icon" type="button" id="searchButton" name="searchButton"><img src="icons/loupe-search-svgrepo-com%201.svg"></span>
                                    <span class="input-search"><input type="text" class="input-search-line" placeholder="Поиск" id="searchLineTitle"></span>
                                </div>
                            </div>


                    </div>
                    <div class="list-tovars">
                        <?php for($i = 0; $i < count($res); $i++ ):
                            ?>
                        <div class="item">
                            <div class="img-tovar">
                                <a href="tovar.php?value1=<?php echo urlencode(json_encode($table)) ?>&value2=<?php echo urlencode(json_encode($res[$i]['id_tovar'])) ?>"><img src="data:image/png;base64,<?php echo base64_encode($res[$i]['img']) ?>"></a>
                            </div>
                            <div class="tovar-description">

                                <h4><a href="tovar.php?value1=<?php echo urlencode(json_encode($table)) ?>&value2=<?php echo urlencode(json_encode($res[$i]['id_tovar'])) ?>"><?php echo $res[$i][$needColumns[3]]?></a></h4>
                                    <ul class="list-unstyled">
                                        <?php for($j = 0; $j < 3; $j++): ?>
                                        <li><?php echo $needColumns[count($needColumns) - 1][$j]. ": ".$res[$i][$needColumns[count($needColumns) - 1][$j]] ?></li>
                                        <?php endfor; ?>
                                    </ul>

                            </div>
                            <div class="price-button">
                                <h5><?php echo number_format($res[$i][$needColumns[count($needColumns) - 2]], 0, '', ' ')." ₽"?></h5>
                                <div class="button-container"><button type="button" class="btn btn-use add-to-Cart" data-bs-id="<?php echo $res[$i]['id_tovar']?>">Купить</button></div>
                            </div>
                        </div>
                        <?php endfor; ?>
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

</body>
</html>