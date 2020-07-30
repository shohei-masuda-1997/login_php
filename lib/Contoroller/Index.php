<?php

namespace MyApp\Controller;

class Index extends \MyApp\Controller{

  public function run(){
    if(!$this->isLoggedIn()){
      header("Location:".SITE_URL."/login_php/public_html/login.php");
      exit;
    }

    $userModel=new \MyApp\Model\User();
    $this->setValues("users",$userModel->findAll());
  }


}
