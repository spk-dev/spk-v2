<?php
/* Configure le limiteur de cache à 'private' */

session_cache_limiter('private');
//$cache_limiter = session_cache_limiter();

/* Configure le délai d'expiration à 30 minutes */
//session_cache_expire(4);
//$cache_expire = session_cache_expire();
session_start();
session_cache_expire(10);



require('../services/Main.class.php');



$index = new Main();

$index->setBooAdmin(true);
$index->setDefault_page("connect");
$index->setPage_dir("../pages-admin/");
$index->init();




if(isset($_GET['recover'])){
    $key = $_GET['recover'];
     if(AdministrateurAction::sendAdministratorNewPwd(urldecode($key))){
        $pageToRedirect .= "?alert=".urlencode('success')."&page=connect&msg=".urlencode("Votre nouveau mot de passe vient de vous être envoyé par mail.<br/>Si vous ne recevez rien, pensez à vérifier dans les messages indésirables.");
    }else{
        $pageToRedirect .= "?alert=".urlencode('alert')."&page=connect&msg=".urlencode("Une erreur a eu lieu, l'envoi du mot de passe est impossible. <br/>Vous pouvez contacter directement le webmaster : <a mailto='contact@spibook.com'>contact@spibook.com</a>");
    }
    Redirect::header($pageToRedirect);
}


if(isset($_POST['deconnexion'])){
    UtilSession::logoutSession();
    Redirect::toPage($_ENV['Page']['defaultAdmin']); 
}


if(isset($_POST['connexion'])){
    $mail = $_POST['mail'];
    $pass = $_POST['password'];

    $connexionStatus = AdministrateurAction::logIn($mail, $pass, false);

    $pageToRedirect = "admin.php";
    if(!$connexionStatus){
        $pageToRedirect .="?connexionResult=ko";
    }
    
    Redirect::header($pageToRedirect);
    
}
if(isset($_POST['sendPwd'])){
    
    $pageToRedirect = "admin.php";
    $mail = $_POST['mail'];
    
    if($mail=="" ){
         $pageToRedirect .= "?alert=".urlencode('alert')."&msg=".urlencode("Saisir une adresse email.")."#simpleContained2";
        
    }else if(!FormValidation::checkField($mail, "mail")){
        
       $pageToRedirect .= "?alert=".urlencode('alert')."&msg=".urlencode("Format de l'adresse email invalide. Le format attendu est <br/> xxxxx@xxxxx.xx")."#simpleContained2";
    }else if(!AdministrateurAction::administrateurDejaExistant($mail)){
        
         $pageToRedirect .= "?alert=".urlencode('alert')."&msg=".urlencode("Cette adresse email n'est associée à aucun compte")."#simpleContained2";
    }else{
    
    
        if(AdministrateurAction::sendAdministratorRecoveryLink($mail)){
            $pageToRedirect .= "?alert=".urlencode('success')."&msg=".urlencode("Un mail vient de vous être envoyé.<br/>Si vous ne recevez rien, pensez à vérifier dans les messages indésirables.");
        }else{
            $pageToRedirect .= "?alert=".urlencode('alert')."&msg=".urlencode("Une erreur a eu lieu, l'envoi du mot de passe est impossible. <br/>Vous pouvez contacter directement le webmaster : <a mailto='contact@spibook.com'>contact@spibook.com</a>");
        }
    }
    
    Redirect::header($pageToRedirect);
}


require_once('inc/admin/Header.php');

if(UtilSession::isSessionLoaded()){
    require_once('inc/admin/Menu.php');  
}

$admin->run();
if($_ENV['properties']['Infos']['plateforme'] != "prod"){
    require_once('inc/bugTracker.php');
}
require_once('inc/admin/Footer.php');

   
?>