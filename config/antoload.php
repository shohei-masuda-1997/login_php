<?php

/*
MyApp
ControllerフォルダのIndex.phpの場合は
MyApp\Controller\Index
->lib/Controller/Index.php
*/
spl_autoload_register(function($class){
    $prefix="MyApp\\";
    if(strpos($class,$prefix)===0){
      $className=substr($class,strlen($prefix)); //『MyApp\』の6文字以降からController\Indexが切り出される
      $classFilePath=__DIR__."/../lib/".str_replace("\\","/",$className).".php";
      if(file_exists($classFilePath)){
        require $classFilePath;
      }
    }
  });
