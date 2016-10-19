<?php
$username = "root";
$password = "kostyaklushkin23";

$name = $_POST["name"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$message = $_POST["message"];
$id = $_POST["id"];



try {
    $conn = new PDO('mysql:host=localhost; dbname=test; charset=utf8', $username, $password );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->beginTransaction();

    $sql = ("UPDATE test SET name='$name', email='$email', phone='$phone', message='$message' WHERE id=$id");

    $count = $conn->exec($sql);
    if ($count == 0){
        $sql = ("INSERT INTO test (id, name, email, phone, message) values ('$id','$name', '$email', '$phone', '$message')");
        $count = $conn->exec($sql);
    }

    $conn->commit();
    echo "<span style='margin-left: 20px; color:lightseagreen; font-weight: bold;'>Data updated! ;)</span><br><br>";


}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}
