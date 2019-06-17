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
    <div class="fon">
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
                            "<div class=\"col-lg-5 d-flex justify-content-between\">
                            <a href=\"index.php\"><button class=\"btn btn-danger\" type=\"button\">Главная</button></a>
                            <a href=\"profile.php\"><button class=\"btn btn-danger\" id=\"profile\" type=\"button\">Мой профиль</button></a>
                            <a href=\"orders.php\"><button class=\"btn btn-danger\" id=\"myOrders\" type=\"button\">Мои заказы</button></a>
                            <a href=\"exit.php\"><button class=\"btn btn-danger\" id=\"exit\" type=\"button\" name=\"logout\">Выход</button></a>
                            </div>"
                        );   
                    }
                }else{
                    echo("                
                    <div class=\"col-lg-3 d-flex justify-content-between\" id=\"authentication\">
                        <button class=\"btn btn-danger\" id=\"sign\" type=\"button\">Войти</button>
                        <button class=\"btn btn-danger\" id=\"register\" type=\"button\">Зарегистрироваться</button>
                    </div>");
                }
                ?>
                </div>
            </div>
        </header>

        <div class="row d-flex justify-content-center">
            <div class="col-xl-8 order">
                <h1>Мои заказы</h1>
                <div class="order-sort w-100 bg-white">
                    <form action="sortOrder.php" method="POST" class="d-flex justify-content-between align-items-center">
                        <h4> Введите код заказа</h4>
                        <div class="input-group" style="width:75%!important">
                            <input id="numOrder" type="number" class="form-control w-25">
                            <span class="input-group-btn">
                                <button class="btn btn-warning" type="button">Искать</button>
                            </span>
                        </div>
                    </form>
                </div>
                <div id="orderAll" class="mb-5">
                    
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
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/ajax.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>