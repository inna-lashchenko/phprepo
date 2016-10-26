<?php
if(!isset($_COOKIE["user"])){
  include_once "authorization.php";
  exit;
}
?>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style>
h1{
text-align:center;
}
  th{
    text-align: center;
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
          });


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
        $('#deleteCookie').on('click', '#logOut', function (e) {
          $.ajax({
            type: 'POST',
            url: 'delete_cookie.php',
            success: function(data) {
              location.href='contact_me.php';
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
echo "<form id='deleteCookie' action='action=\"javascript:void(null);\"' method='post'>";
echo "<button type='button' id='logOut' class=\"btn btn-danger js-button pull-right\" style='margin:10px 10px;'>Log out</button></form>";

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

        $stmt = $conn->prepare("SELECT id, name, email, phone, message FROM test");
        $stmt->execute();


             // set the resulting array to associative
             $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
             $values = $stmt->fetchAll();

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
