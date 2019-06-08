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
                <div class="col-lg-3 d-flex justify-content-between" id="authentication">
                    <button class="btn btn-danger" id="sign" type="button">Войти</button>
                    <button class="btn btn-danger" id="register" type="button">Зарегистрироваться</button>
                </div>
                <div class="col-lg-2">
                    <button class="btn btn-danger" id="order" type="button">Мои заказы</button>
                </div>
            </div>
        </div>
    </header>
