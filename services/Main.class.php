<?php

/**
 * Main application class.
 */
final class Main {

//    const DEFAULT_PAGE = 'home2';
//    const PAGE_DIR = '../page/';
    private $level = 1; // Correspond au niveau de la classe dans l'arbo
    private $startTime;
    private $endTime;
    private $default_page ;
    private $page_dir;
    private $booAdmin;
    private $connexion_page = "";
    private $id = null;



    /**
     *
     */
    public function init_context(){
        error_reporting(E_ALL | E_STRICT);
        mb_internal_encoding('UTF-8');
        set_exception_handler(array($this, 'handleException'));
        spl_autoload_register(array($this, 'loadClass'));
    }

     /**
     * System config.   
     */
    public function init() {
       $this->startTime = $this->getmicrotime();       // Démarrage du chrono
       $this->init_context();
        // Chargement des properties dans une variable d'environnement       
        if(!isset($_ENV["properties"])){
            $configPath = $this->getPath()."config/config.ini";
            $confValue = LoadConfig::getInstance();
            $_ENV["properties"] = $confValue->getProperties($configPath);
        }
        TextStatic::defineLanguage();
        if(isset($_GET['resetLangue'])){TextStatic::reloadLanguage();}
    }

    /**
     * Charge le Header de la page 
     */
    public function getPage(){
        $page = $this->default_page;
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        return $page;
    }
    

    
    /**
     * Run the application!
     */
    public function run() {
        
        $this->runPage($this->getPage());
        //Applog::ecrireLog("Chargement de la page ".$this->getPage(),"info");
        // $this->getPage();
    }

    /**
     *
     * @param Theme $page
     * @param array $extra 
     */
    private function runPage($page, array $extra = array()) {
        $run = false;
        if ($this->hasScript($page)) {
            $run = true;
            require $this->getScript($page);
        }

        if (!$run) {
            echo ('Page "' . $page . '" has neither script nor template!');
        }
    }

    /**
     * Exception handler.
     */
    public function handleException(Exception $ex) {
        $extra = array('message' => $ex->getMessage());
        if ($ex instanceof NotFoundException) {
            header('HTTP/1.0 404 Not Found');
            $this->runPage('404', $extra);
        } else {
            // TODO log exception
            header('HTTP/1.1 500 Internal Server Error');
            $this->runPage('500', $extra);
        }
    }

    /**
     * Class loader.
     */
    public function loadClass($name) {

        $classes = array(
            'Main'                              =>  'services/Main.class.php',
            
            //TRAITEMENT
            'AjaxAction'                        => 'AjaxAction.class.php',
            'NewsletterAction'                  => 'services/NewsletterAction.class.php',
            'EvenementSearchCriteria'           => 'services/EvenementSearchCriteria.class.php',
            'OrganisateurSearchCriteria'        => 'services/OrganisateurSearchCriteria.class.php',
            'ThemesSearchCriteria'              => 'services/ThemesSearchCriteria.class.php',
            'TypesOrganisateurSearchCriteria'   => 'services/TypesOrganisateurSearchCriteria.class.php',
            'TypesEvenementSearchCriteria'      => 'services/TypesEvenementSearchCriteria.class.php',
            
            //TECHNIQUE
            'Query'                         => 'dao/Query.class.php',
            'NewsletterDao'                 => 'dao/NewsletterDao.class.php',
            'UtilDao'                       => 'dao/UtilDao.class.php',
            
            //API PUBLIC
            'Mailjet'                       => 'api/mailjet/php-mailjet.class-mailjet-0.1.php',
            'PHPMailer'                     => 'api/phpmailer/class.phpmailer.php',
            'Slim'                          => 'api/Slim/Slim.php',

            //UTILS
            'AppLog'                        => 'utils/AppLog.class.php',
            'LoadConfig'                    => 'utils/loadConfig.php',
            'TextStatic'                    => 'utils/TextStatic.php',
            'Redirect'                      => 'utils/redirect.php',
            'imageTreatment'                => 'utils/imageTreatment.php',
            'DownloadBinaryFile'            => 'utils/DownloadBinaryFile.class.php',
            'SecurityUtil'                  => 'utils/SecurityUtil.class.php',
            'UtilSession'                   => 'utils/UtilSession.class.php',
            'UtilMail'                      => 'utils/UtilMail.class.php',
            'UtilNavigateur'                => 'utils/UtilNavigateur.class.php',
            'Util'                          => 'utils/Util.class.php',

            //EXCEPTION
            'NotFoundException'             => 'exception/NotFoundException.php',

            //DAO
            'Db'                            => 'dao/Db.class.php',
            'UtilsDao'                      => 'dao/UtilsDao.class.php'

        );
       
        if (!array_key_exists($name, $classes)) {
            die('Class "' . $name . '" not found.');
        }
        
        require_once $this->getPath().$classes[$name];
        //AppLog::ecrireLog("get path : [".$this->getPath()."]", "debug");
    }



