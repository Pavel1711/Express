<?
    $search = $_GET['searchInput'];
    if($search!=""){
        mysql_connect("localhost","root","") or die ("Невозможно подключиться к серверу");
        mysql_select_db("express") or die ("Нет такой таблицы");
        $searchRow = mysql_query("SELECT goods FROM goods where goods LIKE '%$search%'");
        while($stroka = mysql_fetch_array($searchRow)){
            echo "<div class=\"header-search\">".$stroka['goods']."</div>";
        }
    }
?>