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
                        <form class="search" action="goods.php">
                            <input type="text" placeholder="Я ищу..." class="search__input">
                            <div>
                                <input type="submit" id="searchBtn" value="" class="position-absolute">
                                <img src="icons/glass.svg" alt="search" class="position-absolute">
                            </div>
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
            <div class="col-xl-8 mt-4 mb-4">
                <?
                    $kod = $_GET['goodsText'];      
                    $link=mysqli_connect("localhost", "root", "", "express");
                    $sqlGoods = mysqli_query($link, "SELECT *FROM goods where kod=$kod[0]");
                    $data = mysqli_fetch_assoc($sqlGoods);
                    echo("
                        <h2>".$data['title']."</h2>
                        <div class=\"goods w-100 bg-white mt-4 mb-4 row d-flex justify-content-center mt-5 pb-4\">
                            <div class=\"col-xl-4\">
                                <img src=".$data['IMG']." alt=\"goods\" style=\"height:310px\" class=\"mt-4\">
                            </div>
                            <div class=\"col-xl-7 ml-5 h3 mt-4 mb-4 descriptionGoods\">
                                <p class=\"h4 mb-3\">Цена: <span class=\"h2 text-danger\">".$data['price']."</span><span class=\"text-danger\">руб.</span></p>
                                <p class=\"h4 mb-3\">Категория: <span>".$data['kategory']."</span></p>
                                <p class=\"h4 mb-3\">Цвет: <span>".$data['color']."</span></p>
                                <p class=\"h4 mb-3\">Доступно в наличии: <span>".$data['quantity']."</span></p>
                                <p class=\"h4 mb-3\">Описание: <span class=\"h5\">".$data['description']."</span></p>
                            </div>
                        </div>
                    ")
                ?>                
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

    </div>
    <script src="js/jquery.js"></script>
    <script>
        $('#header-search').bind("click", function (e) {
            $('.search__input').val(e.target.innerText);
            $("#header-search").css("display","none");
            $(".search__input").css("border-bottom-style","solid");
        });
        $(".search__input").bind("keyup", function () {
            ajaxSearch();
        });
        function ajaxSearch() {
            $.ajax({
                url: "search.php",
                type: "GET",
                data: ({
                    searchInput: $(".search__input").val()
                }),
                dataType: "html",
                success: function (data) {

                    if(data!=""){
                        $("#header-search").html(data);
                        $(".search__input").css("border-bottom-style","none");
                        $("#header-search").css("display","block");
                    }else{
                        $("#header-search").css("display","none");
                        $(".search__input").css("border-bottom-style","solid");
                    }
                }
            });
        }
    </script>
    <script>
        //  window.location.pathname = window.location.pathname + "/100";
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>