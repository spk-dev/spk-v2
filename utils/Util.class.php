<?php

class Util{
    
    public static function getListeAvecVirgule($array){
        $str = "";
        $len = count($array);
        $i = 1;
        foreach ($array as $value) {
            if($value!=""){
                $str .= $value;
                if($i<$len){
                    $str .= ",";
                }
            }
            
            $i++;
        }
        Applog::ecrireLog("DNAS UTIL GETLISTEAVECVIRGULE ".$str, "debug");
        return $str;
    }
    
    public static function getListeAvecVirguleGetId($array){
        $str = "";
        $len = count($array);
        $i = 1;
        foreach ($array as $value) {
            if($value!=""){
//                $str .= $value->getNom()." ".$value->getPrenom();
                $str .= $value->getId().":".$value->getPrenom()." ".$value->getNom();
                if($i<$len){
                    $str .= ",";
                }
            }
            
            $i++;
        }
        Applog::ecrireLog("DNAS UTIL GETLISTEAVECVIRGULEGetID ".$str, "debug");
        return $str;
    }
    
    
    
    public static function getListeAvecVirguleLieuGetId($array){
        Applog::ecrireLog("RENTRE DANS UTIL getListeAvecVirguleLieuGetId ".$array, "debug");
        $str = "";
        $len = count($array);
        $i = 1;
        foreach ($array as $value) {
            if($value!=""){
                $nom = LieuAction::recupererUnLieu($value)->getNom();
                Applog::ecrireLog("DANS UTIL CLASS : nom [".$nom."]", "debug");
//                $str .= $value->getNom()." ".$value->getPrenom();
                $str .= $value.":".$nom;
                if($i<$len){
                    $str .= ",";
                }
            }
            
            $i++;
        }
        Applog::ecrireLog("DNAS UTIL getListeAvecVirguleLieuGetId ".$str, "debug");
        return $str;
    }
}


?>
