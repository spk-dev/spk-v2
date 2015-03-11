<?php

class UtilMail{
    
    private $to;
    private $from;
    private $fromName;
    private $subject;
    private $body;
    private $altBody;
    private $isHtml;
   
    
    
    public function envoyerMessage(){
        $mailStatus = false;
        $mailStatus = $_ENV['properties']['Infos']['mail'];
        
        if($mailStatus){
            Applog::ecrireLog("Mail status true - envoi mail", "debug");
            return $this->envoyerMessageEnabled();
                        
        }else{
            Applog::ecrireLog("Mail status true - envoi mail", "debug");
            return $this->envoyerMessageDisabled();
        }
    }
    

    private function envoyerMessageDisabled(){
         Applog::ecrireLog("to : ".$this->to,"mail");
         Applog::ecrireLog("Sujet : ".$this->subject, "mail");
         Applog::ecrireLog("Msg : ".$this->body, "mail");
         Applog::ecrireLog("MsgText : ".$this->altBody,"mail");
         return true;
     }
    
    /**
    * Envoi de mail
    * @param String $to
    * @param String $subject
    * @param String $message
    * @return boo
    */
    private function envoyerMessageEnabled(){

            Applog::ecrireLog("Rentre dans EnvoyerMessageEnabled", "debug");
        
        // Plusieurs destinataires
            $mj = new Mailjet();


            $mail = new PHPMailer(); // On cr&eacute;e l'instance de la class
            $mail->IsSMTP(); // Indique &agrave; Mailjet qu'on va utiliser le protocol SMTP
            $mail->Host = $mj->host; // Serveur d'envoi de Mailjet
            $mail->ContentType = "text/html"; // Type de contenu de l'e-mail (par d&eacute;faut text/plain)
            $mail->SMTPAuth = true; // forcer l'authentification pour l'envoi d'e-mail
            $mail->SMTPSecure = "tls"; // type de s&eacute;curit&eacute;
            $mail->Port = 587; // port utilis&eacute; pour l'envoi
            $mail->Username = $mj->apiKey;
            $mail->Password = $mj->secretKey;
            $mail->From = $this->from;
            $mail->FromName = $this->fromName; // Nom de l'exp&eacute;diteur qui sera affich&eacute;
            
            $mail->AddAddress($this->to); // destinataire (peut-être multiple)
//            $this->subject = stripslashes($this->subject);
//            $this->subject = str_replace("\n","<br />",$this->subject);
            //utiliser la fonction qui convertit de iso-8859-1 en utf-8
//            $this->subject = utf8_encode($this->subject);
            $mail->Subject = $this->subject;
            
            
            Applog::ecrireLog("Rentre dans EnvoyerMessageEnabled - avant is HTML", "debug");
            
            if($this->isHtml){
                Applog::ecrireLog("Rentre dans EnvoyerMessageEnabled - Dans isHTML", "debug");
                //$body = file_get_contents('page_mail.html');
                $this->body = stripslashes($this->body);
                $this->body = str_replace("\n","<br />",$this->body);
                //utiliser la fonction qui convertit de iso-8859-1 en utf-8
                $this->body = utf8_encode($this->body);
                
                $mail->MsgHTML($this->body);
                $mail->AltBody = $this->altBody;
 
            }else{
                Applog::ecrireLog("Rentre dans EnvoyerMessageEnabled - Dans else html", "debug");
                $mail->Body = $this->body;
            }
            
            
            Applog::ecrireLog("Rentre dans EnvoyerMessageEnabled - AVANT SEND", "debug");
            
            if(!$mail->Send()) {
                Applog::ecrireLog("Dans UtilMail-envoyerMessageEnabled :: erreur dans l'envoi du mail, code erreur : [".$mail->ErrorInfo."]","debug");
                $boo = false;
            } else {
                Applog::ecrireLog("Dans UtilMail-envoyerMessageEnabled :: OK POUR LE MAIL","debug");
                $boo = true;
            } // Test l'envoi de l'e-mail, si tout est bon, redirection sur la page index.php
            
            return $boo;
    }    
    
    
    
   
   /**
    * mail Confirmation Inscription
    * @param Administrateur $admin
    * @param Lieu $lieu
    * @param type $pwd
    * @return type
    */
   public function mailInfoInscriptionWebmaster(Administrateur $admin, $pwd,$success){
       
       
        $date = date('m/d/Y h:i:s a', time());
             
        if($success){
            $this->subject = "Spibook - inf SUCCES inscription";
            $body = "Une inscription a &eacute;t&eacute; r&eacute;alis&eacute;e sur Spibook avec succes. \n ";
        }else{
            $this->subject = "Spibook - info ECHEC inscription";
            $body = "Une inscription sur Spibook a &eacute;chou&eacute;. \n ";
        }
        
        $body .= "Date d'inscription : ".$date."\n";
        $body .= "login : ".$admin->getMail()."\n";
        $body .= "mot de passe : ".$pwd."\n";
        
        
        $this->altBody = null;
        $this->body = $body;
        $this->isHtml = false;
        
        $this->to = "spibook.contact@gmail.com";
        
        $this->from = "contact@spibook.com";
        $this->fromName = "Service inscription - SPIBOOK";
        
        return $this->envoyerMessage();
        
       
   }
   /**
    * mail Confirmation Inscription
    * @param Administrateur $admin
    * @param Lieu $lieu
    * @param type $pwd
    * @return type
    */
   public function mailConfirmationInscription(Administrateur $admin, $pwd){
      
        $date = date('m/d/Y h:i:s a', time());
        
        
        $body = file_get_contents('../mail/headerMail.php');
        
        $body .= "<h3>Inscription prise en compte.</h3>
        <p>Pour vous connecter &agrave; votre zone d'administration, cliquez ici:</p>
        <p><a href='".$_ENV['properties']['Path']['sitePath']."admin.php'>Cliquer ici pour acc&eacute;der &agrave; votre espace r&eacute;serv&eacute; SPIBOOK</a></p>
        <p>Voici vos identifiants:</p>";
            
            
        $body .= "<ul>";
        $body .= "<li>Date d'inscription : ".$date."</li>";
        $body .= "<li>login : ".$admin->getMail()."</li>";
        $body .= "<li>mot de passe : ".$pwd."</li>";
        $body .= "</ul>";
//        $body .= "<p><a href='".$_ENV['properties']['Path']['sitePath']."admin.php'>Rendez-vous &agrave; la page suivante pour publier vos &eacute;v&eacute;nements : ".$_ENV['properties']['Path']['sitePath']."admin.php"."</a></p>";
        $body .= file_get_contents('../mail/footerMail.php');
        
//        $altbody = "Votre inscription a bien &eacute;t&eacute; prise. \n ";
//        $altbody .= "identifiant : ".$admin->getMail()."\n";
//        $altbody .= "mot de passe : ".$pwd."\n";
//        $altbody .= "Rendez-vous &agrave; la page suivante : ";
//        $altbody .= $_ENV['properties']['Path']['sitePath']."admin.php";
        
        $this->altBody = self::html2text($body);
        $this->body = $body;
        $this->isHtml = true;
        $this->subject = "Spibook - confirmation inscription";  
        
        $this->to = $admin->getMail();
        
        $this->from = "contact@spibook.com";
        $this->fromName = "Service inscription - SPIBOOK";
        
        return $this->envoyerMessage();
    
       
   }
   
   
   
