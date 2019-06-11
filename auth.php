<?
    function generateCode($length=6) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length) {
                $code .= $chars[mt_rand(0,$clen)];
        }
        return $code;
    }
    $link=mysqli_connect("localhost", "root", "", "express");
    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
        $password = md5(md5(trim($_POST['password'])));
        $query = mysqli_query($link,"SELECT *FROM profile WHERE Email = '".$email."' AND Password = '".$password."'");
        $numrows = mysqli_num_rows($query);
        if($numrows!="0"){
            $data = mysqli_fetch_assoc($query);
            if($data['password'] === md5(md5($_POST['password']))){
                $hash = md5(generateCode(10));
                mysqli_query($link, "UPDATE profile SET hash='".$hash."'WHERE id='".$data['id']."'");
                setcookie("id", $data['id'], time()+60*60*24*30);
                setcookie("hash", $hash, time()+60*60*24*30,null,null,null,true);             
                header("Location: index.php");exit();
            }}else{
                echo("Неверное имя пользователя или пароль!");
            }
    }else{
        echo("Все поля обязательны для заполнения");
    }
?>