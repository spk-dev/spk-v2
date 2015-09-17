<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Occurence
 *
 * @author J. Vidaillac
 */
class Occurence  {

    //Définition des constantes
    const K_table_occurence = 'ocu_occurrences';
    const K_table_place = 'pla_places';
    const K_undefinedAttribut = 'Champ inconnu';
    const K_precedent = 1;
    const K_suivant = 0;
    
    //Définition des attributs
    private $tabAttributs=array();
    private $attributsKeys=array();
    private $objPlace;
   
    
    /**
    * @role Contructeur
    * @param array $tabOccurence tableau contenant un evenement sous la forme
     *          $tabOccurence[nom colonne] = valeur
     *          Si evenement vide creation de l'objet à vide.
     *          SI evenement chargé création de l'occurence + place.
    * @author  J. Vidaillac
    */
    function __construct($tabOccurence=null) {
        if ( !empty($tabOccurence)){
            $this->attributsKeys = array_keys($tabOccurence);
            foreach ($this->attributsKeys as $key )
                $this->tabAttributs[$key] = $tabOccurence[$key];

            $listPlace = Place::recupererPlace($this->tabAttributs['ocu_pla_id']);
            foreach ($listPlace as $place) {
                $this->objPlace = new Place($place);
            }
        }
        else {
            $this->objPlace = new Place();
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

    public function getPlace() {
        return $this->objPlace;
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

    
    /**
    * @role Permet de sauvegarder un Evénement
    * @param array $tabValeurs contient les valeurs à insérer
    *        à noter comme [nomColonne]=valeur
    * @author  J. Vidaillac
    */  
    public function AjouterOccurence($tabValeurs) {
        $requete = new Query();
        $requete->preparerInsertTable(self::K_table_occurence,$tabValeurs);
        $requete->executeInsert();
        return $requete->checkExcutionSql();   
    }
    
        /**
    * @role Permet de modifier une Occurence
    * @param array $valColonnes contient les valeurs à modifier
    *        à noter comme [nomColonne]=valeur
    * @param array $tableKeyValeur contient les cles permettant de désigner l'enregistrement à modifier
    *        à noter comme [nomColonne]=valeur
    * @author  J. Vidaillac
    */
    public function ModifierOccurence($tableKeyValeur,$valColonnes) {
        // récupération des paramètres encodés
        $requete = new Query();
        $requete->preparerModifierTable(self::K_table_occurence,$tableKeyValeur,$valColonnes);
        $requete->executeUpdate();
        return $requete->checkExcutionSql();
    }

        
        /**
    * @role Permet de supprimer une Occurence
    * @param array $valColonnes contient les valeurs à modifier
    *        à noter comme [nomColonne]=valeur
    * @param array $tableKeyValeur contient les cles permettant de désigner l'enregistrement à modifier
    *        à noter comme [nomColonne]=valeur
    * @author  J. Vidaillac
    */
    public function SupprimerOccurence($tableKeyValeur) {
        // récupération des paramètres encodés
        $requete = new Query();
        $requete->preparerSupprimerTable(self::K_table_occurence,$tableKeyValeur);
        $requete->executeDelete();
        return $requete->checkExcutionSql();
    }

    
    public function getOccurence4Json() {
        /*
         * on positionne la butée
         */
        /* chargement sous la forme d'un tableau de l'occurence */
        foreach ($this->attributsKeys as $key )
            $tabjson[$key] =$this->tabAttributs[$key] ;
        /*
         * chargement des informations de localisation
         */
        $place = $this->objPlace;
        $place->getPlace4Json($tabjson);
        return $tabjson;
    }

}

?>
