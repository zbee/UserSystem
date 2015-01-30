<?php
require_once("../UserSystem/config.php");
$verify = $UserSystem->verifySession();
if ($verify === false) {
  $body = "You are not currently logged in."
  ."<br><br><a href='login' class='btn btn-block btn-default'>Login</a>";
} else {
  $session = $UserSystem->session();
  $body = "You are currently logged in as ".$session["username"];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Zbee/UserSystem</title>

  <!-- Bootstrap core CSS -->
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"
    rel="stylesheet">
  <style>body { margin-top: 75px; }</style>

  <!--[if lt IE 9]>
  <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body>

  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed"
          data-toggle="collapse" data-target="#navbar" aria-expanded="false"
          aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../Example">Zbee/UserSystem</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="../Example">Home</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="login">Login</a></li>
          <li><a href="register">Register</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>

  <div class="container">

    <div class="col-md-4 col-md-offset-4 text-center">
      <div class="alert alert-info">
        If you haven't yet, you need to run the setup file.
        <br>
        <a href="../UserSystem/setup.php" class="btn btn-block btn-info">
          Setup
        </a>
        <hr>
        You also need to edit the config file in
        <code>/UserSystem/config.php</code>
      </div>

      <div class="well">
        <br>
        <?=$body?>
      </div>
    </div>

  </div><!-- /.container -->

  <script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js">
  </script>
</body>
</html>