   /**
    * mail Confirmation Inscription
    * @param Administrateur $admin
    * @param Lieu $lieu
    * @param type $pwd
    * @return type
    */
   public function mailConfirmationActivation(Administrateur $admin, $isSpibookActivated){
       
       
        $date = date('m/d/Y h:i:s a', time());
             
        
        $this->subject = "Spibook - ACTIVATION";
        $body = "<h3>Vous venez d'activer votre page Spibook.</h3>";
        $body .= "<br/>";
        
        
        switch ($isSpibookActivated) {
            case false:
                $body .= "<p>Votre page et tous les &eacute;v&eacute;nements associ&eacute;s seront consultables par les internautes une fois valid&eacute;e par l'&eacute;quipe Spibook.</p>";
                break;
            case true:
                $body .= "<p>Votre page et tous les &eacute;v&eacute;nements associ&eacute;s sont maintenant consultables par tous les internautes.</p>";
                break;
            default:
                break;
        }


        $body .= "<br/><br/>Date d'activation : ".$date."\n";
       
        
        
        $this->altBody = null;
        $this->body = $body;
        $this->isHtml = false;
        
        $this->to = $admin->getMail();
        
        $this->from = "contact@spibook.com";
        $this->fromName = "Service activation - SPIBOOK";
        
        return $this->envoyerMessage();
        
       
   }
   
