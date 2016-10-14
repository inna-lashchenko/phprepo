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

    $sql = ("DELETE FROM test WHERE id=$id");
    $conn->exec($sql);
    $conn->commit();
    echo "<span style='margin-left:20px; color:darkred; font-weight: bold;'>Data deleted! ;)</span><br><br>";


}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}
