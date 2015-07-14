<?php
require '../api/Slim/Slim.php';

require('../services/Main.class.php');



$index = new Main();

$index->setBooAdmin(true);
$index->init();

// Routeur REST 

// $app->METHOD(URL DE LA PAGE, NOM DE LA FONCTION A APPELER)

$app = new Slim();
$app->get('/evenements', 'getEvenements');
$app->get('/evenementsSortTypes/:idType', 'getEvenementsSortTypes');
$app->get('/typesevenements/:avecEvenement','getTypeEvenements');


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
 * Liste les événements triees par type
 * @param type $idType
 */
function getEvenementsSortTypes($idType) {
    
    $args = array();
    $EvenementTheme = array();
    $EvenementType = array();
    $EvenementOrganisateur = array();
    
    $criteres = new EvenementSearchCriteria();
    
//    if(isset($_GET['organisateurs'])){        
//        foreach($_GET['organisateurs'] as $chkbx){array_push($EvenementOrganisateur, $chkbx);}
//        $criteres->setOrganisateurs($EvenementOrganisateur);
//    }
//    if(isset($_GET['themes'])){        
//        foreach($_GET['themes'] as $chkbx){array_push($EvenementTheme, $chkbx);}
//        $criteres->setThemes($EvenementTheme);
//    }
//    if(isset($_GET['types'])){
//        foreach($_GET['types'] as $chkbx){array_push($EvenementType, $chkbx);}
//        $criteres->setTypes($EvenementType);
//    }
//    if(isset($_GET['search-motscles'])){
//        $motcles = $_GET['search-motscles'];
//        if($motcles != ""){$criteres->setEvenementMotsCles($motcles);}
//    }
//    if(isset($_GET['start'])){
//        $start = $_GET['start'];
//        if($start != ""){$criteres->setDateMin($start);}
//    }
//    
//    if(isset($_GET['end'])){
//        $end = $_GET['end'];
//        if($end != ""){$criteres->setDateMax($end);}
//    }
    
 
    $criteres->setEvenementType(array($idType));
    $criteres->setEvenementOrder("debut", "ASC");
    $criteres->setEvenementAfterToday(true);
    $condition = $criteres->getCondition();
    
    $sql = Query::getListeEvenements($condition); 
    AppLog::ecrireLog("DANS REST 1", 'debug');
    AppLog::ecrireLog($sql, 'debug');
    AppLog::ecrireLog("DANS REST 2", 'debug');
    try {
            $db = getConnection();
            $db->query('SET CHARACTER SET utf8');
            $stmt = $db->query($sql);  
            $events = $stmt->fetchAll(PDO::FETCH_OBJ);
           
            $db = null;
            echo '{"evenements": ' . json_encode($events) . '}';
    } catch(PDOException $e) {
            
            echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}


function getEvenements() {
    
    $args = array();
    $EvenementTheme = array();
    $EvenementType = array();
    $EvenementOrganisateur = array();
    
    $criteres = new EvenementSearchCriteria();
    
    if(isset($_GET['organisateurs'])){        
        foreach($_GET['organisateurs'] as $chkbx){array_push($EvenementOrganisateur, $chkbx);}
        $criteres->setOrganisateurs($EvenementOrganisateur);
    }
    if(isset($_GET['themes'])){        
        foreach($_GET['themes'] as $chkbx){array_push($EvenementTheme, $chkbx);}
        $criteres->setThemes($EvenementTheme);
    }
    if(isset($_GET['types'])){
        foreach($_GET['types'] as $chkbx){array_push($EvenementType, $chkbx);}
        $criteres->setTypes($EvenementType);
    }
    if(isset($_GET['search-motscles'])){
        $motcles = $_GET['search-motscles'];
        if($motcles != ""){$criteres->setEvenementMotsCles($motcles);}
    }
    if(isset($_GET['start'])){
        $start = $_GET['start'];
        if($start != ""){$criteres->setDateMin($start);}
    }
    
    if(isset($_GET['end'])){
        $end = $_GET['end'];
        if($end != ""){$criteres->setDateMax($end);}
    }
    
 
  
    $criteres->setEvenementOrder("debut", "ASC");
    $criteres->setEvenementAfterToday(null);
    $condition = $criteres->getCondition();
    
    $sql = Query::getListeEvenements($condition); 
    AppLog::ecrireLog("DANS REST 1", 'debug');
    AppLog::ecrireLog($sql, 'debug');
    AppLog::ecrireLog("DANS REST 2", 'debug');
    try {
            $db = getConnection();
            $db->query('SET CHARACTER SET utf8');
            $stmt = $db->query($sql);  
            $events = $stmt->fetchAll(PDO::FETCH_OBJ);
           
            $db = null;
            echo '{"evenements": ' . json_encode($events) . '}';
    } catch(PDOException $e) {
            
            echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}




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



