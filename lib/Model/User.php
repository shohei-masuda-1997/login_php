<?php
namespace MyApp\Model;

class User extends \MyApp\Model{

  public function create($values){
     $sql="insert into users(email,password,created,midified) values(:email,:password,now(),now())";
     $stmt=$this->db->prepare($sql);
     $stmt->bindValue(":email",$values["email"]);
     $stmt->bindValue(":password",password_hash($values["password"],PASSWORD_DEFAULT));
    // $res=$stmt->execute([":email"=>$values["email"],":password"=>password_hash($values["password"],PASSWORD_DEFAULT)]);
     $res=$stmt->execute();
     if($res===false){
       throw new \MyApp\Exception\DuplicateEmail();
     }
  }

  public function login($values){
     $sql="select* from users where email=:email";
     $stmt=$this->db->prepare($sql);
     $stmt->bindValue(":email",$values["email"]);
     $stmt->execute();
     $stmt->setFetchMode(\PDO::FETCH_CLASS,"stdClass"); //オブジェクト化
     $user=$stmt->fetch();
     if(empty($user)){
       throw new \MyApp\Exception\UnmatchEmailOrPassword();
     }

     if(!password_verify($values["password"],$user->password)){  //password_hashで作ったパスワード($user-password)の検証
       throw new \MyApp\Exception\UnmatchEmailOrPassword();
     }

     return $user;
  }

  public function findAll(){
    $sql="select* from users order by id";
    $stmt=$this->db->query($sql);
    $stmt->setFetchMode(\PDO::FETCH_CLASS,"stdClass");
    return $stmt->fetchAll();
  }
}
