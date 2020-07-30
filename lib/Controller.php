<?php

namespace MyApp;

class Controller{
  private $_errors;
  private $_values;

  public function __construct(){
    if(!isset($_SESSION["token"])){
      $_SESSION["token"]=bin2hex(openssl_random_pseudo_bytes(16));  //csrf対策、トークンの生成
    }
    $this->_errors=new \stdClass();  //$this->errorsをオブジェクト化(インスタンス化)
    $this->_values=new \stdClass();  
  }

  protected function setValues($key,$value){
    $this->_values->$key=$value;
  }

  public function getValues(){
    return $this->_values;
  }

  protected function setErrors($key,$error){
    $this->_errors->$key=$error;   //オブジェクト化したのでデータをオブジェクトの形(プロパティ)で管理できる。
  }

  public function getErrors($key){
    return isset($this->_errors->$key)? $this->_errors->$key:"";
  }

  protected function hasError(){
    return !empty(get_object_vars($this->_errors));  //プロパティの取得
  }

  protected function isLoggedIn(){
    //$_SESSION["me"]
    return isset($_SESSION["me"]) && !empty($_SESSION["me"]);
  }

 public function me(){
   return $this->isLoggedIn()?$_SESSION["me"]:null;
 }

}
