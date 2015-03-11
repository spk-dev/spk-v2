<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NewsletterAction
 *
 * @author Ben
 */
class NewsletterAction {
  
    /**
     * Desinscription à la newslette
     */
    public static function unsuscribe($key){
        $key = urldecode($key);
        return NewsletterDao::emailOptOut($key);
    }
    
    
    /**
     * Envoi le mail de desinscription
     * @param type $email
     */
            
    public static function sendUnsuscriptionMail($email){
        
        if(NewsletterDao::isEmailOnDatabase($email)){
            
            
            $key = NewsletterDao::getKey($email);
            $from = $_ENV['properties']['Contact']['mail'];
            $subject = "SPIBOOK - Desinscription Newsletter";
            
            
            
            $message = "Pour vous désincrire de la newsletter Spibook, cliquer sur le lien suivant";
            $message .= "<br/>";
            $message .= "<a href='".$_ENV['properties']['Path']['sitePath']."/index.php?".TextStatic::getText("MenuLienNewsletter")."&unsuscript=".urlencode($key)."'>Desinscription</a>";

            UtilMail::envoyerMessage($email, $from, $subject, $message);
            
            
        }else{
            Applog::ecrireLog("Dans NewsletterAction - sendUnsuscriptionMail : l'email [".$email."] n'est pas dans la database", "debug");
        }
        
    }
    
    
    public static function addEmail($nom, $prenom, $email, $optin){
        return NewsletterDao::addEmail($nom, $prenom, $email, $optin);
    }
    
    
    
    
    public static function suscribe($email,$nom,$prenom,$optin){
        
        
        if(NewsletterDao::isEmailOnDataBase($email)){
            
            $resultInscriptionNewsletter = "Cette adresse email est déjà abonnée à la newsletter";
            $newsletterInfoStyle = "alert";
        }else{

            $resultInscriptionNewsletter = "";
            $newsletterInfoStyle = "";



                $status = 1;

                $checkMail = FormValidation::checkField("email", $email, "mail");

                if($checkMail == ""){
                    if(!self::isEmailYetOnMailJet($email,"Newsletter")){
                        $resultInscriptionMailJet = self::addEmailToMailJet($email, "Newsletter");
                      
                    }else{
                        Applog::ecrireLog("Le mail est déjà inscrit chez mailjet dans la liste Newsletter", "debug");
                    }   

                    $tab = self::addEmail($nom,$prenom, $email, $optin, $status);
                    
                     if($tab[0]){
                        $resultInscriptionNewsletter = "Votre inscription à la newsletter Spibook a bien été enregistrée";
                        $newsletterInfoStyle = "success";
                    }else{

                        $resultInscriptionNewsletter = "Une erreur a eu lieu, votre email n'a pas été enregistrée";
                        $newsletterInfoStyle = "alert";
                    }
                }else{
                    $resultInscriptionNewsletter = $checkMail;
                    $newsletterInfoStyle = "alert";
                }
            }

            return array($resultInscriptionNewsletter,$newsletterInfoStyle);
        }
    
        
        
        /**
         * Ajoute l'email dans la liste définie
         * @param str $email
         * @param str $liste
         * @return boolean
         */
        public static function addEmailToMailJet($email,$liste){
            
            $mj = new Mailjet();
            $id = null;
            switch ($liste) {
                case "Administrateur":
                    $id = $mj->listeAdministrateurId;
                    break;
                case "Newsletter";
                    $id = $mj->listeNewsletterId;
                default:
                    break;
            }
            
            $params = array(
                'method' => 'POST',
                'contact' => $email,
                'id' => $id
            );
            # Call
            $response = $mj->listsAddContact($params);
            
            # Result
            if(is_integer($response->contact_id)){
                $boo = true;
            }else{
                $boo = false;
            }
            return $boo;
        }
        
        /**
         * Supprime un mail d'une liste mailJet
         * @param str $email
         * @param str $liste
         * @return boolean
         */
        public static function removeEmailFromMailJet($email,$liste){
            $mj = new Mailjet();
            $id = null;
            switch ($liste) {
                case "Administrateur":
                    $id = $mj->listeAdministrateurId;
                    break;
                case "Newsletter";
                    $id = $mj->listeNewsletterId;
                default:
                    break;
            }
            
            $params = array(
                'method' => 'POST',
                'contact' => $email,
                'id' => $id
            );
            # Call
            $response = $mj->listsRemoveContact($params);

            # Result
            if(!is_null($response->contact_id)){
                $boo = true;
            }else{
                $boo = false;
            }
            return $boo;
        }
    
        /**
         * Vérifie si l'email est déjà enregistré sur Mailjet
         * @param type $email
         * @return type
         */
        public static function isEmailYetOnMailJet($email, $liste = null){
            $boo = false;
            $mj = new Mailjet();
            # Parameters
            $params = array(
                
                'contact' => $email
            );
            # Call
            
            $response = $mj->contactInfos($params);
            
            switch ($liste) {
                case "Administrateur":
                    $id = $mj->listeAdministrateurId;
                    break;
                case "Newsletter";
                    $id = $mj->listeNewsletterId;
                default:
                    break;
            }
            $listarray = array();
            foreach( $response->lists as $valeur){ array_push($listarray, $valeur->list_id); }
            
            if(in_array($id, $listarray)){
                $boo = true;
                Applog::ecrireLog("l'utilisateur est déjà dans la liste newsletter (dans isyetonMailjet", "debug");
            }else{
                
                Applog::ecrireLog("l'utilisateur n'est pas encore dans la liste newsletter (dans isyetonMailjet", "debug");
            }
            return $boo;
            
        }
}

?>