   /**
    * mail Confirmation Inscription
    * @param Administrateur $admin
    * @param Lieu $lieu
    * @param type $pwd
    * @return type
    */
   public function mailConfirmationDesactivation(Administrateur $admin, $isSpibookActivated){
       
       
        $date = date('m/d/Y h:i:s a', time());
        
        
        
        $this->subject = "Spibook - DESACTIVATION";
        $body = "<h3>Vous venez de desactiver votre page Spibook.</h3>";
        $body .= "<br/>";
        $body .= "<p>Votre page et tous les &eacute;v&eacute;nements associ&eacute;s ne sont plus consultables par les internautes.</p>";
        switch ($isSpibookActivated) {
            case false:
                $body .= "<p>Vous avez d&eacute;sactiv&eacute; votre fiche organisateur. Elle sera mise en ligne après validation de votre part et de l'&eacute;quipe Spibook.</p>";
                break;
            case true:
                $body .= "<p>Vous avez d&eacute;sactiv&eacute; votre fiche organisateur. Elle n'est donc plus visible sur Spibook pour l'instant.</p>";
                $body .= "<p>La r&eacute;activation de votre profil rendra vos &eacute;v&eacute;nements à nouveau visible sur le site.</p>";
                break;
            default:
                break;
        }


        $body .= "<br/><br/>Date de desactivation : ".$date."\n";
       
        
        
        $this->altBody = null;
        $this->body = $body;
        $this->isHtml = false;
        
        $this->to = $admin->getMail();
        
        $this->from = "contact@spibook.com";
        $this->fromName = "Service activation - SPIBOOK";
        
        return $this->envoyerMessage();
        
       
   }
   
   public function mailRecoverPwdNewPwd($mail,$pwd){
        $this->subject = "SPIBOOK - mot de passe perdu -  2 / 2";

       
        $body = file_get_contents('../mail/headerMail.php');
        $body .= "<ul>";
        
        
        $body .= "<li>mot de passe : ".$pwd."</li>";
        $body .= "</ul>";
        $body .= "<p><a href='".$_ENV['properties']['Path']['sitePath']."admin.php'>Rendez-vous &agrave; la page suivante pour publier vos &eacute;v&eacute;nements : ".$_ENV['properties']['Path']['sitePath']."/admin.php"."</a></p>";
        $body .= file_get_contents('../mail/footerMail.php');
        
        $this->altBody = self::html2text($body);
        $this->body = $body;
        $this->isHtml = false;
        
        $this->to = $mail;
        
        $this->from = "contact@spibook.com";
        $this->fromName = "Service administrateurs - SPIBOOK";
        
        return $this->envoyerMessage();
        
       
   }
   
/**
    * mail Confirmation Inscription
    * @param Administrateur $admin
    * @param Lieu $lieu
    * @param type $pwd
    * @return type
    */
   public function mailRecoverPwdSecretKey($mail,$key){
       
        $this->subject = "SPIBOOK - mot de passe perdu -  1 / 2";

       
        $body = file_get_contents('../mail/headerMail.php');
        $body .= "<p>Pour g&eacute;n&eacute;rer un nouveau mot de passe, cliquer sur le lien suivant:";
        $body .= "<br/><br/>";
        $body .= "<p><a href='".$_ENV['properties']['Path']['sitePath']."admin.php?recover=".$key."'>".$_ENV['properties']['Path']['sitePath']."admin.php?recover=".$key."</a></p>";
        $body .= "<br/><br/>";
        $body .= file_get_contents('../mail/footerMail.php');
        
           
        $this->altBody = self::html2text($body);
        $this->body = $body;
        $this->isHtml = false;
        
        $this->to = $mail;
        
        $this->from = "contact@spibook.com";
        $this->fromName = "Service administrateurs - SPIBOOK";
        
        return $this->envoyerMessage();
        
       
   }