    /**
     * Vérification de la syntaxe des pages.
     * @param Theme $page
     * @return Theme
     * @throws NotFoundException 
     */
    private function checkPage($page) {
        if (!preg_match('/^[a-z0-9-]+$/i', $page)) {
            // TODO log attempt, redirect attacker, ...
            throw new NotFoundException('Unsafe page "' . $page . '" requested');
        }
        /** if (!$this->hasScript($page) && !$this->hasTemplate($page)) {
          // TODO log attempt, redirect attacker, ...
          throw new NotFoundException('Page "' . $page . '" not found');
          }* */
        return $page;
    }

    /**
     * Vérifie que la page existe avant de la charger
     * @param Theme $page
     * @return Theme 
     */
    private function hasScript($page) {
        return file_exists($this->getScript($page));
    }

    /**
     * Charge la page
     * @param Theme $page
     * @return Theme 
     */
    private function getScript($page) {
        return $this->page_dir . $page . '.php';
    }

    /**
     * Reset le chargement des classes auto.
     * @return string 
     */
    private function resetAutoload(){
        $_SESSION;
     }
     
     /**
      * Renvoi le tamps écoulé entre les 2 chronos
      */
     public function getChrono(){
         $this->endTime = $this->getMicroTime();
         return round( $this->endTime - $this->startTime, 3);
     }
     
    /**
    * Calcul le temps entre 2 marqueurs.
    * @return Number
    */ 
    private function getmicrotime(){  
        list($usec, $sec) = explode(" ",microtime());  
        return ((float)$usec + (float)$sec);  
    }
    
    public function getDefaultPage(){
        return $this->default_page;
    }



    /**
     * Récupérer l'arborescence 
     * @return string
     */
    public function getPath(){
        $path = "";
            $i = 0;

            while($i < $this->getLevel()){
                $path .= "../";
                $i++;
            }
        return $path;
    }
    
    public function setLevel($i){
        $this->level = $i;
    }

    public function getLevel(){
        return $this->level;
    }

    public function getId(){
        if(isset($_GET['id']) || isset($_POST['id'])){
            if(isset($_GET['id'])){
                $this->id = $_GET['id'];
            }else if(isset($_POST['id'])){
                $this->id = $_POST['id'];
            }
        }
        return $this->id;
    }
    
    public function getDefault_page() {
        return $this->default_page;
    }

    public function setDefault_page($default_page) {
        $this->default_page = $default_page;
    }

    public function getPage_dir() {
        return $this->page_dir;
    }

    public function setPage_dir($page_dir) {
        $this->page_dir = $page_dir;
    }

    public function getBooAdmin() {
        return $this->booAdmin;
    }

    public function setBooAdmin($booAdmin) {
        $this->booAdmin = $booAdmin;
    }
    public function getConnexion_page() {
        return $this->connexion_page;
    }

    public function setConnexion_page($connexion_page) {
        $this->connexion_page = $connexion_page;
    }
}