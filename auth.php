<?  session_start();?>
<?
    include "base.php";

    // if(isset($_SESSION["session_username"])){
    //     header("Location: orders.php");
    // }

    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
        $query = mysql_query("SELECT * FROM profile WHERE Email = '".$email."' AND Password = '".$password."'");
        $numrows = mysql_num_rows($query);
        if($numrows!="0"){
            while($row = mysql_fetch_array($query)){
                $dbusername=$row['email'];
                $dbpassword=$row['password'];
            }
            if($username == $dbusername && $password == $dbpassword){
                $_SESSION['session_username']=$email;
                header("Location: orders.php");
                echo("asd");
            }}else{
                echo("Invalid username or password!");
            }
    }else{
        echo("Все поля обязательны для заполнения");
    }
?>