    /**
     * Mail envoyer &agrave; l'ajout d'un nouveau lieu par un administrateur
     * @param Administrateur $admin
     * @param Lieu $lieu
     * @return type
     */
    public function mailContactOrganisateurEvenement($name,$email_address,$objet,$phone,$message){

        $this->subject = "SPIBOOK - Message d'un utilisateur";


        $body = file_get_contents('../mail/headerMail.php');
        $body .= "<p>Message envoyé depuis le site";
        $body .= "<br/><br/>";

        $body .= file_get_contents('../mail/footerMail.php');

        $this->altBody = self::html2text($body);
        $this->body = $body;
        $this->isHtml = false;

        $this->to = "toto@toto.toto";

        $this->from = "contact@spibook.com";
        $this->fromName = "Service administrateurs - SPIBOOK";

        return $this->envoyerMessage();
    }



   /**
    * Mail envoyer &agrave; l'ajout d'un nouveau lieu par un administrateur
    * @param Administrateur $admin
    * @param Lieu $lieu
    * @return type
    */
   public function mailConfirmationAjoutLieu(Administrateur $admin, Lieu $lieu){
        
       
       
       $this->subject = "SPIBOOK - ajout nouvel organisateur";

       
        $body = file_get_contents('../mail/headerMail.php');
        $body .= "<p>Nous vous confirmons l'ajout dans votre espace Spibook d'un nouvel organisateur.";
        $body .= "<h3>".$lieu->getNom()."</h3>";
        $body .= "<br/><br/>";
        $body .= "<p>Vous pouvez le mettre &agrave; jour dans votre espace spibook &agrave; la page suivante : </p>";
        $body .= "<p><a href='".$_ENV['properties']['Path']['sitePath']."admin.php?page=lieu'>".$_ENV['properties']['Path']['sitePath']."admin.php?page=lieu</a></p>";
        $body .= "<br/><p>Vous pouvez &eacute;galement commenc&eacute; &agrave; programmer vos &eacute;v&eacute;nements : </p>";
        $body .= "<p><a href='".$_ENV['properties']['Path']['sitePath']."admin.php?page=evenement'>".$_ENV['properties']['Path']['sitePath']."admin.php?page=evenement</a></p>";
        $body .= "<br/><br/>";
        $body .= file_get_contents('../mail/footerMail.php');
        
        $this->altBody = self::html2text($body);
        $this->body = $body;
        $this->isHtml = false;
        
        $this->to = $admin->getMail();
        
        $this->from = "contact@spibook.com";
        $this->fromName = "Service administrateurs - SPIBOOK";
        
        return $this->envoyerMessage();
   }
   
