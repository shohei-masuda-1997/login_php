<?php

namespace MyApp\Controller;

class Login extends \MyApp\Controller{

  public function run(){
    if($this->isLoggedIn()){
      header("Location:".SITE_URL."/login_php/public_html/index.php");
      exit;
    }

    if($_SERVER["REQUEST_METHOD"]==="POST"){
      $this->postProcess();
    }

  }

  protected function postProcess(){
    try{
      $this->_validate();
    }catch(\MyApp\Exception\EmptyPost $e){
      $this->setErrors("login",$e->getMessage());
    }

    $this->setValues("email",$_POST["email"]);

    if($this->hasError()){
      return;
    }else{
      //create user
      try{
        $userModel=new \MyApp\Model\User();
        $user=$userModel->login([
          "email"=>$_POST["email"],
          "password"=>$_POST["password"]
        ]);
      }catch(\MyApp\Exception\UnmatchEmailOrPassword $e){  //メールアドレスの重複
        $this->setErrors("login",$e->getMessage());
        return;
      }
      //session-idを特定されないように防止対策
      session_regenerate_id(true);
      //login処理
      $_SESSION["me"]=$user;
      // redirect to login
      header("Location:".SITE_URL."/login_php/public_html/index.php");

      exit;
    }

  }

  private function _validate(){
    if(!isset($_POST["token"])||$_POST["token"]!==$_SESSION["token"]){
        echo "invalid token";
        exit;
    }

    if(!isset($_POST["email"])||!isset($_POST["password"])){
      echo "invalid Form!";
      exit;
    }

    if($_POST["email"]===""||$_POST["password"]===""){
      throw new \MyApp\Exception\EmptyPost();
    }
  }
}
