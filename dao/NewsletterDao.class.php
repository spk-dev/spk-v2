<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class NewsletterDao{
   
    
    /**
      * Recupere la clé de desinscription
      * @param type $email
      * @return type
      */
     public static function getKey($email){
         
         $req = self::selectNewsletterSuscribers($email);
         foreach($req as $data){
             $key = $data[Db::getParam("new","Key")];
         }
        return $key;
     }
    
    /**
     * AJoute l'email à la base
     * @param type $email
     * @return type 
     */
    public static function addEmail($nom, $prenom, $email,$optin){
        if(!self::isEmailOnDatabase($email)){
            $returnValue = self::addNewsletterSuscriber($nom,$prenom, $email,$optin);        
        }else{
            $returnValue = array(false,null);
        }

        return $returnValue;
    }
    
    /**
     * Vérifie si l'adresse en param si l'user est déjà enregistré en base
     * @param type $email
     * @return boolean
     */
   public static function isEmailOnDataBase($email){
       
        $sql = "SELECT * FROM ".Db::get("new",null,null)." WHERE ".Db::get("new","Mail",null)." = '".$email."';";
        $nb = UtilsDao::getInstance()->countResult($sql);

        $result = true;

        if($nb<1){
            $result = false;
        }else{
            $result = true;
        }
        
        return $result;   
   } 
    
    /**
     * Vérifie si l'email passé en parametre existe dans la table newsletter
     * @param type $email
     * @return boolean 
     */
    public static function selectNewsletterSuscribers($email){
        
            $email = SecurityUtil::securVarParam($email);
            $sql = "SELECT * FROM ".Db::get("new",null,null);
            if(!is_null($email)){
                $sql .= "WHERE ".Db::get("new","Mail",null)." = '".$email."';";
            }
            
            return UtilsDao::getInstance()->executeRequete($sql);
       
    }
    
    /**
     * AJoute l'email à la base
     * @param type $email
     * @return type 
     */
    public static function addNewsletterSuscriber($nom, $prenom, $email, $optin){
            
        
            $nom    = SecurityUtil::securVarParam($nom);
            $prenom = SecurityUtil::securVarParam($prenom);
            $email  = SecurityUtil::securVarParam($email);
            $optin  = SecurityUtil::securNumParam($optin);
            $status = 1;
            if($optin != 1){$optin = 0;}
            if($status != 1){$status = 0;}
            $key = crypt(time().$nom.$email);
            
            $sql = "INSERT INTO ".Db::get("new",null,null)." (".Db::get("new","Nom",null).",".Db::get("new","Prenom",null).",".Db::get("new","Mail",null).",".Db::get("new","Status",null).",".Db::get("new","Optin",null).",".Db::get("new","Key",null).",".Db::get("new","DateInscription",null).") VALUES ('".$nom."','".$prenom."','".$email."','".$status."','".$optin."','".$key."', CURDATE());";
            
            
            return UtilsDao::getInstance()->executeInsert($sql);
        
        }
        
     /**
      * Supprime l'email de la base
      * @param type $email
      * @return type 
      */   
     public static function removeNewsletterSuscriber($key){
            $key = SecurityUtil::securVarParam($key);
            $sql="DELETE FROM ".Db::get("new",null,null)." WHERE ".Db::get("new","Key",null)." = '".$key."'";
            return UtilsDao::getInstance()->executeRequete($sql);
         
     }
     
     
     public static function emailOptOut($key){
         
        $sql = "UPDATE ".Db::get("new",null,null)." SET ".Db::get("new","Optin",null)." = 0 WHERE ".Db::get("new","Key",null)." = \"".$key."\";";
        return UtilsDao::getInstance()->executeRequete($sql);
     }
    
}
?>