   /**
    * Envoi de mail depuis la zone d'admin to Spibook
    * @param Administrateur $admin
    * @param type $objet
    * @param type $message
    * @return type
    */
   public function mailFromAdmin(Administrateur $admin, $objet,$message){
       
        $this->subject = "Mail from ".$admin->getNomComplet();

       
        
        $body = file_get_contents('../mail/headerMail.php');
        $body .= "<p>De : <b>".$admin->getNom()." ".$admin->getPrenom()." -- ".$admin->getMail()."</b></p>";
        $body .= "<br/>";
        $body .= "<p>Objet : <b>".$objet."</b></p>";
        $body .= "<br/>";
        $body .= "<p>Message : <b>".$message."</b></p>";
        $body .= file_get_contents('../mail/footerMail.php');
        
           
        $this->altBody = self::html2text($body);
        $this->body = $body;
        $this->isHtml = false;
        
        $this->to = "spibook.contact@gmail.com";
        
        $this->from = "contact@spibook.com";
        $this->fromName = "Assistance utilisateur - Spibook";
        
        return $this->envoyerMessage();
        
       
   }
   
   
   /**
    * Envoi un mail pour tracker les bugs
    * @param type $testeur
    * @param type $date
    * @param type $mail
    * @param type $page
    * @param type $navigateur
    * @param type $description
    */
   public function mailBugTracker($testeur,$date,$mail,$page,$navigateur, $description){
       
        Applog::ecrireLog("testeur : [".$testeur."]", "debug");
        Applog::ecrireLog("date : [".$date."]", "debug");
        Applog::ecrireLog("mail : [".$mail."]", "debug");
        Applog::ecrireLog("page : [".$page."]", "debug");
        Applog::ecrireLog("navigateur : [".$navigateur."]", "debug");
        Applog::ecrireLog("description : [".$description."]", "debug");

       
       Applog::ecrireLog("rentre dans util mail bug tracker", "debug");
       
        $this->subject = "SPIBUG - anomalie remontee depuis le site - testeur : [".$testeur."]";
        
        $body = "<p>testeur : <b>".$testeur."</b></p>";
        $body .= "<p>date : <b>".$date."</b></p>";
        $body .= "<p>mail : <b>".$mail."</b></p>";
        $body .= "<p>page du bug : <b>".$page."</b></p>";
        $body .= "<p>navigateur : <b>".$navigateur."</b></p>";
        $body .= "<p>description : <br/>".$description."<p>";
        

        $this->altBody = self::html2text($body);
        $this->body = $body;
        $this->isHtml = false;
        
        $this->to = "spibook.contact@gmail.com";
        
        $this->from = "contact@spibook.com";
        $this->fromName = "SPIBUG - [".$testeur."]";
        
        return $this->envoyerMessage();
   }
   /**
    * Mail envoy&eacute; aux admin par le superadmin lors de l'activation d'un lieu par le superadmin
    * 
    * @param Admin $admin
    * @param Lieu $lieu
    * @return type
    */
   public function mailActivationSuperAdmin($admin,$lieu){
       
        $date = date('m/d/Y h:i:s a', time());
        
        
        $body = file_get_contents('../mail/headerMail.php');
        $body = "<br/>".$date."<br/>";
        $body .= "<h3>Votre fiche a &eacute;t&eacute; activ&eacute;e</h3>
        <p>Bonjour, </p>
        <p>Nous avons activ&eacute; votre fiche spibook : 
        <br/><h4>".$lieu->getNom()."</h4><br/>
        Vous pouvez maintenant publier vos &eacute;v&eacute;nements sur Spibook.</p>
        <p>Si vous rencontrez des difficult&eacute;s dans l'utilisation du site, n'h&eacute;sitez pas à nous en faire part en r&eacute;pondant directement à ce mail.</p>
        <br/><br/>
        
        <p><a href='".$_ENV['properties']['Path']['sitePath']."admin.php'>Cliquer ici pour acc&eacute;der à votre espace r&eacute;serv&eacute; SPIBOOK</a></p>
        <br/>";
           
        $body .= file_get_contents('../mail/footerMail.php');
        
        
        $this->altBody = self::html2text($body);
        $this->body = $body;
        $this->isHtml = true;
        $this->subject = "Spibook - activation de votre profil";  
        
        $this->to = $admin->getMail();
        
        $this->from = "contact@spibook.com";
        $this->fromName = "Service activation - SPIBOOK";
        
        return $this->envoyerMessage();
   }
   /**
    * Mail envoy&eacute; aux admin par le superadmin lors de l'activation d'un lieu par le superadmin
    * 
    * @param Admin $admin
    * @param Lieu $lieu
    * @return type
    */
   public function mailDesactivationSuperAdmin($admin,$lieu){
       
        $date = date('m/d/Y h:i:s a', time());
        
        
        $body = file_get_contents('../mail/headerMail.php');
        $body = "<br/>".$date."<br/>";
        $body .= "<h3>Votre fiche a &eacute;t&eacute; d&eacute;sactiv&eacute;e</h3>
        <p>Bonjour, </p>
        <p>Nous avons d&eacute;sactiv&eacute; votre fiche spibook : 
        <br/><h4>".$lieu->getNom()."</h4><br/>
        <p>Vos &eacute;v&eacute;n&eacute;ments sont donc temporairement invisibles des internautes</p>
        <p>Si cette d&eacute;sactivation ne vous semble pas normale, n'h&eacute;sitez pas &agrave; nous contacter directement par r&eacute;ponse à ce mail.</p>
        <br/><br/>
        
        <p><a href='".$_ENV['properties']['Path']['sitePath']."admin.php'>Cliquer ici pour acc&eacute;der à votre espace r&eacute;serv&eacute; SPIBOOK</a></p>
        <br/>";
           
        $body .= file_get_contents('../mail/footerMail.php');
        
        
        $this->altBody = self::html2text($body);
        $this->body = $body;
        $this->isHtml = true;
        $this->subject = "Spibook - d&eacute;sactivation de votre profil";  
        
        $this->to = $admin->getMail();
        
        $this->from = "contact@spibook.com";
        $this->fromName = "Service activation - SPIBOOK";
        
        return $this->envoyerMessage();
   }
   
