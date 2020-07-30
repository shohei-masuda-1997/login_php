<?php

//signup/
require_once(__DIR__."/../config/config.php");
//spl_autoload_register()をconfigで読み込んでいるから、requireしなくてもクラスを読み込める。

$app=new MyApp\Controller\Signup(); //現在がグローバル名前空間なので、MyApp\Controller\SignupはそのままMyApp\Controller\Signup。
$app->run();                        //グローバル空間でない場合は、~\MyApp\Controller\Signupとみなされる。

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, minimum-scale=1">

    <link rel="stylesheet" href="style.css">

    <title>SignUp</title>

  </head>
  <body>
<div id="container">
  <form action="" method="post" id="signup">
    <p>
      <input type="text" name="email" placeholder="email" value="<?=
       isset($app->getValues()->email) ? h($app->getValues()->email) : ''; ?>">
    </p>
    <p class="err">
      <?= h($app->getErrors("email")); ?>
    </p>
    <p>
      <input type="password" name="password" placeholder="password">
    </p>
    <p class="err">
      <?= h($app->getErrors("password")); ?>
    </p>
    <div class="btn" onclick="document.getElementById('signup').submit()">SignUp</div>
    <p>
      <a href="login.php">LogIn</a>
    </p>
    <input type="hidden" name="token" value="<?= h($_SESSION["token"]); ?>">
  </form>
</div>

  </body>
</html>
