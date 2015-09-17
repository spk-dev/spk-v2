<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of organisateur
 *
 * @author xpdf585
 */
class Organisateur {
    //Définition des constantes
    const K_table_organisateur = 'org_organisateurs';
    const K_undefinedAttribut = 'Champ inconnu';
        
    //Définition des attributs
    private $tabAttributs=array();
    private $attributsKeys=array();

        /**
    * @role Contructeur
    * @param array $tabPlace tableau contenant une place sous la forme
     *          $tabOccurence[nom colonne] = valeur
     *          Si $tabPlace vide creation de l'objet à vide.
     *          SI $tabPlace chargé création de la place.
    * @author  J. Vidaillac
    */
    function __construct($tabOrganisateur=null) {
        if (!empty($tabOrganisateur)) {
            $this->attributsKeys = array_keys($tabOrganisateur);
            foreach ($this->attributsKeys as $key )
                $this->tabAttributs[$key] = $tabOrganisateur[$key];
        }
    }

    public function getAttribut($attributKey) {
        if (array_key_exists($attributKey,$this->tabAttributs))
             return $this->tabAttributs[$attributKey];
        else
            return self:: K_undefinedAttribut;
    }
    /**
    * @role Permet de récupérer l'organisateur associé à un objet
    * @param int identifiant de l'organisateur demandé
    * @return array tableau des organisateurs 
    * @author  J. Vidaillac
    */
    public static function recupererOrganisateur($organisateurId) {
        $tabEnregistrements = array();
        if (!empty($organisateurId))
        {
            $requete = new QueryBackEnd();
            $tabCriteresRecherche= array('org_int_id'=>$organisateurId);
            $requete->preparerSelectTable(self::K_table_organisateur,$tabCriteresRecherche);
            $tabEnregistrements = $requete->executeSelect();
        }
        return $tabEnregistrements;        
    }
    
    /**
    * @role Permet de remplir le tableau des organisateurs
    * @param reference $tabObjet tableau à remplir
    * @author  J. Vidaillac
    */    
    public function getOrganisateur4Json (&$tabObjet)
    {
        foreach ($this->attributsKeys as $key )
            $tabObjet[$key] =$this->tabAttributs[$key] ;
    }
    
    /**
    * @role Permet de sauvegarder un organisateur
    * @param array $tabValeurs contient les valeurs à insérer
    *        à noter comme [nomColonne]=valeur
    * @author  J. Vidaillac
    */  
    public function ajouterOrganisateur($tabValeurs) {
        $requete = new QueryBackEnd();
        $requete->preparerInsertTable(self::K_table_organisateur,$tabValeurs);
        $requete->executeInsert();
        return $requete->checkExcutionSql();
    }

    /**
    * @role Permet de modifier un organisateur
    * @param array $valColonnes contient les valeurs à modifier
    *        à noter comme [nomColonne]=valeur
    * @param array $tableKeyValeur contient les cles permettant de désigner l'enregistrement à modifier
    *        à noter comme [nomColonne]=valeur
    * @author  J. Vidaillac
    */
    public function modifierOrganisateur($tableKeyValeur,$valColonnes) {
        // récupération des paramètres encodés
        $requete = new QueryBackEnd();
        $requete->preparerModifierTable(self::K_table_organisateur,$tableKeyValeur,$valColonnes);
        $requete->executeUpdate();
        return $requete->checkExcutionSql();
    }

    
    /**
    * @role Permet de supprimer un organisateur
    * @param array $tableKeyValeur contient les cles permettant de désigner l'enregistrement à modifier
    *        à noter comme [nomColonne]=valeur
    * @author  J. Vidaillac
    */
    public function supprimerOrganisateur($tableKeyValeur) {
        // récupération des paramètres encodés
        $requete = new QueryBackEnd();
        $requete->preparerSupprimerTable(self::K_table_organisateur,$tableKeyValeur);
        $requete->executeDelete();
        return $requete->checkExcutionSql();
    }

    
    
    }
