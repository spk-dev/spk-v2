<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Redirect{
    

public static function toPage($url)
{
   die('<meta http-equiv="refresh" content="0;URL='.$url.'">');
  
}

public static function header($url){
    header('location:'.$url);
}


public static function adminError($errorCode){

    self::toPage($_ENV['properties']['Page']['defaultAdmin']."?page=".$errorCode);
}

public static function frontError($errorCode){

    self::toPage($_ENV['properties']['Page']['defaultSite']."?page=error&code=".$errorCode);
}

public static function getCurrentUrl(){
    return "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
}




}


?>
