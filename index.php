<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hello express</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="logo">
                    <img src="logo/logo.svg" alt="logo">
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <form class="search" action="#">
                        <input type="text" placeholder="Я ищу..." class="search__input">
                        <button>
                            <img src="icons/glass.svg" alt="search">
                        </button>
                    </form>
                    <div id="header-search">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="nav" id="cart">
                        <div class="nav__item">
                            <img src="icons/cart.svg" alt="cart">
                            <div class="nav__badge">0</div>
                        </div>
                        <div class="nav__title">Корзина</div>
                    </div>
                </div>
                <?
                $link=mysqli_connect("localhost", "root", "", "express");
                
                if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])){
                    $query = mysqli_query($link, "SELECT *FROM profile WHERE id = '".intval($_COOKIE['id'])."' LIMIT 1");
                    $data = mysqli_fetch_assoc($query);
                    if(($data['hash'] !== $_COOKIE['hash']) or ($data['id'] !== $_COOKIE['id'])){
                        setcookie("id", "", time() - 3600*24*30*12, "/");
                        setcookie("hash", "", time() - 3600*24*30*12, "/");
                        echo("error");
                    }else{
                        echo(
                            "<div class=\"col-lg-4 d-flex justify-content-between\">
                            <a href=\"profile.php\"><button class=\"btn btn-danger\" id=\"profile\" type=\"button\">Мой профиль</button></a>
                            <a href=\"orders.php\"><button class=\"btn btn-danger\" id=\"myOrders\" type=\"button\">Мои заказы</button></a>
                            <a href=\"exit.php\"><button class=\"btn btn-danger\" id=\"exit\" type=\"button\" name=\"logout\">Выход</button></a>
                            </div>"
                        );   
                    }
                }else{
                    echo("                
                    <div class=\"col-lg-3 d-flex justify-content-between\" id=\"authentification\">
                        <button class=\"btn btn-danger\" id=\"sign\" type=\"button\">Войти</button>
                        <button class=\"btn btn-danger\" id=\"register\" type=\"button\">Зарегистрироваться</button>
                    </div>");
                }
                ?>
            </div>
        </div>
    </header>
    <div class="goods row d-flex justify-content-center">
        <div class="col-xl-2 sorting sticky-top">
            <form action="kategory.php" method="GET">
                <h3>Выбор товара</h3>
                <div class="form-group-goods">
                    <p>
                        <input id="goodsOne" class="form-check-input check-goods form-check" type="checkbox" checked>
                        <label for="my-input" class="form-check-label">Смартфоны</label>
                    </p>
                    <p>
                        <input id="goodsTwo" class="form-check-input check-goods form-check" type="checkbox" checked>
                        <label for="my-input" class="form-check-label">Ноутбуки</label>
                    </p>
                    <p>
                        <input id="goodsThree" class="form-check-input check-goods form-check" type="checkbox" checked>
                        <label for="my-input" class="form-check-label">Планшеты</label>
                    </p>
                    <p>
                        <input id="goodsFour" class="form-check-input check-goods form-check" type="checkbox" checked>
                        <label for="my-input" class="form-check-label">Колонки</label>
                    </p>
                </div>
                <h3>Цена</h3>
                <p class="d-flex justify-content-between">
                    От<input id="priceStart" class="form-control form-input" type="text" value="0">
                    До<input id="priceEnd" class="form-control form-input" type="text" value="99999">
                </p>
                <h3>Цвет</h3>
                <div class="form-check-color">
                    <p>
                        <input id="colorBlack" class="form-check-input check-color form-check" type="checkbox" checked>
                        <label for="my-input" class="form-check-label">Черный</label>
                    </p>
                    <p>
                        <input id="colorWhite" class="form-check-input check-color form-check" type="checkbox" checked>
                        <label for="my-input" class="form-check-label">Белый</label>
                    </p>
                    <p>
                        <input id="colorGrey" class="form-check-input check-color form-check" type="checkbox" checked>
                        <label for="my-input" class="form-check-label">Серый</label>
                    </p>
                    <p>
                        <input id="colorBlue" class="form-check-input check-color form-check" type="checkbox" checked>
                        <label for="my-input" class="form-check-label">Синий</label>
                    </p>
                </div>
            </form>
        </div>
        <div class=" col-xl-10">
            <div class="breadcrumbs">
                <span>Сортировать</span>
                <button class="btn btn-sm btn-danger font-weight-bold increase data-toggle=" button"
                    aria-pressed="false" autocomplete="off"" type=" button">по возрастанию</button>
                <button class="btn btn-sm btn-danger font-weight-bold descending data-toggle=" button"
                    aria-pressed="false" autocomplete="off"" type=" button">по убыванию</button>
            </div>
            <div class="goods__wrapper d-flex">
            </div>
        </div>
    </div>
    <form action="formalization.php" method="POST">
        <div class="cart">
            <div class="cart__body">
                <div class="cart__title">Корзина</div>
                <div class="cart__total">Общая сумма: <span>0</span> руб</div>
                <input type="text" class="inputPrice" name="inputPrice" style="display:none">
                <hr>
                <div class="cart__wrapper">
                    <div class="empty">
                        Ваша корзина пока пуста
                    </div>
                </div>
                <button class="cart__confirm" type="submit">Оформить заказ</button>
                <div class="cart__close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </div>
            </div>
        </div>
    </form>

    <div class="auth">

        <div class="auth_block ">
            <div class="logo w-100 d-flex justify-content-center align-items-center pb-2">
                <img src="logo/logo.svg" alt="logo" style="width:150px">
            </div>

            <p class="d-flex justify-content-around"><span>Войти</span> <span>Зарегистрироваться</span></p>
            <div class="d-flex justify-content-center align-items-center flex-column">
                <div id="authForm" class="w-100 justify-content-center align-items-center">
                    <form method="POST" action="auth.php" name="auth_form"
                        class="d-flex justify-content-around align-items-center flex-column" id="auth_form">
                        <input class="form-control" type="text" name="email" placeholder="Введите email или логин"
                            required>
                        <input class="form-control" type="password" name="password" placeholder="Введите пароль"
                            required>
                        <img src="img/eye.png" class="eye">
                        <button class="btn btn-danger w-100" type="submit">Войти</button>
                    </form>
                </div>
                <div id="registerForm" class="w-100 justify-content-center align-items-center">
                    <form method="POST" action="register.php" name="register_form"
                        class="d-flex justify-content-around align-items-center flex-column" id="register_form">
                        <input class="form-control" id="name" type="text" name="name" placeholder="Введите имя"
                            required>
                        <input class="form-control" id="surname" type="text" name="surname"
                            placeholder="Введите фамилию" required>
                        <input class="form-control" type="text" name="email" placeholder="Введите email или логин"
                            required>
                        <input class="form-control" type="password" name="password" placeholder="Введите пароль"
                            required>
                        <img src="img/eye.png" class="eye">
                        <button class="btn btn-danger w-100" type="submit">Зарегистрироваться</button>
                    </form>
                </div>


                <div class="auth__close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </div>
            </div>

        </div>

    </div>

    <div class="row footer bg-white d-flex justify-content-center align-items-center">
        <div class="col-xl-4 h4">
            Контакты: 8-910-367-93-09
        </div>
        <div class="col-xl-4 h4 d-flex justify-content-center align-items-center">
            Мы в:
            <img src="img/vk.png" alt="vk" class="m-2">
            <img src="img/instagram.png" alt="insagram" class="m-2">
            <img src="img/facebook.png" alt="facebook" class="m-2">
        </div>
    </div>

    <div class="confirm">
        <img src="icons/confirm.svg" alt="confirm">
    </div>
    
    <script src="js/jquery.js"></script>
    <script src="js/script.js"></script>
    <script src="js/ajax.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>