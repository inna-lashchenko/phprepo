<?php
function clean($value) {
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);

    return $value;
}
function check_length($value, $min, $max) {
    $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
    return $result;
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $display_name = $_POST['display_name'];
    $e_mail = $_POST['email'];
    $password = $_POST['password'];

    $name = clean($name);
    $display_name = clean($display_name);
    $e_mail = clean($e_mail);
    $password = clean($password);
    $kek = 0;

    if (empty($name) && empty($display_name) && empty($e_mail) && empty($password)) {
        echo 1;
    }
    else {
        $email_validate = filter_var($e_mail, FILTER_VALIDATE_EMAIL);
        if(!preg_match("/^[а-яА-ЯёЁa-zA-Z]/",$name)){
            echo 2;
        }
        elseif (!preg_match("/^[a-zA-Z]/",$display_name)){
            echo 3;
        }
        elseif (!$email_validate){
            echo 4;
        }
        elseif (check_length($password,6,20)){
            echo 5;
        }
        else
        {
            echo "OK";
            $kek = 1;
        }

    }
}

if($kek==1){
    $username = "root";
    $pass = "kostyaklushkin23";

    try {
        $conn = new PDO('mysql:host=localhost; dbname=test; charset=utf8', $username, $pass );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sql = ("INSERT INTO registration (name, display_name, e_mail, password) values ('{$name}', '$display_name', '$e_mail', '$password')");
        $conn->exec($sql);
        $conn->commit();

    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }

}

