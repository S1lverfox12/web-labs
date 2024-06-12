<?php include "connect.php";
$res = getImageToCatalog();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Каталог</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/catalog.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="libs/jquery/jquery-3.7.1.min.js"></script>
    <script src="js/exit.js"></script>
    <?php if (isset($_COOKIE['id_user_login']) && $_COOKIE['id_user_login']) {
        echo '<script src="js/functions.js"></script>';
    } ?>

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
            <div class="listCatalog">
                <?php foreach($res as $table => $img):?>
                <div class="item">
                    <div class="item-container">
                        <div class="img-container">
                            <a href="category.php?table=<?php echo $table; ?>"><img src="data:image/png;base64,<?php echo base64_encode($img) ?>"></a>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
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