<?php

/**
 * COntient les méthodes propres à la gestion des sessions.
 */
class UtilSession{
    
    public static function isAdmin(){
        $value = null;
        if(self::isSessionLoaded()){
            $admin = AdministrateurAction::getAdministrateur(self::getSessionAdminId());
            if($admin->getRole()==2){
                $value = true;
            }else{
                $value = false;
            }
        }
        
        return $value;
    }
    
    public static function isSuperAdmin(){
        $value = null;
        if(self::isSessionLoaded()){
            $admin = AdministrateurAction::getAdministrateur(self::getSessionAdminId());
            if($admin->getRole()==1){
                $value = true;
            }else{
                $value = false;
            }
        }
        
        return $value;
    }
    
    
    
     /**
     * Vérifie si une session est chargée
     * @return boolean
     */
    public static function isSessionLoaded(){
        $sessionLoaded = false;

        if(isset($_SESSION['identSession']) && (!is_null($_SESSION['identSession'])) && ($_SESSION['identSession'] != "")){
            $sessionLoaded = true;
        }

        return $sessionLoaded;
        
    }
    
    /**
     * Renvoi l'ID en session
     * @return string
     */
    public static function getSessionAdminId(){
        $id = "";
        if(self::isSessionLoaded()){
            $id = $_SESSION['identSession'];
        }
        return $id;
    }
    
    /**
     * Tue la session en cours
     * @return boolean
     */
    public static function logoutSession(){
        $booResult = false;
        if(self::isSessionLoaded()){
            $booResult = session_destroy();
        }
        return $booResult;
    }

    /**
     * Efface une variable de la session courante
     * @param type $name
     * @return boolean
     */
    public static function unsetVarSession($name){
        return session_unregister($name);
    }
}


?>
