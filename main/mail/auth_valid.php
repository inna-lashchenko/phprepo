<?php
if(isset($_POST["singlebutton"])){
    $username = "root";
    $password = "kostyaklushkin23";

    $login = $_POST["login"];
    $pass = $_POST["password"];

    try {
        $conn = new PDO('mysql:host=localhost; dbname=test; charset=utf8', $username, $password );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $stmt = ("SELECT * FROM users WHERE login='$login' && pass='$pass'");
        $result = $conn->query($stmt);

        $result = $result->fetchColumn();
        if($result==false){
            echo "SUCK DICK";
        }
        else
            echo "DON'T SUCK ";

    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
}