



$(document).ready(function() {

    function showMessage(message, isValid) {
        if (isValid) {  $('#staticBackdropLabel').text('Успех');
            $('#closeMessage').on('click', function () {
                location.replace('/index.php');
            })
            $('#closeX').on('click', function () {
                location.replace('/index.php');
            })
        }
        else {$('#staticBackdropLabel').text('Ошибка');}

        $('.modal-body').text(message);
        $('#staticBackdrop').modal('show');

    }


    var validEmail = false;
    var validPassword = false;
    var validPhone = false;
    var notNull = false;
    function validateEmail(email) {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }


    function validatePhone(phone) {
        var Valid = false;
        if (phone.length === 11 && /^[0-9]+$/.test(phone)) {
            Valid = true;
        } else if (phone.length === 12 && /^[+]7[0-9]+$/.test(phone)) {
            Valid = true;
        }
        return Valid;
    }

    $('#regForm').keydown(function(e){
        if(e.keyCode == 13) {
            e.preventDefault();
            return false;
        }
    });

    // Обработчик события onSubmit
    $('#regForm').on("submit",function(e) {
        e.preventDefault();
        var firstname = $('#Firstname').val();
        var lastname = $('#Lastname').val();
        var email = $('#Email').val();
        var phone = $('#Phone').val();
        var password = $('#Password').val();
        var repeatPassword = $('#repeatPassword').val();

        console.log('FALSE');
        if (firstname.trim() === '' || lastname.trim() === '' || email.trim() === '' || phone.trim() === '' || password.trim() === '' || repeatPassword.trim() === '') {
            showMessage('Пожалуйста, заполните все поля', notNull);
        }
        else { notNull = true}

        // Проверка введенной почты
        if (!validateEmail(email)) {
            showMessage('Некорректный формат электронной почты', validEmail);

        } else {validEmail = true;}

        // Проверка введенного номера телефона
        if (!validatePhone(phone)) {
            showMessage('Некорректный формат номера телефона ', validPhone);

        } else { validPhone = true;}

        // Проверка совпадения паролей
        if (password !== repeatPassword) {
            showMessage('Пароли не совпадают', validPassword);
        } else {validPassword = true;}

        if (validPassword && validEmail && validPhone && notNull) {

            // $('#regForm').unbind('submit').submit();
            var data = {
                firstname : firstname, lastname: lastname, password: password, email: email, phone: phone
            }
            $.ajax({
                type: 'post',
                url: '/register.php',
                data: data,
                datatype: 'json',
                success: function(response) {

                    if (response["success"]) {

                        for(let i = 0; i < response['tovars'].length; i++) {
                            localStorage.setItem(response['tovars'][i], 'inCart');
                        }
                        console.log(localStorage);
                        showMessage('Пользователь успешно зарегистрирован', true);

                    }
                    else {
                        showMessage('Пользователь с таким Email уже существует', false);

                    }

                },
                error: function(xhr, status, error) {
                    showMessage('Ошибка при отправке данных', false);
                }


            });
        }

    });
});