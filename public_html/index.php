<?php

require_once(__DIR__."/../config/config.php");

$app=new MyApp\Controller\Index();

$app->run();
$app->me();
$app->getValues()->users;
//var_dump($_SESSION["me"]);
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, minimum-scale=1">

    <link rel="stylesheet" href="style.css">

    <title>Home</title>

  </head>
  <body>
<div id="container">
  <form action="logout.php" method="post" id="logout">
    <?= h($app->me()->email); ?>
    <input type="hidden" name="token" value="<?= h($_SESSION["token"]); ?>">
   <input type="submit" value="Log out">
  </form>
  <h1>User(<?= h(count($app->getValues()->users)); ?>)</h1>
  <ul>
    <?php foreach($app->getValues()->users as $user): ?>
      <li><?= h($user->email); ?></li>
    <?php endforeach; ?>
  </ul>

</div>

  </body>
</html>
