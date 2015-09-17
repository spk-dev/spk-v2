<?php
/**
* 
* Gestion des requêtes DB
*
* @author  G2I/IPE : Benjamain Teillard
*/
class UtilsDao{
    
       
    /** @var PDO */
    private $db = null;
    // singleton instance
    private static $instance;
//    private $startTime;
//    private $endTime;
    public $arrNb = array();
    
    public function __destruct() {
        $this->db = null;
    }

    /**
     * Cette méthode créé la connexion à la base de données
     * Attention : La durée de vie du singleton instance n'est que la durée du script PHP
     *             Ca ne sert donc que si on enchaine n requetes pour construire la page
     * 
     * La persistance complète de la connexion est géré dans l'attribut array(PDO::ATTR_PERSISTENT => true)
     * C'est alors le moteur APACHE qui gère le pool de connexion.....
     * @return un objet PDO
     *
     * @author  G2I/IPE : Benjamin Teillard
     *
     */     
     private function getDb() {
         
         
        $host = $_ENV["properties"]['Bdd']['host'];
        $log = $_ENV["properties"]['Bdd']['login'];
        $pwd = $_ENV["properties"]['Bdd']['password'];
        $bdName = $_ENV["properties"]['Bdd']['bd'];
        $db = null;
        $limit = 10;
        $counter = 0;
        if ($this->db !== null) {
             AppLog::ecrireLog("connection DB deja creee", "sql");
            return $this->db;
        }else{
            AppLog::ecrireLog("connection DB creee", "sql");
        }
        /*
         *  boucle de connexion à la DB : mauvais patch permettant d'éviter le message
         *  PDO::__construct(): MySQL server has gone away
         */
        
        
            //$config = Config::getConfig("db");
            try {
                $this->db = new PDO("mysql:host=".$host.";dbname=".$bdName, $log, $pwd);
                $requete = $this->db->prepare("SET NAMES 'utf8'");
                $requete->execute();
                return $this->db;
            }
            catch (Exception $myPHPException)
            {
                $db = null;
                $counter++;
                if ($counter == $limit)
                    trigger_error('Erreur sur la connexion'.$myPHPException->getMessage(), E_USER_ERROR);
            }
        

    }
    
    /**
    * Récupère l'instance courante
    * @return instance db
    *
    * @author  G2I/IPE : Benjamin Teillard
    *
    */     
    public static function getInstance() {       
        if(self::$instance==null) { 
              self::$instance = new UtilsDao(); 
              self::$instance->getDb();
        } 
        return self::$instance; 
  } 
  
    /**
    * Permet de se déconnecter
    *
    * @author  G2I/IPE : Benjamin Teillard
    *
    */   
    private function disconnect(){
            // on ferme la connexion � mysql
            mysql_close();
    }

    /**
    * Permet de donner un temps
    *
    * @return temps
    *
    * @author  G2I/IPE : Benjamin Teillard
    *
    */     
    private function getmicrotime(){  
        list($usec, $sec) = explode(" ",microtime());  
        return ((float)$usec + (float)$sec);  
    }

    /**
    * Permet d'e sauvegarder un nouvel utilisateur'exécuter une requête
    *
    * @param string $sql select sql à exécuter  
    * @return tableau des enregistrements retournés
    *
    * @author  G2I/IPE : Benjamin Teillard
    *
    */     
    public function executeRequete($sql){
//		AppLog::ecrireLog("   ", "sql");
		AppLog::ecrireLog("Requete select : [".$sql."]", "sql");
//        		
//		AppLog::ecrireLog("   ", "sql");
        try {
            $return = array(false);
            
            $requete = $this->getDb()->prepare($sql);
            $rq = $requete->execute();
            
            
            
            if($rq){
                $results_array = $requete->fetchAll(PDO::FETCH_ASSOC);
                $return = $results_array;
                
                
            }else{
                trigger_error("Erreur d'exécution d'une requête avec le code erreur : [".$requete->errorCode()."]<br>$sql", E_USER_ERROR);
                
            }
            
            return $return;
        }
        catch (Exception $myPHPException)
        {
            trigger_error("Erreur d'exécution d'une requête.<br>$sql", E_ERROR);
        }
        return $this->db;
    }
    
    /**
    * Permet d'exécuter un Update ou un delete
    *
    * @param string $sql sql à exécuter  
    * @return Vrai si données mises à jour ou supprimées / FAUX sinon
    *
    * @author  G2I/IPE : Benjamin Teillard
    *
    */     
    public function executeUpdateDelete($sql){
			AppLog::ecrireLog("Requete delete : [".$sql."]", "sql");
        try {
            $return = false;
            
            $requete = $this->getDb()->prepare($sql);
            $rq = $requete->execute();
            $nbrows = $requete->rowCount();
            
            if(!$rq || $nbrows < 1){
                $return = false;
            }else{
                $return = true;
            }
            return $return;
        }
        catch (Exception $myPHPException)
        {
            trigger_error("Erreur d'exécution d'une requête.<br>$sql", E_ERROR);
        }
    }
            
    /**
    * Permet d'exécuter un insert
    *
    * @param string $sql sql à exécuter  
    * @return array VRAI,Id si insert ok sinon FAUX,null
    *
    * @author  G2I/IPE : Benjamin Teillard
    *
    */   
    public function executeInsert($sql){
			AppLog::ecrireLog("Requete insert: [".$sql."]", "sql");
        try {
            $dbh = $this->getDb();
            $dbh->beginTransaction(); 
            $requete = $dbh->prepare($sql);
            $result = $requete->execute();
            $id = $dbh->lastInsertId();
            $dbh->commit(); 
            
            switch ($result) {
                case 0:
                    $results_array = array(false,null);
                break;
                case 1:
                    $results_array = array(true,$id);
                break;
                default:
                break;
            }
            return $results_array;    
        }
        catch (Exception $myPHPException)
        {
            trigger_error("Erreur d'exécution d'une requête.<br>$sql", E_ERROR);
        }
    }
        
        
    /**
    * Permet de donner les nombre d'enregistrements retournés
    *
    * @param string $sql select sql à exécuter  
    * @return array VRAI,Id si insert ok sinon FAUX,null
    *
    * @author  G2I/IPE : Benjamin Teillard
    *
    */  
    public function countResult($sql)
			
    {
	AppLog::ecrireLog("Requete count : [".$sql."]", "sql");
        try {
            $requete = $this->getDb()->prepare($sql);
            $rq = $requete->execute();
            return $requete->rowCount();
        }
        catch (Exception $myPHPException)
        {
            trigger_error("Erreur d'exécution d'une requête.<br>$sql", E_ERROR);
        }
    }
    
        
       
        

}






?>