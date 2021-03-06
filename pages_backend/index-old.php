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
$app->get('/evenements/:debut/:offset', 'getEvenementsLimit');
$app->get('/evenement/:id', 'getEvenement');
$app->get('/themes/:listId','getThemesEvenement');
$app->get('/theme/:id',	'getThemeEvenement');
$app->get('/typesevenement/:listId','getTypesEvenement');
$app->get('/typesOrganisateur/:listId','getTypesOrganisateur');
$app->get('/type/:id','getTypeEvenements');
$app->get('/organisateur/:id','getOrganisateur');
$app->get('/organisateurs','getOrganisateurs');
$app->get('/organisateursresume','getListeOrganisateursResume');
$app->get('/organisateurs/:debut/:offset','getOrganisateursLimit');
$app->get('/nbevenementsparthemes','getNbEvenementParTheme');
$app->get('/organisateursprochainevenement', 'getOrganisateurNextEvent');

$app->notFound(function () {
    $url = Redirect::getCurrentUrl();
    AppLog::ecrireLog("PAGE 404 rest url [".$url."]", "debug");
    Redirect::toPage("../www/index.php ");
});

$app->run();


/**
 * Renvoi la liste des organisateurs avec le nombre de jours pour le prochain évenement
 */
function getOrganisateurNextEvent(){  
    $sql = Query::getListeOrganisateurDateProchainEvenement();
     try {
        $db = getConnection();
        $db->query('SET CHARACTER SET utf8');
        $stmt = $db->query($sql);
        $liste = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"organisateurs": ' . json_encode($liste) . '}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

/**
 * Renvoi la liste des themes avec le nombre d'événément par themes
 */
function getNbEvenementParTheme(){
    $sql = Query::getNbEvenementParThemes();
    AppLog::ecrireLog("dans getNbEvenementParTheme [".$sql."]", "debug");
     try {
        $db = getConnection();
        $db->query('SET CHARACTER SET utf8');
        $stmt = $db->query($sql);
        $liste = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"themes": ' . json_encode($liste) . '}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

// TYPE
function getTypeEvenements($id){
    
    $sql = Query::getType($id);
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

function getTypesOrganisateur($listId){
    
    $criteres = new TypesOrganisateurSearchCriteria();
    
    if($listId != "*"){
     $tab = explode(",", $listId);
     $criteres->setTypesId($tab);
    }
    
    $sql = Query::getListeTypesOrganisateur($criteres->getCondition());
    
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

function getTypesEvenement($listId){
    
    $criteres = new TypesEvenementSearchCriteria();
    
    if($listId != "*"){
     $tab = explode(",", $listId);
     $criteres->setTypesId($tab);
    }
    
    $sql = Query::getListeTypesEvenement($criteres->getCondition());
    
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

// THEME
function getThemeEvenement($id){
    $sql = Query::getTheme($id);
    try {
        $db = getConnection();
        $db->query('SET CHARACTER SET utf8');
        $stmt = $db->query($sql);
        $liste = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"themes": ' . json_encode($liste) . '}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }

}

function getThemesEvenement($listId){
    $criteres = new ThemesSearchCriteria();

    if($listId != "*"){
        $tab = explode(",", $listId);
        $criteres->setId($tab);
    }
    AppLog::ecrireLog("dans getThemesEvenement  condition : [".$criteres->getCondition()."]", "debug");
    $sql = Query::getListeThemes($criteres->getCondition());

    try {
        $db = getConnection();
        $db->query('SET CHARACTER SET utf8');
        $stmt = $db->query($sql);
        $liste = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"themes": ' . json_encode($liste) . '}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }

}

// EVENEMENT
function getEvenement($id){

    $sql = Query::getEvenement($id);
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

function getEvenementsLimit($debut, $offset) {
        $criteres = new EvenementSearchCriteria();
        $criteres->setEvenementLimit($debut, $offset);
        $sql = Query::getListeEvenements($criteres->getCondition());
        
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

// ORGANISATEUR
function getOrganisateur($id){
    
    $sql = Query::getOrganisateur($id);
   
    try {
        $db = getConnection();
        $db->query('SET CHARACTER SET utf8');
        $stmt = $db->query($sql);
        $items = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"organisateurs": ' . json_encode($items) . '}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function getOrganisateurs(){
    $criteres = new OrganisateurSearchCriteria();
    $sql = Query::getListeOrganisateurs($criteres->getCondition());
    try {
        $db = getConnection();
        $db->query('SET CHARACTER SET utf8');
        $stmt = $db->query($sql);
        $items = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"organisateurs": ' . json_encode($items) . '}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function getListeOrganisateursResume(){
    $criteres = new OrganisateurSearchCriteria();
    $sql = Query::getListeOrganisateursResume($criteres->getCondition());
    try {
        $db = getConnection();
        $db->query('SET CHARACTER SET utf8');
        $stmt = $db->query($sql);
        $items = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"organisateurs": ' . json_encode($items) . '}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


function getOrganisateursLimit($debut, $offset){
    $criteres = new OrganisateurSearchCriteria();
    $criteres->setOrganisateurLimit($debut, $offset);
    $sql = Query::getListeOrganisateurs($criteres->getCondition());
    try {
        $db = getConnection();
        $db->query('SET CHARACTER SET utf8');
        $stmt = $db->query($sql);
        $items = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"organisateurs": ' . json_encode($items) . '}';
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



