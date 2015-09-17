<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Medai
 *
 * @author J. Vidaillac
 */
class Media  {

    //Définition des constantes
    const K_table_media = 'med_medias';
    const K_table_organisateur = 'org_organisateurs';
    const K_undefinedAttribut = null;
    
    //Définition des attributs
    private $tabAttributs=array();
    private $attributsKeys=array();
    private $objOrganisateur;
   
    
    /**
    * @role Contructeur
    * @param array $tabMedia tableau contenant un media sous la forme
     *          $tabMedia[nom colonne] = valeur
     *          Si media vide creation de l'objet à vide.
     *          SI media chargé création de l'organisateur.
    * @author  J. Vidaillac
    */
    function __construct($tabMedia=null) {
        if ( !empty($tabMedia)){
            $this->attributsKeys = array_keys($tabMedia);
            foreach ($this->attributsKeys as $key )
                $this->tabAttributs[$key] = $tabMedia[$key];
            /*
             * on charge les informations associées à l'organisateur
             */
            $listOrganisateurs = Organisateur::recupererOrganisateur($this->tabAttributs['med_org_id']);
            foreach ($listOrganisateurs as $organisateur) {
                $this->objOrganisateur = new Organisateur($organisateur);
            }
        }
        else {
            $this->objOrganisateur = new Organisateur();
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

    /*
     * permet de récupérer l'objet organisateur associé à ce média
     */
    public function getObjOrganisateur() {
        return $this->objOrganisateur;
    }
    
    /**
    * @role Permet de sauvegarder un nouveau media
    * @param array $tabValeurs contient les valeurs à insérer
    *        à noter comme [nomColonne]=valeur
    * @author  J. Vidaillac
    */  
    public function ajouterMedia($tabValeurs) {
        $requete = new QueryBackEnd();
        $requete->preparerInsertTable(self::K_table_media,$tabValeurs);
        $requete->executeInsert();
        return $requete->checkExcutionSql();   
    }
    
        /**
    * @role Permet de modifier un media
    * @param array $valColonnes contient les valeurs à modifier
    *        à noter comme [nomColonne]=valeur
    * @param array $tabKeyValeur contient les cles permettant de désigner l'enregistrement à modifier
    *        à noter comme [nomColonne]=valeur
    * @author  J. Vidaillac
    */
    public function modifierMedia($tabKeyValeur,$valColonnes) {
        // récupération des paramètres encodés
        $requete = new QueryBackEnd();
        $requete->preparerModifierTable(self::K_table_media,$tabKeyValeur,$valColonnes);
        $requete->executeUpdate();
        return $requete->checkExcutionSql();
    }

    /**
    * @role Permet de supprimer un media
    * @param array $tabKeyValeur contient les cles permettant de désigner l'enregistrement à modifier
    *        à noter comme [nomColonne]=valeur
    * @author  J. Vidaillac
    */
    public function supprimerMedia($tabKeyValeur) {
        // récupération des paramètres encodés
        $requete = new QueryBackEnd();
        $requete->preparerSupprimerTable(self::K_table_media,$tabKeyValeur);
        $requete->executeDelete();
        return $requete->checkExcutionSql();
    }    
    
    public function getMedia4Json() {
        /*
         * on positionne la butée
         */
        /* chargement sous la forme d'un tableau du media */
        foreach ($this->attributsKeys as $key )
            $tabjson[$key] =$this->tabAttributs[$key] ;
        /*
         * chargement des informations de l'organisateur
         */
        $organisateur = $this->objOrganisateur;
        $organisateur->getOrganisateur4Json($tabjson);
        return $tabjson;
    }

}

?>
