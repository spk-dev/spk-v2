<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Message
 *
 * @author J. Vidaillac
 */
class Message  {

    //Définition des constantes
    const K_table_message = 'mes_messages';
    
    //Définition des attributs
    private $tabAttributs=array();
    private $attributsKeys=array();
   
    
    /**
    * @role Contructeur
    * @param array $tabMessage tableau contenant un message sous la forme
     *          $tabMessage[nom colonne] = valeur
     *          Si message vide creation de l'objet à vide.
     *          SI message chargé création de l'occurence + place.
    * @author  J. Vidaillac
    */
    function __construct($tabMesssage=null) {
        if ( !empty($tabMesssage)){
            $this->attributsKeys = array_keys($tabMesssage);
            foreach ($this->attributsKeys as $key )
                $this->tabAttributs[$key] = $tabMesssage[$key];
        }
    }    

    /**
    * méthodes de lecture/ecriture des attributs
    */
    public function getAttribut($attributKey) {
        if (array_key_exists($attributKey,$this->tabAttributs))
             return $this->tabAttributs[$attributKey];
        else
            return self:: K_undefinedAttribut;
    }
    
    /**
    * @role Permet de retourner la nouvelle valeur que si cette nouvelle valeur n'est pas vide
    * @param string $new nouvelle valeur
    * @param string $old ancienne valeur
    * @author  J. Vidaillac
    */
    private function setValue($new,$old) {
        return empty($new)?$old:$new;
    }

        /*
     * pemert de récupérer la réponse au message
     * @return objet objet message contenant la réponse
     */
    public static function getRootMessage() {
        $tabRootMessage = self::recupererMessage(array('mes_mes_id_liaison'=> 'null')); 
        return $tabRootMessage;
    }
    
    /*
     * pemert de récupérer la réponse au message
     * @return objet objet message contenant la réponse
     */
    public function getReponseMessage() {
        $idReponse = $this->getAttribut('mes_mes_id_liaison');
        if ( !empty($idReponse ))
            return new Message($this->recupererMessage(array('mes_mes_id_liaison'=> $idReponse))); 
        else
            return new message();
    }
    
    /*
     * permet de récupérer le nombre de messages non lu
     */
   public function getNbMessageNonRepondu()
   {
        $requete = new QueryBackEnd();
        $tabCriteresRecherche = array('mes_boo_etat_lecture'=>'false');
        /* récupérer tous les évenements (defaut) ordonnés par libellé (defaut) */
        $requete->preparerSelectTable(self::K_table_message,$tabCriteresRecherche,$extendSql);
        return count($requete->executeSelect());
   }
    /**
    * @role Permet de sauvegarder un message
    * @param array $tabValeurs contient les valeurs à insérer
    *        à noter comme [nomColonne]=valeur
    * @author  J. Vidaillac
    */  
    public function AjouterMessage($tabValeurs) {
        $requete = new Query();
        $requete->preparerInsertTable(self::K_table_message,$tabValeurs);
        $requete->executeInsert();
        return $requete->checkExcutionSql();   
    }
    
        /**
    * @role Permet de modifier un message
    * @param array $valColonnes contient les valeurs à modifier
    *        à noter comme [nomColonne]=valeur
    * @param array $tableKeyValeur contient les cles permettant de désigner l'enregistrement à modifier
    *        à noter comme [nomColonne]=valeur
    * @author  J. Vidaillac
    */
    public function ModifierMessage($tableKeyValeur,$valColonnes) {
        // récupération des paramètres encodés
        $requete = new Query();
        $requete->preparerModifierTable(self::K_table_message,$tableKeyValeur,$valColonnes);
        $requete->executeUpdate();
        return $requete->checkExcutionSql();
    }

        
        /**
    * @role Permet de supprimer un message
    * @param array $valColonnes contient les valeurs à modifier
    *        à noter comme [nomColonne]=valeur
    * @param array $tableKeyValeur contient les cles permettant de désigner l'enregistrement à modifier
    *        à noter comme [nomColonne]=valeur
    * @author  J. Vidaillac
    */
    public function SupprimerMessage($tableKeyValeur) {
        // récupération des paramètres encodés
        $requete = new Query();
        $requete->preparerSupprimerTable(self::K_table_message,$tableKeyValeur);
        $requete->executeDelete();
        return $requete->checkExcutionSql();
    }
    /*
     * Permet de charger un message
     */
    public function recupererMessage( array $tabCriteresRecherche,
                                             $extendSql=' order by mes_date_emission') {
        $requete = new QueryBackEnd();
        /* récupérer tous les évenements (defaut) ordonnés par libellé (defaut) */
        $requete->preparerSelectTable(self::K_table_message,$tabCriteresRecherche,$extendSql);
        $tabEnregistrements = $requete->executeSelect();
        return $tabEnregistrements;
    }
    
    
    public function getMessage4Json() {
        /*
         * on positionne la butée
         */
        /* chargement sous la forme d'un tableau de l'occurence */
        foreach ($this->attributsKeys as $key )
            $tabjson[$key] =$this->tabAttributs[$key] ;
        return $tabjson;
    }

}

?>
