<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */

class TextStatic{
    
   
        /**
         * Reduit le texte
         * @param type $text
         * @param type $lien
         * @param type $maxSize
         * @return string
         */ 
        public static function lireLaSuite($text,$lien,$maxSize){
                            
                if(strlen($text)>$maxSize){
                
                    $text = substr($text, 0,$maxSize)." ...";
                    $text .= "<br/><a class='ensavoirplus' href='".$lien."'>En savoir plus</a>";
                }
            
            return $text;
        }
    
    
     /**
         * 
         * @param type $text
         * @param type $lien
         */
        public static function ResumeText($text,$maxSize){
            
                
            if(strlen($text)>$maxSize){
                $text = substr($text, 0,$maxSize)." ...";
            }
            
            
            return $text;
        }
    
    
    public static function replaceQuote($text){
            return str_replace('"', "''", $text);
        }
    
    
        /**
         * Convertit les booleens en texte Oui ou Non
         * @param type $val
         * @return type 
         */
        public static function boolToText($val){
            $textToReturn="";
            if($val==0){
                $textToReturn = self::getText("non");
            }else if($val==1){
                $textToReturn = self::getText("oui");
            }
            
            
            return $textToReturn; 
        }
     
        public static function setHtmlPropre($text){
            $text = addslashes($text);
            return $text;
        }
        
        
        public static function getHtmlPropre($text){
            $text = stripslashes($text);
            return $text;
        }
        
        /**
         * Convertit le texte en Html Propre
         * @param type $text
         * @return type 
         */
        public static function htmlPropre($text){
//            $text = addslashes($text);
            return $text;
        }
    
        
        
        /**
         * 
         */
        public static function getText($key){
            return $_SESSION["language"][$key];
        }
        
        /**
         * Charge les fichiers de langues en SESSION et mets à jour en fonction du choix. 
         */
        public static function defineLanguage(){
        
           // Chargement des texts static dans des tableaux en Session
            $languagesData = LoadConfig::getInstance(); 
            $_SESSION["language_fr"] = $languagesData->getProperties("../lang/fr_lang.ini");

            if(file_exists("../lang/en_lang.ini")){
                $_SESSION["language_en"] = $languagesData->getProperties("../lang/en_lang.ini");
            }        
            if(file_exists("../lang/es_lang.ini")){
                $_SESSION["language_es"] = $languagesData->getProperties("../lang/es_lang.ini");
            }
            
            // S'il n'y a pas de langue par défaut en Session, alors affecter le FR.
            if(!isset($_SESSION['currentLanguage'])){   
                $_SESSION['currentLanguage'] = "fr";
            }
            
            // Si on recoit d'un form la valeur Lang, on change la valeur par défaut.
            if(isset($_POST['lang'])){
                $_SESSION['currentLanguage'] = $_POST['lang'];
            }
            
            // Affectation au tableau Langue le tableau de la langue choisie.
            $_SESSION['language'] = $_SESSION["language_".$_SESSION['currentLanguage']];
       
        }
        
        
       /*********************************
        * 
        */
        public static function reloadLanguage(){
            echo "<script language='javascript'>alert('reload text');</script>";
            $languagesData = LoadConfig::getInstance(); 
             $_SESSION["language_fr"] = $languagesData->getProperties("../lang/fr_lang.ini");
             $_SESSION["language_en"] = $languagesData->getProperties("../lang/en_lang.ini");
             $_SESSION["language_es"] = $languagesData->getProperties("../lang/es_lang.ini");
        }
}
?>
