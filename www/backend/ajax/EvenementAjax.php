<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
date_default_timezone_set('UTC');
date_default_timezone_set('CET');

    require('../../../services/Main.class.php');
    $index = new Main();
    $index->setLevel(2);
    $index->setBooAdmin(true);
    $index->init();

// récupération des paramètres encodés
if ( ! empty($_POST['FormEncoded'])) {
    parse_str($_POST['FormEncoded'], $form);
}
$decodeObj = unserialize(urldecode($_POST['objEncoded']));


if(isset($_POST['act'])){
    $act = $_POST['act'];
	$invite = array();
    switch ($act) {
        /*
         * gestion de la partie action
         */
        case "ModifEvenement" :
            /* chargement des datas */
            parse_str($_POST['FormEncoded'], $tabData);
            /* critère de modification */
            $tabCriteres = array ( 'eve_int_id'=>$tabData['eve_int_id']);
            $test = $decodeObj->modifierEvenement($tabCriteres,$tabData);
        /*
         * Passage vers l'occurence suivante ou précédente
         */    
        break;
    
        case "SaveEvenement" :
            /* chargement des datas */
            parse_str($_POST['FormEncoded'], $tabData);
            /* critère de modification */
            $test = $decodeObj->ajouterEvenement($tabData);
        /*
         * Passage vers l'occurence suivante ou précédente
         */    
        break;
    
        case "DelEvenement" :
            /* chargement des datas */
            parse_str($_POST['FormEncoded'], $tabData);
            /* critère de modification */
            $test = $decodeObj->supprimerEvenement($tabData);
        /*
         * Passage vers l'occurence suivante ou précédente
         */    
        break;
    
    case "navOccurence":
            if ( $_POST['sens'] == Evenement::K_precedent )
                $occurence = $decodeObj->getOccurencePrecedente();             
            else
                $occurence = $decodeObj->getOccurenceSuivante();                
                
            if ( $occurence ) {                   
                $tabJson = $occurence->getOccurence4Json();
            }  
            $tabJson['butee'] = $decodeObj->isButeeOccurence()?Evenement::K_butee_on:Evenement::K_butee_off;
            /*
             * on réencode l'objet afin de récupérer les infos entre le script ajax et la page appelée
             */
            $tabJson['encodedObjet'] =  urlencode(serialize($decodeObj));
            /*
             * envoi des infos encodées en json à la page html 
             */
            echo json_encode($tabJson);
        break;

    case "navMedia":
            if ( $_POST['sens'] == Evenement::K_precedent )
                $objMedia = $decodeObj->getMediaPrecedent();             
            else
                $objMedia = $decodeObj->getMediaSuivant();                
                
            if ( $objMedia ) {                   
                $tabJson = $objMedia->getMedia4Json();
            }  
            $tabJson['butee'] = $decodeObj->isButeeMedia()?Evenement::K_butee_on:Evenement::K_butee_off;
            /*
             * on réencode l'objet afin de récupérer les infos entre le script ajax et la page appelée
             */
            $tabJson['encodedObjet'] =  urlencode(serialize($decodeObj));
            /*
             * envoi des infos encodées en json à la page html 
             */
            echo json_encode($tabJson);
        break;

        default:
            echo 0;
        break;   
    } 
}
?>