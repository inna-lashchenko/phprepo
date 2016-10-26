<?php
    if(isset($_COOKIE["user"])  && $_COOKIE["user"]){
        include_once "contact_me.php";
        exit;
    }

    echo file_get_contents('auth.html');