<?php
session_start();
if(isset($_POST)){
    $username = "root";
    $password = "kostyaklushkin23";

    $login = $_POST["login"];
    $pass = $_POST["pass"];

    try {
        $conn = new PDO('mysql:host=localhost; dbname=test; charset=utf8', $username, $password );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $stmt = ("SELECT * FROM registration WHERE display_name='$login' && password='$pass'");
        $result = $conn->query($stmt);

        $result = $result->fetchColumn();
        if($result==false){
            echo "WRONG PASSWORD OR LOGIN";
        }
        else
        {
            echo "OK";
            $_SESSION['facebook_user_name'] = $login;
        }


    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
}
