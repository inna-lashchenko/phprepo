<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>
<form class="form-horizontal" id = "auth" action="auth_valid.php" method="post">
    <fieldset>
    <legend class="text-center">Authorization</legend>

    <div class="form-group">
      <label class="col-md-4 control-label" for="login">Login:</label>
      <div class="col-md-4">
      <input id="login" name="login" type="text" placeholder="Enter login" class="form-control input-md" required>

      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="password">Password:</label>
      <div class="col-md-4">
      <input id="password" name="password" type="password" placeholder="Enter password" class="form-control input-md" required>

      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="singlebutton"></label>
      <div class="col-md-4">
        <button id="singlebutton" name="singlebutton" class="btn btn-primary">OK</button>
      </div>
    </div>

    </fieldset>
</form>
</body>
</html>