<?php

namespace MyApp\Controller;

class Signup extends \MyApp\Controller{

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
    //validate
    try{
      $this->_validate();
    }catch(\MyApp\Exception\InvalidEmail $e){
      $this->setErrors("email",$e->getMessage());
      // echo $e->getMessage();
      // exit;
    }catch(\MyApp\Exception\InvalidPassword $e){
      $this->setErrors("password",$e->getMessage());
      // echo $e->getMessage();
      // exit;
    }

    $this->setValues("email",$_POST["email"]); //inputのvalueにセットする用

    if($this->hasError()){
      return;
    }else{
      //create user
      try{
        $userModel=new \MyApp\Model\User();
        $userModel->create([
          "email"=>$_POST["email"],
          "password"=>$_POST["password"]
        ]);
      }catch(\MyApp\Exception\DuplicateEmail $e){  //メールアドレスの重複
        $this->setErrors("email",$e->getMessage());
        return;
      }

      // redirect to login
      header("Location:".SITE_URL."/login_php/public_html/login.php");
      exit;
    }

  }

  private function _validate(){
    if(!isset($_POST["token"])||$_POST["token"]!==$_SESSION["token"]){
        echo "invalid token";
        exit;
    }

    if(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
      throw new \MyApp\Exception\InvalidEmail();
    }

    if(!preg_match("/\A[a-zA-Z0-9]+\z/",$_POST["password"])){
      throw new \MyApp\Exception\InvalidPassword();
    }
  }
}