   /**
    * Transforme du HTML en texte pour les messageries qui ne lisent pas le html
    * @param type $html
    * @return type
    */
   private static function html2text($html)
        {
                // On remplace tous les sauts de lignes par un espace
                $html = str_replace("\n", ' ', $html);
                
                // Supprimer tous les liens internes
                $texte = preg_replace("/\<a href=['\"]#(.*?)['\"][^>]*>(.*?)<\/a>/ims", "\\2", $html);
        
                // Supprime feuille style
                $texte = preg_replace(";<style[^>]*>[^<]*</style>;i", "", $texte);
         
                // Remplace tous les liens        
                $texte = preg_replace("/\<a[^>]*href=['\"](.*?)['\"][^>]*>(.*?)<\/a>/ims", "\\2 (\\1)", $texte);
        
                // Les titres
                $texte = preg_replace(";<h1[^>]*>;i", "\n= ", $texte);
                $texte = str_replace("</h1>", " =\n\n", $texte);
                $texte = preg_replace(";<h2[^>]*>;i", "\n== ", $texte);
                $texte = str_replace("</h2>", " ==\n\n", $texte);
                $texte = preg_replace(";<h3[^>]*>;i", "\n=== ", $texte);
                $texte = str_replace("</h3>", " ===\n\n", $texte);
                
                // Une fin de liste
                $texte = preg_replace(";</(u|o)l>;i", "\n\n", $texte);
                
                // Une saut de ligne *après* le paragraphe
                $texte = preg_replace(";<p[^>]*>;i", "\n", $texte);
                $texte = preg_replace(";</p>;i", "\n\n", $texte);
                // Les sauts de ligne interne
                $texte = preg_replace(";<br[^>]*>;i", "\n", $texte);
        
                //$texte = str_replace('<br /><img class=\'spip_puce\' src=\'puce.gif\' alt=\'-\' border=\'0\'>', "\n".'-', $texte);
                $texte = preg_replace (';<li[^>]*>;i', "\n".'- ', $texte);
        
        
                // accentuation du gras
                // <b>texte</b> -> **texte**
                $texte = preg_replace (';<b[^>]*>;i', '**', $texte);
                $texte = str_replace ('</b>', '**', $texte);
        
                // accentuation du gras
                // <strong>texte</strong> -> **texte**
                $texte = preg_replace (';<strong[^>]*>;i', '**', $texte);
                $texte = str_replace ('</strong>', '**', $texte);
        
        
                // accentuation de l'italique
                // <em>texte</em> -> *texte*
                $texte = preg_replace (';<em[^>]*>;i', '/', $texte);
                $texte = str_replace ('</em>', '*', $texte);
                
                // accentuation de l'italique
                // <i>texte</i> -> *texte*
                $texte = preg_replace (';<i[^>]*>;i','/', $texte);
                $texte = str_replace ('</i>', '*', $texte);
        
                $texte = str_replace('&oelig;', 'oe', $texte);
                $texte = str_replace("&nbsp;", " ", $texte);
//                $texte = filtrer_entites($texte);
        
                // On supprime toutes les balises restantes
//                $texte = supprimer_tags($texte);
        
                $texte = str_replace("\x0B", "", $texte); 
                $texte = str_replace("\t", "", $texte) ;
                $texte = preg_replace(";[ ]{3,};", "", $texte);
        
                // espace en debut de ligne
                $texte = preg_replace("/(\r\n|\n|\r)[ ]+/", "\n", $texte);
        
                //marche po
                // Bring down number of empty lines to 4 max
                $texte = preg_replace("/(\r\n|\n|\r){3,}/m", "\n\n", $texte);
        
                //saut de lignes en debut de texte
                $texte = preg_replace("/^(\r\n|\n|\r)*/", "\n\n", $texte);
                //saut de lignes en debut ou fin de texte
                $texte = preg_replace("/(\r\n|\n|\r)*$/", "\n\n", $texte);
        
                // Faire des lignes de 75 caracteres maximum
                //$texte = wordwrap($texte);
        
                return $texte;
        }
   
   
   
}



?>