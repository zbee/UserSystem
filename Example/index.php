<?php
/*
This file is part of Zbee/UserSystem.

Zbee/UserSystem is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Zbee/UserSystem is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Zbee/UserSystem.  If not, see <http://www.gnu.org/licenses/>.
*/
require_once("../UserSystem/config.php");
$verify = $UserSystem->verifySession();
if ($verify === false) {
  $body = "You are not currently logged in."
  ."<br><br><a href='login' class='btn btn-block btn-default'>Login</a>";
} else {
  $session = $UserSystem->session();
  $body = "You are currently logged in as ".$session["username"].".".
  "<a href='edit' class='btn btn-block btn-default'>Edit</a>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Example website running UserSystem">
  <meta name="author" content="Zbee (Ethan Henderson)">

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
          <?php if (isset($session) && is_array($session)): ?>
          <li><a href="logout">Logout</a></li>
          <?php else: ?>
          <li><a href="login">Login</a></li>
          <li><a href="register">Register</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">

    <div class="col-md-4 col-md-offset-4 text-center">
      <div class="alert alert-info">
        You need to edit the config file in
        <code>/UserSystem/config.php</code>
        <hr>
        If you haven't yet, you also need to run the setup file.
        <br>
        <a href="../UserSystem/setup.php" class="btn btn-block btn-info">
          Setup
        </a>
      </div>

      <div class="well">
        <?=$body?>
      </div>
    </div>
  </div>

  <script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js">
  </script>
</body>
</html>
