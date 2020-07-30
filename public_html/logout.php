<?php

require_once(__DIR__."/../config/config.php");

if($_SERVER["REQUEST_METHOD"]==="POST"){
  if(!isset($_POST["token"])||$_POST["token"]!==$_SESSION["token"]){
      echo "invalid token";
      exit;
  }

  $_SESSION=[];
  if(isset($_COOKIE["session_name()"])){
    setcookie(session_name(),"",time()-86400,"/");
  }
  session_destroy();
}

header("Location:".SITE_URL."/login_php/public_html/login.php");
