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
        case "ModifMessage" :
            /* chargement des datas */
            parse_str($_POST['FormEncoded'], $tabData);
            /* critère de modification */
            $tabCriteres = array ( 'mes_int_id'=>$tabData['mes_int_id']);
            $test = $decodeObj->modifierMessage($tabCriteres,$tabData);
        break;
    
        case "SaveMessage" :
            /* chargement des datas */
            parse_str($_POST['FormEncoded'], $tabData);
            /* critère de modification */
            $test = $decodeObj->ajouterMessage($tabData);
        break;
    
        case "DelMessage" :
            /* chargement des datas */
            parse_str($_POST['FormEncoded'], $tabData);
            /* critère de modification */
            $test = $decodeObj->supprimerMessage($tabData);
        break;

        default:
            echo 0;
        break;   
    } 
}
?>