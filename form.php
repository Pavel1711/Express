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

    <div class="formInformation w-100">
        <form action="reception.php" method="GET">

            <div class="information">
                <h1>Контактные данные</h1>
                <div style="width:80%">
                    <h2>Имя</h2>
                    <input id="" class="form-control" type="text" name="name" require>
                </div>
                <div style="width:80%">
                    <h2>Фамилия</h2>
                    <input id="" class="form-control" type="text" name="lastname" require>
                </div>
                <div style="width:80%">
                    <h2>Телефон</h2>
                    <input id="" class="form-control phone_mask" type="phone" name="phone" require>
                </div>
                <div style="width:80%">
                    <h2>Адрес</h2>
                    <input id="" class="form-control" type="text" name="address" require>
                    <? $goodsText=$_GET["goodsText"];
                    $inputPrice=$_GET["inputPrice"];
                    for($i=0;$i<count($goodsText);$i++) {
                        $array[$i] = $goodsText[$i];
                    }
                    asort($array);
                    $str = implode(",",$array);
                    echo("<input type=\"text\" name=\"goodsText\" value=\"$str\"style=\"display:none\">");
                    echo("<input type=\"text\" name=\"inputPrice\" value=\"$inputPrice\"style=\"display:none\">");
                    ?>
                </div>
                <div style="width:80%">
                    <button class="btn btn-success" type="submit">Отправить</button>
                </div>
            </div>
        </form>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/jquery.maskedinput.min.js"></script>
    <script src="js/script.js"></script>
    <script>
        $(".phone_mask").mask("+7(999)999-99-99");
    </script>
</body>

</html>