<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/reg.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="libs/jquery/jquery-3.7.1.min.js"></script>
    <script src="js/register.js"></script>
</head>
<body>
    <?php include "header_no_login.php"?>
    <main>
        <div class="container">
            <h2>Регистрация</h2>
            <hr>
            <form class="row g-3" id="regForm" name="regForm" action="" method="post">
                <div class="col-md-6">
                    <input type="text" class="form-control"  placeholder="Имя" id="Firstname" name="Firstname">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Фамилия" id="Lastname" name="Lastname">
                </div>
                <div class="col-md-6">
                    <input type="email" class="form-control" id="Email" name="Email" placeholder="Почта">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="Phone" name="Phone" placeholder="Номер телефон">
                </div>
                <div class="col-md-6">
                    <input type="password" class="form-control"  placeholder="Пароль" name="Password" id="Password">
                </div>
                <div class="col-md-6">
                    <input type="password" class="form-control"  placeholder="Повторите пароль" id="repeatPassword">
                </div>
                <div class="col-md-6 ">
                    <button type="submit" class="btn btn-reg-form" id="regButton">Регистрация</button>
                </div>

            </form>
        </div>
    </main>
    <footer>
        <div class="foot-container">
            <p>Copyright &copy; 2024 TECH PLACE - Все права защищены.</p>
        </div>
    </footer>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeX"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeMessage">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>