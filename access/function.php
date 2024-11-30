<?php
    session_start();
    
    $_SERVER['link'] = mysqli_connect("192.168.199.13", "learn", "learn", "learn_is_64_shmachkov");
    // $_SERVER['link'] = mysqli_connect("151.248.115.10:3306", "root", "Kwuy1mSu4Y", "IS_364_Shmachkov");
        if(!$_SERVER['link']) {
            die("Connection failed: " . mysqli_connect_error());
        }
        echo 'База данных подключена';

?>