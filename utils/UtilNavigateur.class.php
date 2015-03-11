<?php

class UtilNavigateur{
    
    
    /**
     * Verifie le navigateur est en renvoi la valeur
     * @return navigateur
     */
    public static function getNavigateur(){
        $navigateur = "";
        
        if (stripos($_SERVER['HTTP_USER_AGENT'],'msie'))
        {
            if (stripos($_SERVER['HTTP_USER_AGENT'],'msie 7'))
            {
                $navigateur = "IE7";
            }elseif (intval(substr($_SERVER['HTTP_USER_AGENT'], stripos($_SERVER['HTTP_USER_AGENT'], "msie")+5)) <= 6) {
                $navigateur = "IE6";
            } else {
                $navigateur = "IE8sup";
            }
        }
        elseif (stripos($_SERVER['HTTP_USER_AGENT'],'chrome')) {
            $navigateur = "CHROME";
        }
        elseif (stripos($_SERVER['HTTP_USER_AGENT'],'firefox'))
        {
            $navigateur = "FIREFOX";
        } 
        
        
        
        return $navigateur;
        
    }
}

?>