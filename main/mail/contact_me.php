<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

  <style>
h1{
text-align:center;
}
  th{
    text-align: center;
  }
  .inp{
    margin-left: 20px;
    margin-bottom: 30px;
  }
</style>
  <script>
      $(document).ready(function(){
          $('#formx').on('click', '.js-button', function () {
              var lol = +$("#formx > table > tbody > tr:last-child [name=id]").val()+1;
              $("#formx").find('tbody').append('<tr>'+
                  '<td ><input class="form-control" type="text" name="id" readonly></td>'+
                  '<td ><input class="form-control" type="text" name="name"></td>'+
                  '<td ><input class="form-control" type ="text" name="email"></td>'+
                  '<td ><input class="form-control" type="text" name="phone"></td>'+
                  '<td ><input class="form-control" type="text" name="message"></td>'+
                  '<td><input class="btn btn-success js-but" type="submit" value="Save" name="save"></td>'+
                  '<td><input class="btn btn-warning js-but" type="submit" value="Delete" name="delete"></td>'+
                  '</tr>');
              $("#formx > table > tbody > tr:last-child [name=id]").val(lol);
          })


          $('#formx').on('click', '.js-but', function (e) {

            var msg = $(this).parents('tr').find('input').serialize();
            var str = $(this).val();
            var res="";
            if(str=="Save") {
                res='change.php';
            }
            else {
              res='delete.php';
            }
            $.ajax({
              type: 'POST',
              url: res,
              data: msg,
              success: function(data) {
                $('#results').html(data);
              },
              error:  function(xhr, str){
                alert('Возникла ошибка: ' + xhr.responseCode);
              }
            });
          })
      });
  </script>
</head>
<body>

<?php

$name = $email = $phone = $message = "";
//
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//  if (empty($_POST["name"])) {
//    $nameErr = "Name is required";
//  } else {
//    $name = test_input($_POST["name"]);
//    // check if name only contains letters and whitespace
//    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
//      $nameErr = "Only letters and white space allowed";
//    }
//  }
//
//  if (empty($_POST["email"])) {
//    $emailErr = "Email is required";
//  } else {
//    $email = test_input($_POST["email"]);
//    // check if e-mail address is well-formed
//    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//      $emailErr = "Invalid email format";
//    }
//  }
//
//  if (empty($_POST["phone"])) {
//    $website = "";
//  } else {
//    $phone = test_input($_POST["phone"]);
//    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
//    if(!preg_match("/^[0-9]{10,10}+$/", $phone)) {
//      $phoneErr = "Invalid URL";
//    }
//  }
//
//  if (empty($_POST["message"])) {
//    $message = "";
//  } else {
//    $message = test_input($_POST["message"]);
//  }
//}
//
//function test_input($data) {
//  $data = trim($data);
//  $data = stripslashes($data);
//  $data = htmlspecialchars($data);
//  return $data;
//}
//
//    echo "<div class='inp'><h2>Your Input:</h2>";
//    echo "<b>Your name: </b>". $name;
//    echo "<br>";
//    echo "<b>Your e-mail: </b>". $email;
//    echo "<br>";
//    echo "<b>Your phone: </b>" . $phone;
//    echo "<br>";
//    echo "<b>Your message: </b>" . $message;
//    echo "<br></div>";
   echo "<div id='results'></div>";


$username = "root";
$password = "kostyaklushkin23";

echo "<form method='post' id='formx' action=\"javascript:void(null);\">";

echo "<table class='table'>";

  echo "<tr> <th>ID</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Phone</th>
                <th>Message</th>
                <th></th>
                <th></th>
        </tr>";

try {
    $conn = new PDO('mysql:host=localhost; dbname=test; charset=utf8', $username, $password );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->beginTransaction();

//        $sql = ("INSERT INTO test (name, email, phone, message) values ('$name', '$email', '$phone', '$message')");
//        $conn->exec($sql);
//        $conn->commit();

        $stmt = $conn->prepare("SELECT id, name, email, phone, message FROM test");
        $stmt->execute();


             // set the resulting array to associative
             $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
             $values = $stmt->fetchAll();

//            var_dump($values);die();

             foreach($values as $value) {

                 echo "<tr>";
                 echo "<td ><input class=\"form-control\" type='text' name='id' value='$value[id]' readonly></td>";
                 echo "<td ><input class=\"form-control\" type='text' name='name' value='$value[name]'></td>";
                 echo "<td ><input class=\"form-control\" type ='text' name='email' value='$value[email]'></td>";
                 echo "<td ><input class=\"form-control\" type='text' name='phone' value='$value[phone]'></td>";
                 echo "<td ><input class=\"form-control\" type='text' name='message' value='$value[message]'></td>";
                 echo "<td><input class=\"btn btn-success js-but\" type='submit' value='Save' name='save'></td>";
                 echo "<td><input class=\"btn btn-warning js-but\" type='submit' value='Delete' name='delete'></td>";
                 echo "</tr>";

             }
echo "</table>";
    echo "<input class=\"btn btn-warning js-button center-block\" type='submit' value='Create new record' name='new'>";
    echo "</form>";

    }
    catch(PDOException $e)
     {
        echo "Connection failed: " . $e->getMessage();
     }

?>

</body>
</html>
