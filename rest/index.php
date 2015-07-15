<?php
require '../api/Slim-1-5-0/Slim.php';

require('../services/Main.class.php');



$index = new Main();

$index->setBooAdmin(true);
$index->init();

$app = new Slim();



//$app = new Slim();

//$app->get('/evenements', 'getEvenements');
$app->get('/evenementsSortTypes/:idType', 'getEvenementsSortTypes');
$app->get('/typesevenements/:avecEvenement','getTypeEvenements');

/**
 * Liste les événements
 */
$app->get('/evenements',  function () use ($app) {
        $types          = $app->request()->params('types');
        $mots           = $app->request()->params('mots');
        $dateDebut      = $app->request()->params('datemin');
        $dateFin        = $app->request()->params('datemax');
        $organisateur   = $app->request()->params('organisateur');
        $dep            = $app->request()->params('dep');
        
        AppLog::ecrireLog("dans rest - ".$dep, "debug");
        
        $criteres = new EvenementSearchCriteria();
        
        $criteres->setEvenementDepartement(checkParam($dep));
        
        
        $criteres->setEvenementType(checkParam($types));
        $criteres->setEvenementMotsCles($mots);        
        $criteres->setEvenementDateMin($dateDebut);    
        $criteres->setEvenementDateMax($dateFin);
        $criteres->setEvenementOrganisateur(checkParam($organisateur));
        
        
        $criteres->setEvenementOrder("debut", "ASC");
        $criteres->setEvenementAfterToday(true);
        $condition = $criteres->getCondition();

        AppLog::ecrireLog($condition,"debug");
        
        $sql = Query::getListeEvenements($condition); 
        
        runQuery($sql, "evenements");
          
          
});
//$types = $app->request()->get('types');

$app->notFound(function () {
    $url = Redirect::getCurrentUrl();
    AppLog::ecrireLog("PAGE 404 rest url [".$url."]", "debug");
    Redirect::toPage("../www/index.php ");
});



$app->run();

// TYPE
function getTypeEvenements($avecEvenements){
    if($avecEvenements==1){
        $avecEvenements = true;
    }else{
        $avecEvenements = false;
    }
    $sql = Query::getListeTypeEvenement($avecEvenements);
    try {
        $db = getConnection();
        $db->query('SET CHARACTER SET utf8');
        $stmt = $db->query($sql);
        $liste = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"types": ' . json_encode($liste) . '}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }

}


/**
 * @param type $param
 * @return type
 */
function checkParam($param){
    if(is_int($param)){
        $param = "-".$param;
    }
    if(is_array($param)){
        $ret =  $param;
    }else{
       if($param == ""){
           $ret = null;
       }else{
          
           if(strpos($param, "-")==""){
               $ret = array($param);
           }else{
               $ret = explode("-", $param);
           }
           
       }
    }
    
    return $ret;
}
/**
 * Execution de la requete et génération du json
 * @param type $sql
 * @param type $type
 */
function runQuery($sql,$type){
    AppLog::ecrireLog($sql, "sql");
    try {
            $db = getConnection();
            $db->query('SET CHARACTER SET utf8');
            $stmt = $db->query($sql);  
            $objects = $stmt->fetchAll(PDO::FETCH_OBJ);
           
            $db = null;
            echo '{"'.$type.'": ' . json_encode($objects) . '}';
    } catch(PDOException $e) {
            
            echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

//function getEvenements() {
//    
//    $args = array();
//    $EvenementTheme = array();
//    $EvenementType = array();
//    $EvenementOrganisateur = array();
//    
//    $criteres = new EvenementSearchCriteria();
//    
//    
//    
//    die($types);
//    
////    if(isset($_GET['organisateurs'])){        
////        foreach($_GET['organisateurs'] as $chkbx){array_push($EvenementOrganisateur, $chkbx);}
////        $criteres->setOrganisateurs($EvenementOrganisateur);
////    }
////    if(isset($_GET['themes'])){        
////        foreach($_GET['themes'] as $chkbx){array_push($EvenementTheme, $chkbx);}
////        $criteres->setThemes($EvenementTheme);
////    }
////    if(isset($_GET['types'])){
////        foreach($_GET['types'] as $chkbx){array_push($EvenementType, $chkbx);}
////        $criteres->setTypes($EvenementType);
////    }
////    if(isset($_GET['search-motscles'])){
////        $motcles = $_GET['search-motscles'];
////        if($motcles != ""){$criteres->setEvenementMotsCles($motcles);}
////    }
////    if(isset($_GET['start'])){
////        $start = $_GET['start'];
////        if($start != ""){$criteres->setDateMin($start);}
////    }
////    
////    if(isset($_GET['end'])){
////        $end = $_GET['end'];
////        if($end != ""){$criteres->setDateMax($end);}
////    }
//    
// 
//  
//    $criteres->setEvenementOrder("debut", "ASC");
//    $criteres->setEvenementAfterToday(null);
//    $condition = $criteres->getCondition();
//    
//    $sql = Query::getListeEvenements($condition); 
//    AppLog::ecrireLog("DANS REST 1", 'debug');
//    AppLog::ecrireLog($sql, 'debug');
//    AppLog::ecrireLog("DANS REST 2", 'debug');
//    try {
//            $db = getConnection();
//            $db->query('SET CHARACTER SET utf8');
//            $stmt = $db->query($sql);  
//            $events = $stmt->fetchAll(PDO::FETCH_OBJ);
//           
//            $db = null;
//            echo '{"evenements": ' . json_encode($events) . '}';
//    } catch(PDOException $e) {
//            
//            echo '{"error":{"text":'. $e->getMessage() .'}}'; 
//    }
//}




// TECHNIQUE
function getConnection() {
    
    $info = Query::infoConnect();
    
    $dbhost=$info["host"];
    $dbuser=$info["user"];
    $dbpass=$info["pwd"];
    $dbname=$info["dbName"];
    
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    return $dbh;
}



