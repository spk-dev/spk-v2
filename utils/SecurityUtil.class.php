<?php

class SecurityUtil{
    
    /**
     * Vérifie si une session est chargée
     * @return boolean
     */
    public static function isSessionLoaded(){
        $sessionLoaded = false;
        if(isset($_SESSION['identSession']) && !is_null($_SESSION['identSession']) && $_SESSION['identSession'] != ""){
            $sessionLoaded = true;
        }
        
        return $sessionLoaded;
        
    }
    
    /**
        * Sécurise un paramètre texte
        * @param type $param
        * @return type
        */
       public static function securVarParam($param){
           
           $param = addslashes(trim($param));
           
           return $param;
       }

       /**
        * Sécurise un paramètre numérique
        * @param type $numParam
        * @return type
        */
       public static function securNumParam($numParam){
           return intval($numParam);
       }

       /**
        * Encode le pwd pour ne pas circuler en clair
        * @param type $pwd
        * @return type
        */
       public static function securPwd($pwd){
            define('PREFIX_SALT', 'koob');
            define('SUFFIX_SALT', 'ips');

           $hashSecure = md5(PREFIX_SALT.$pwd.SUFFIX_SALT);
           return $hashSecure;
       
           
       }
       
}
?>
