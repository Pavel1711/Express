<?
    $link=mysqli_connect("localhost", "root", "", "express");
    $login = mysqli_query($link, "SELECT email FROM profile WHERE id=$_COOKIE[id]");
    $data = mysqli_fetch_assoc($login);
    $email = $data['email'];
 
    $order = mysqli_query($link,"SELECT *FROM orders WHERE email='".$email."'");//Возвращает все заказы пользователя
    $dataOrder = mysqli_fetch_assoc($order);
    $numRowsOrder = mysqli_num_rows($order);

    for($i = 0; $i < $numRowsOrder; $i++){
        $sqlNumOrder = mysqli_query($link,"SELECT *FROM orders WHERE email='".$email."' LIMIT $i,1");
        $dataNumOrder = mysqli_fetch_assoc($sqlNumOrder);

        $str = explode(",",$dataNumOrder['goods']);
        echo(
            "<div class=\"numOrder w-100 bg-white p-3\">
                <div class=\"headline p-3 w-100 d-flex justify-content-between align-content-center\">
                    <div>Заказ №: ".$dataNumOrder['id']."<br>Время заказа: ".$dataNumOrder['time']."</div>
                    <div class=\"moneyOrder\">Стоимость:<br><span>".$dataNumOrder['money']."</span><span> руб.</span></div>
                </div>"
        );
        for($j = 0; $j < count($str); $j++){
            $goods = mysqli_query($link,"SELECT *FROM goods WHERE kod='".$str[$j]."'");//Возвращает значения по товарам
            $dataGoods = mysqli_fetch_assoc($goods);
    
            echo(
            "<div class=\"d-flex justify-content-center goodsOrder row\">
                <img src=".$dataGoods['IMG']." alt=\"\" class=\"col-xl-2\">
                <p class=\"pt-3 col-xl-7\">".$dataGoods['description']."</p>
                <div class=\"priceNumOrder col-xl-2\">".$dataGoods['price']."<span> руб.</span></div>
            </div>"
            );
        }
        echo("</div>");
    }
?>