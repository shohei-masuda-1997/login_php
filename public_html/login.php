<?php

//login
require_once(__DIR__."/../config/config.php");

$app=new MyApp\Controller\Login();
$app->run();

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, minimum-scale=1">

    <link rel="stylesheet" href="style.css">

    <title>Login</title>

  </head>
  <body>
<div id="container">
  <form action="" method="post" id="login">
    <p>
      <input type="text" name="email" placeholder="email" value="<?=
       isset($app->getValues()->email) ? h($app->getValues()->email) : ''; ?>">
    </p>
    <p>
      <input type="password" name="password" placeholder="password">
    </p>
    <p class="err">
      <?= h($app->getErrors("login")); ?>
    </p>
    <div class="btn" onclick="document.getElementById('login').submit()">LogIn</div>
    <p>
      <a href="signup.php">SignUp</a>
    </p>
      <input type="hidden" name="token" value="<?= h($_SESSION["token"]); ?>">
  </form>
</div>

  </body>
</html>
