<?
    if(!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['password'])){

        if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['email']))
        {
            echo("-1");
        }else if(strlen($_POST['email']) < 3 or strlen($_POST['email']) > 30)
        {
            echo("-2");
        }else{

        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $password = md5(md5(trim($_POST['password'])));
        $link=mysqli_connect("localhost", "root", "", "express");
            mysqli_query($link,"UPDATE profile SET name='".$name."', surname='".$surname."', email='".$email."', password='".$password."' WHERE id='".$_COOKIE['id']."'");
            echo("1");
        }
    }
?>