<?php
function clean($value) {
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);

    return $value;
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $display_name = $_POST['display_name'];
    $e_mail = $_POST['e-mail'];
    $password = $_POST['password'];

    $first_name = clean($first_name);
    $last_name = clean($last_name);
    $display_name = clean($display_name);
    $e_mail = clean($e_mail);
    $password = clean($password);

    $username = "root";
    $password = "kostyaklushkin23";

    try {
        $conn = new PDO('mysql:host=localhost; dbname=test; charset=utf8', $username, $password );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sql = ("INSERT INTO registration (first_name, last_name, display_name, e_mail, password) values ('$first_name', '$last_name', '$display_name', '$e_mail', '$password')");
        $conn->exec($sql);
        $conn->commit();

    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }

}

