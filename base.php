<?  
    define("DB_SERVER", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "express");

    mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно подключиться к серверу");
    mysql_select_db(DB_NAME) or die ("Нет такой таблицы");
?>