<?  
if(!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['password'])){

    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['email']))
    {
        echo("-1");
    }else if(strlen($_POST['email']) < 3 or strlen($_POST['email']) > 30)
    {
        echo("-2");
    }else if(ctype_digit($_POST['email'])) {
        echo ("-3");
    }
    else{
    mysql_connect("localhost","root","") or die ("Невозможно подключиться к серверу");
    mysql_select_db("express") or die ("Нет такой таблицы");

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5(md5(trim($_POST['password'])));

    $auth = mysql_query("SELECT *FROM profile WHERE email='$email'");
        if(mysql_num_rows($auth)==1){
            echo("0");
        }else{
            $auth = mysql_query("INSERT INTO `profile`(`Email`, `Password`, `Name`, `Surname`) VALUES ('$email','$password','$name','$surname')");
            echo("1");
        }
    }
}
?>