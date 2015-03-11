<?php

include("MainIndex.class.php");

$AjaxAction = new MainIndex();

$AjaxAction->setBooAdmin(false);
$AjaxAction->init();

if(isset($_POST['contact-organisateur'])){
    
    $booResultat;


    if( empty($_POST['idEvenement'])        ||
        empty($_POST['nom'])                ||
        empty($_POST['email'])              ||
        empty($_POST['optinnewsletter'])    ||    
        empty($_POST['optinpartenaires'])   ||  
        empty($_POST['objet'])              ||
        empty($_POST['phone'])              ||
        empty($_POST['message'])            ||
        !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            echo "No arguments Provided!";
            return false;
        }
    $mail = new UtilMail();    

    $id                 = $_POST['idEvenement'];
    $nom                = $_POST['nom'];
    $sender             = $_POST['email'];
    $optinnewsletter    = $_POST['optinnewsletter'];
    $optinpartenaires   = $_POST['optinpartenaires'];
    $phone              = $_POST['phone'];
    $message            = $_POST['message'];
    $objet              = $_POST['objet'];
    
    if($optinnewsletter == 1){
        
    }
    
    if(!EvenementAction::exist(array($id))){
        
        
        
        

        
        $mail -> mailContactOrganisateurEvenement($nom,$sender,$objet,$phone,$message); 
        $booResultat = true;
    }else{
        $booResultat = false;
    }
    
    

    return $booResultat;
}