<?php

    define('DB_HOST', 'mysql2.000webhost.com');
    define('DB_USER', 'a3338802_user');
    define('DB_PASS', 'otinanai4.');
    define('DB_NAME', 'a3338802_kat');
    

    function db_connect(){
       $connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die('Connection error' .mysqli_connect_error());;
       return $connect;
    }
    

?>
