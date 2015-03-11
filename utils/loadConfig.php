<?php


/**
 * Class de chargement des parametres de configuration du fichier config.ini 
 */
final class LoadConfig{
    
    
    //Const FILEPATH = "../config/config.ini";
    //private $tableauIni;
    private static $instance;

    // getInstance method
    public static function getInstance() {

            if(!self::$instance) {
                    self::$instance = new self();
            }

            return self::$instance;
    }

    /**
     * Charge en mémoire la valeur du fichier de conf
     */
    private function loadFile($fileUrl){
        $fileConfig = array();
           if(file_exists($fileUrl) && $fileConfig=parse_ini_file($fileUrl,true)){
            //$this->tableauIni = $fileConfig;
           return $fileConfig;
        }else{
            echo "Le fichier est introuvable ou incompatible<br />";
        }    
    }
    
    /**
     * Récupérer la valeur d'un paramètre en fonction d'une clé définie
     * @param type $key
     * @return type 
     */
    public function getConfigValue($section, $key){
      // Ne va lire le fichier de property que la premiere fois.
      //if(!isset($this->tableauIni)){
        $dataArray = array(); 
        $dataArray = $this->loadFile();
      //}
      return $dataArray[$section][$key];
    }
    
    /**
     * Renvoi tous les properties sous forme de tableau
     * @return type 
     */
    public function getProperties($fileUrl){
        //if(!isset($this->tableauIni)){
        $dataArray = $this->loadFile($fileUrl);
      //}
      return $dataArray;
    }
  
    
}




?>
