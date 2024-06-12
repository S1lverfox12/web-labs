
<?php
include "connect.php";
[$components, $computers] = getItemsForCarousel();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/main.css">
    <script src="libs/jquery/jquery-3.7.1.min.js"></script>
    <?php if (isset($_COOKIE['id_user_login']) && $_COOKIE['id_user_login']) {
        echo '<script src="js/functions.js"></script>';
    } ?>
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

        <div class="carousel-container">
            <h2>Компьютеры</h2>
            <div id="carousel_1" class="carousel slide" data-bs-ride="carousel">
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel_1" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <div class="carousel-inner">
                    <?php  foreach ($computers as $image): ?>
                        <div class="carousel-item active">
                            <div class="row-carousel">
                                <?php foreach ($image as $item): ?>
                                    <div class="col-4">
                                        <img class="img-fluid" src="data:image/png;base64,<?php echo base64_encode($item['img']) ?>" alt="Image 4">
                                    </div>
                                <?php endforeach; break;?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php foreach ($computers as $key => $image): if ($key >= 1) {?>
                        <div class="carousel-item">
                        <div class="row-carousel">
                        <?php foreach ($image as $item): ?>
                            <div class="col-4">
                                <img class="img-fluid" src="data:image/png;base64,<?php echo base64_encode($item['img']) ?>" alt="Image 4">
                            </div>
                        <?php endforeach; }?>
                        </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <button class="carousel-control-next" type="button" data-bs-target="#carousel_1" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="carousel-container">
            <h2>Комплектующие</h2>
            <div id="carousel_2" class="carousel slide" data-bs-ride="carousel">
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel_2" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <div class="carousel-inner">
                    <?php  foreach ($components as $image): ?>
                    <div class="carousel-item active">
                        <div class="row-carousel">
                            <?php foreach ($image as $item): ?>
                            <div class="col-4">
                                <img class="img-fluid" src="data:image/png;base64,<?php echo base64_encode($item['img']) ?>" alt="Image 4">
                            </div>
                            <?php endforeach; break;?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php foreach ($components as $key => $image): if ($key >= 1) {?>
                    <div class="carousel-item">
                        <div class="row-carousel">
                        <?php foreach ($image as $item): ?>
                            <div class="col-4">
                                <img class="img-fluid" src="data:image/png;base64,<?php echo base64_encode($item['img']) ?>" alt="Image 4">
                            </div>
                        <?php endforeach; }?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <button class="carousel-control-next" type="button" data-bs-target="#carousel_2" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
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