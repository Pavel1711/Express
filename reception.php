<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>

<body>
    <?php
        $name=$_GET["name"];
        $lastname=$_GET["lastname"];
        $phone=$_GET["phone"];
        $address=$_GET["address"];
        $goodsText=$_GET["goodsText"];
        $totalPrice=$_GET["inputPrice"];
        $raz=explode(",",$goodsText);
        mysql_connect("localhost","root","") or die ("Невозможно подключиться к серверу");
	    mysql_select_db("express") or die ("А нет такой таблицы");
	    $zapros = "INSERT INTO express SET name='".$name."',lastname='".$lastname."',phone='".$phone."',address='".$address."',goods='".$goodsText."',totalPrice='".$totalPrice."'";
        mysql_query($zapros);
    ?>

    <div class="formInformation w-100">
        <div id="success">
            <div class="head">
                <h1>Ваш заказ принят</h1>
                <p>Адрес заказа</p>
                <? echo "<p>".$address."</p>" ?>
            </div>
            <div class="content">
                <?
                    for($i=0;$i<count($raz);$i++){
                        $rows = mysql_query("SELECT goods,price FROM goods WHERE kod=$raz[$i]");
                        while($stroka = mysql_fetch_array($rows)){
                        echo "<div class=\"row\"><div class=\"goods\"><span>".$stroka['goods']."</span></div>";
                        echo "<div class=\"price\"><span>".$stroka['price']."</span><span> руб.</span></div></div>";
                        }
                    }
                    ?>

            </div>
            <div class="itog">
                <div class="itogName">
                    <span>Итого:</span>
                </div>
                <div class="itogPrice">
                    <?echo "<span>".$totalPrice."</span><span> руб.</span>"?>
                </div>
            </div>
        </div>
        <div class="exit">
            <a href="index.html"><button class="btn btn-primary" type="button">Вернуться в главное меню</button></a>
        </div>
    </div>



</body>

</html>