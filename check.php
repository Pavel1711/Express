<?
$link=mysqli_connect("localhost", "root", "", "express");

if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])){
    $query = mysqli_query($link, "SELECT *FROM profile WHERE id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $data = mysqli_fetch_assoc($query);
    echo($_COOKIE['hash']);
    if(($data['hash'] !== $_COOKIE['hash']) or ($data['id'] !== $_COOKIE['id'])){
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/");
        echo("error");
    }else{
        echo("ошибка");
        echo(
            "<div class=\"col-lg-4 d-flex justify-content-between\">
            <button class=\"btn btn-danger\" id=\"profile\" type=\"button\">Мой профиль</button>
            <button class=\"btn btn-danger\" id=\"myOrders\" type=\"button\">Мои заказы</button>
            <a href=\"exit.php\"><button class=\"btn btn-danger\" id=\"exit\" type=\"button\" name=\"logout\">Выход</button></a>
            </div>"
        );   
        header("Location: index.php");exit();
    }
}else{
    echo("                
    <div class=\"col-lg-3 d-flex justify-content-between\" id=\"authentication\">
        <button class=\"btn btn-danger\" id=\"sign\" type=\"button\">Войти</button>
        <button class=\"btn btn-danger\" id=\"register\" type=\"button\">Зарегистрироваться</button>
    </div>");
    header("Location: index.php");exit();
}
?>