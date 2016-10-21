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
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $kek = 0;


    $name = clean($name);
    $phone = clean($phone);
    $email = clean($email);
    $message = clean($message);
    if (empty($name) && empty($phone) && empty($email) && empty($message)) {
        echo "Fill empty fields";
    }
    else {
        $email_validate = filter_var($email, FILTER_VALIDATE_EMAIL);
        if(!preg_match("/^[а-яА-ЯёЁa-zA-Z]/",$name)){
            echo "Incorrect name";
        }
            elseif (!preg_match("/^[0-9]/", $phone)||check_length($phone,6,15)){
                echo "Incorrect phone";
            }
            elseif (!$email_validate){
                echo "Incorrect email";
            }
            elseif (check_length($message,2,1000)){
                echo "Incorrect message";
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
    $password = "kostyaklushkin23";

    try {
        $conn = new PDO('mysql:host=localhost; dbname=test; charset=utf8', $username, $password );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sql = ("INSERT INTO test (name, email, phone, message) values ('$name', '$email', '$phone', '$message')");
        $conn->exec($sql);
        $conn->commit();

        $stmt = $conn->prepare("SELECT id, name, email, phone, message FROM test");
        $stmt->execute();


        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $values = $stmt->fetchAll();


    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
}



