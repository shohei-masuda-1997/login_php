<?php
namespace MyApp;

class Model{
  protected $db;

  public function __construct(){
    try{
      $this->db=new \PDO(DSN,DB_USERNAME,DB_PASSWORD);
      // echo "hello";
    }catch(\PDOException $e){
      echo $e->getMessage();
      exit;
    }
  }
}
