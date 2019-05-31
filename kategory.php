<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hello express</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
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
                <div class="col-lg-3">
                    <form class="search" action="#">
                        <input type="text" placeholder="Я ищу..." class="search__input">
                        <button>
                            <img src="icons/glass.svg" alt="search">
                        </button>
                    </form>
                </div>
                <div class="col-lg-2">
                    <div class="nav">
                        <div class="nav__item">
                            <img src="icons/like.svg" alt="like">
                        </div>
                        <div class="nav__title">Избранное</div>
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
            </div>
        </div>
    </header>
    <hr>
    <?php
        mysql_connect("localhost","root","") or die ("Невозможно подключиться к серверу");
	    mysql_select_db("express") or die ("А нет такой таблицы");
        $rows = mysql_query("SELECT *FROM goods");
        $kategory = mysql_query("SELECT DISTINCT(kategory) FROM goods where kategory=\"Смартфоны\"");
    ?>
    <div class="container">
        <div class="breadcrumbs">
            <a href="#">Главная</a>
            /
            <?  while($stroka = mysql_fetch_array($kategory)){
                echo "<span>".$stroka['kategory']."</span>";
            }
            ?>
        </div>
    </div>
    <div class="goods">
        <div class="container">
            <div class="goods__wrapper">
                <?
                    while($stroka = mysql_fetch_array($rows)){
                    echo 
                    "<div class=\"goods__item\">
                        <p>100</p>
                        <img class=\"goods__img\" src=".$stroka['IMG'].">
                        <div class=\"goods__quantity\">Доступно в наличии: ".$stroka['quantity']." </div>
                            <div class=\"goods__title\">"
                            .$stroka['description']."
                            </div>
                            <div class=\"goods__price\">
                                <span>".$stroka['price']."</span> руб/шт
                            </div>
                        <input class=\"form-control inputGoods\" type=\"text\" name=\"goodsText[]\">
                        <button class=\"goods__btn\">Добавить в корзину</button>
                    </div>";
                    }
                ?>
            </div>
        </div>
    </div>
    <form action="form.php" method="GET">
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

    <div class="confirm">
        <img src="icons/confirm.svg" alt="confirm">
    </div>
    <script src="js/script.js"></script>
</body>

</html>