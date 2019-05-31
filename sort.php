<?php
$priceStart =$_GET['priceStart'];
$priceEnd =$_GET['priceEnd'];
$goodsOne=$_GET['goodsOne'];
$goodsTwo=$_GET['goodsTwo'];
$goodsThree=$_GET['goodsThree'];
$goodsFour=$_GET['goodsFour'];
$colorBlack=$_GET['colorBlack'];
$colorWhite=$_GET['colorWhite'];
$colorGrey=$_GET['colorGrey'];
$colorBlue=$_GET['colorBlue'];
$increase=$_GET['increase'];
$descending=$_GET['descending'];


if($goodsOne=="true"){
    $sqlGoodsOne="";
}else if($goodsOne=="false"){
    $sqlGoodsOne="AND kategory<>\"Смартфоны\"";
}

if($goodsTwo=="true"){
    $sqlGoodsTwo="";
}else if($goodsTwo=="false"){
    $sqlGoodsTwo="AND kategory<>\"Ноутбуки\"";
}

if($goodsThree=="true"){
    $sqlGoodsThree="";
}else if($goodsThree=="false"){
    $sqlGoodsThree="AND kategory<>\"Планшеты\"";
}

if($goodsFour=="true"){
    $sqlGoodsFour="";
}else if($goodsFour=="false"){
    $sqlGoodsFour="AND kategory<>\"Колонки\"";
}

if($colorBlack=="true"){
    $sqlColorBlack="";
}else if($colorBlack=="false"){
    $sqlColorBlack="AND color<>\"Черный\"";
}

if($colorWhite=="true"){
    $sqlColorWhite="";
}else if($colorWhite=="false"){
    $sqlColorWhite="AND color<>\"Белый\"";
}

if($colorGrey=="true"){
    $sqlColorGrey="";
}else if($colorGrey=="false"){
    $sqlColorGrey="AND color<>\"Серый\"";
}

if($colorBlue=="true"){
    $sqlColorBlue="";
}else if($colorBlue=="false"){
    $sqlColorBlue="AND color<>\"Синий\"";
}

    mysql_connect("localhost","root","") or die ("Невозможно подключиться к серверу");
    mysql_select_db("express") or die ("Нет такой таблицы");
    if($increase=="false" && $descending=="false"){
        $rows = mysql_query("SELECT *FROM goods where price>$priceStart AND price<$priceEnd $sqlGoodsOne $sqlGoodsTwo $sqlGoodsThree $sqlGoodsFour $sqlColorBlack $sqlColorWhite $sqlColorGrey $sqlColorBlue");
    }else if($increase=="true"){
        $rows = mysql_query("SELECT *FROM goods where price>$priceStart AND price<$priceEnd $sqlGoodsOne $sqlGoodsTwo $sqlGoodsThree $sqlGoodsFour $sqlColorBlack $sqlColorWhite $sqlColorGrey $sqlColorBlue ORDER BY price ASC");
    }else if($descending=="true"){
        $rows = mysql_query("SELECT *FROM goods where price>$priceStart AND price<$priceEnd $sqlGoodsOne $sqlGoodsTwo $sqlGoodsThree $sqlGoodsFour $sqlColorBlack $sqlColorWhite $sqlColorGrey $sqlColorBlue ORDER BY price DESC");
    }
    while($stroka = mysql_fetch_array($rows)){
        echo 
        "<div class=\"goods__item\">
            <p>".$stroka['kod']."</p>
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