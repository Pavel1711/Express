<?
    $goodsText=$_POST["goodsText"];
    $inputPrice=$_POST["inputPrice"];
    for($i=0;$i<count($goodsText);$i++) {
        $array[$i] = $goodsText[$i];
    }
    asort($array);
    $str = implode(",",$array);

    date_default_timezone_set('UTC+3');
    $today = date("d-m-Y H:i:s"); 

    $link=mysqli_connect("localhost", "root", "", "express");
    $login = mysqli_query($link, "SELECT email FROM profile WHERE id=$_COOKIE[id]");
    $data = mysqli_fetch_assoc($login);
    $email = $data['email'];

    mysqli_query($link, "INSERT INTO orders SET email='".$email."',time='".$today."',goods='".$str."',money='".$inputPrice."'");
    echo("1");
?>