<?php
require '../api/Slim-1-5-0/Slim.php';

require('../services/Main.class.php');



$index = new Main();

$index->setBooAdmin(true);
$index->init();

$app = new Slim();
$app->get('/pays/','getPays');
$app->get('/area1/:pays','getArea1');
$app->get('/area2/:area1','getArea2');
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
        $pays           = $app->request()->params('pays');
        $area1          = $app->request()->params('area1');
        $area2          = $app->request()->params('area2');
        
        
        $criteres = new EvenementSearchCriteria();
        
        $criteres->setEvenementType(checkParam($types,true));
        $criteres->setEvenementMotsCles($mots);        
        $criteres->setEvenementDateMin($dateDebut);    
        $criteres->setEvenementDateMax($dateFin);
        $criteres->setEvenementOrganisateur(checkParam($organisateur,true));
        $criteres->setEvenementPays(checkParam($pays,false));
        $criteres->setEvenementArea1(checkParam($area1,false)); 
        $criteres->setEvenementArea2(checkParam($area2,false));
        
        
        $criteres->setEvenementOrder("debut", "ASC");
        $criteres->setEvenementAfterToday(true);
       
        
        $condition = $criteres->getCondition();
        AppLog::ecrireLog($condition, "debug");
        
        
        $sql = Query::getListeEvenements($condition); 
        
        runQuery($sql, "evenements");
          
          
});

$app->notFound(function () {
    $url = Redirect::getCurrentUrl();
    AppLog::ecrireLog("PAGE 404 rest url [".$url."]", "debug");
    Redirect::toPage("../www/index.php ");
});



$app->run();

/**
 * Liste des types d'événements
 * @param type $avecEvenements
 */
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
 * Renvoi la liste des régions en fonction des premières lettres saisies
 * @param type $q
 */
function getPays(){
    
    $sql = Query::getPays(); 
        
    runQuery($sql, "pays");
    
}

/**
 * Renvoi la liste des régions en fonction des premières lettres saisies
 * @param type $q
 */
function getArea1($pays){
    $q = urldecode($pays);
    $sql = Query::getArea1($pays); 
        
    runQuery($sql, "area1");
    
}

/**
 * Renvoi la liste des départements en fonction de la région passé en param et des premières lettres
 * @param type $area1
 * @param type $q
 */
function getArea2($area1){
    $area1 = urldecode($area1);
    $sql = Query::getArea2($area1); 
        
    runQuery($sql, "area2");
    
}

/**
 * Test le parametre et renvoi un tableau si besoin (explode)
 * @param type $param
 * @return type
 */
function checkParam($param, $explode = true){
    if(is_int($param)){
        $param = "-".$param;
    }
    if(is_array($param)){
        $ret =  $param;
    }else{
       if($param == ""){
           $ret = null;
       }else{
           switch ($explode) {
               case true:
                   if(strpos($param, "-")==""){
                        $ret = array($param);
                    }else{
                        $ret = explode("-", $param);
                    }

                   break;

               case false:
                   $ret = array($param);
                   break;
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




/**
 * Créer et renvoi la connexion
 * @return \PDO
 */
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



