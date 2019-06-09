<?
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    mysql_connect("localhost","root","") or die ("Невозможно подключиться к серверу");
    mysql_select_db("express") or die ("Нет такой таблицы");
    $auth = mysql_query("SELECT *FROM profile WHERE email='$email'");
    if(mysql_num_rows($auth)==1){
        echo(false);
    }else{
        $auth = mysql_query("INSERT INTO `profile`(`Email`, `Password`, `Name`, `Surname`) VALUES ('$email','$password','$name','$surname')");
        echo(true);
    }
?>