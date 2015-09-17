<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Evenement
 *
 * @author J. Vidaillac
 */
class Evenement {
    
    //Définition des constantes
    const K_premierMedia = 0;
    const K_table_evenement = 'eve_evenements';
    const K_table_occurence = 'ocu_occurrences';
    const K_table_typeEvenement = 'tev_type_evenements';
    const K_table_media = 'med_medias';
    const K_cleTypeEvenement = 'eve_tev_int_id';
    const K_undefinedAttribut = 'Champ inconnu';
    const K_precedent = 1;
    const K_suivant = 0;
    const K_butee_on = true;
    const K_butee_off = false;
    

    //Définition des attributs
    
    private $tabAttributs=array();
    private $attributsKeys=array();
    private $objTypeEvenement;
    private $objOrganisateur;
    private $objTagEvenement;
    private $tabObjMedia=array();
    private $tabOccurences=array();
    private $positionOccurence;
    private $positionMedia;    
    /**
    * @role Contructeur
    * @param array $evenement tableau contenant un evenement sous la forme
     *          $evenement[nom colonne] = valeur
     *          Si evenement vide creation de l'objet à vide.
     *          SI evenement chargé création de l'évènement + occurences + Média.
    * @author  J. Vidaillac
    */
    function __construct($evenement) {
        if ( !empty($evenement))
        {
            /*
             * on charge les attributs
             */
            $this->attributsKeys = array_keys($evenement);
            foreach ($this->attributsKeys as $key )
                $this->tabAttributs[$key] = $evenement[$key];
            /*
             * on charge les occurences
             */
            $this->chargerOccurences();
            /*
             * on charge les occurences
             */
            $this->chargerMedias();
        }
        $this->positionOccurence=0;
        $this->positionMedia=0;

    }
   /*
    * liste des méthodes permettant de lire  Ou ecrire les attributs
    */
    public function getAttribut($attributKey) {
        if (array_key_exists($attributKey,$this->tabAttributs))
             return $this->tabAttributs[$attributKey];            
        else
            return self::K_undefinedAttribut;
    }
    /*
     * permet de récuperer le libellé d'un type d'événement;
     * @return array ['tev_var_libelle'] et [tev_var_description]
     */
    public function getLibelleTypeEvenement() {
        if ( !empty($this->tabAttributs[self::K_cleTypeEvenement]))
        {
            $requete = new QueryBackEnd();
            $tabCriteresRecherche =array(self::K_cleTypeEvenement=>$this->tabAttributs[eve_self::K_cleTypeEvenement]);
            /* récupérer tous les évenements (defaut) ordonnés par libellé (defaut) */
            $requete->preparerSelectTable(self::K_table_typeEvenement,$tabCriteresRecherche);
            $tabEnregistrements = $requete->executeSelect();
        }
        return $tabEnregistrements['tev_var_libelle'];
    }

    public function getOrganisateur() {
        if ( empty($this->objOrganisateur)) 
          $this->objOrganisateur = new Organisateur($this->organisateurId); 
        return $this->objOrganisateur;
    }
    /*
     * permet de récupérer le premier media enregistré
     */
    public function getObjPremierMedia(){
        return $this->$tabObjMedia[self::K_premierMedia];
    }
    
    /*
     * permet de récupérer l'url d'un media 
     */
    public function getUrlMedia($position=self::K_premierMedia){
        if ( !empty($this->media[$position]))
            return $this->media[$position]->getAttribut('med_var_url');
        else
            return null;
    }


    public function getlistTags() {
        if ( empty($this->objTagEvenement)) 
        $this->objTagEvenement = new TagEvenement($this->idEvenement);
        return $this->objTagEvenement->getListeMots();
    }
    
        

    public static function recupererEvenements( array $tabCriteresRecherche,
                                                $extendSql=' order by eve_var_libelle') {
        $requete = new QueryBackEnd();
        /* récupérer tous les évenements (defaut) ordonnés par libellé (defaut) */
        $requete->preparerSelectTable(self::K_table_evenement,$tabCriteresRecherche,$extendSql);
        $tabEnregistrements = $requete->executeSelect();
        return $tabEnregistrements;
    }
     
    
    /**
    * @role Récupérer de charger le tableau d'occurences associé à l'événement courant
    * @param array $tabCriteresRecherche crtitères de recherche
     *          $tabCriteresRecherche[nom colonne] = valeur
     *          $extendSql complément sql qui vient s'ajouter en fin d'ordre ( utilisé pour le order by ou autre)
    * @author  J. Vidaillac
    */
    public function chargerOccurences() {
        $requete = new QueryBackEnd();
        /* récupérer tous les évenements (defaut) ordonnés par libellé (defaut) */
        $tabCriteresRecherche = array( 'ocu_eve_id'=>$this->getAttribut('eve_int_id'));
        $requete->preparerSelectTable(self::K_table_occurence,$tabCriteresRecherche,'');
        $tabOccurences = $requete->executeSelect();
        foreach ($tabOccurences as $occurence )
        {
            $this->tabOccurences[] = new Occurence($occurence);
        }
        if ( count($this->tabOccurences) ==  0)
            $this->tabOccurences[] = new Occurence();
        $this->positionOccurence=0;
    }
    
    public function isButeeOccurence()
    {
        if ( $this->positionOccurence <=0 || $this->positionOccurence >= count($this->tabOccurences) )
            return true;
        else
            return false;
    }

    /**
    * @role Permet de récupérer l'occurence suivante si elle existe
    * @return objet occurence sinon la dernière possible
    * @author  J. Vidaillac
    */
    public function getOccurenceSuivante() {
        $position = $this->positionOccurence>=count($this->tabOccurences)?(count($this->tabOccurences)):++$this->positionOccurence;
        $occurence = $this->tabOccurences[$position]; 
        return $occurence;
    }

    /**
    * @role Permet de récupérer l'occurence précédente si elle existe
    * @return objet occurence sinon la première 
    * @author  J. Vidaillac
    */
    public function getOccurencePrecedente() {
        $position = $this->positionOccurence<=0?0:--$this->positionOccurence;
        $occurence = $this->tabOccurences[$position];
        return $occurence;
    }
    
    /**
    * @role Permet de récupérer l'occurence correspondant au pointeur courant pour l'événement courant
    * @return objet occurence
    * @author  J. Vidaillac
    */
    public function getOccurenceCourante() {
        $occurence = $this->tabOccurences[$this->positionOccurence]; 
        return $occurence;
    }
    
    /**
    * @role Permet de récupérer la prochaine date à partir de la date courant pour l'événement courant
    * @return objet occurence
    * @author  J. Vidaillac
    */
    public function getNextOccurenceDate() {
        $dateEligible ='Pas d\'occurence';
        foreach ($this->tabOccurences as $key => $objOcc){  
            $tabDate[] = $objOcc->getDateDebut();
        }    
        asort($tabDate);
        foreach ($tabDate as $curDate) {
            if ( $curDate >= date('Y-m-d H:i:s') ) {
                $dateEligible = $curDate;
                break;
            }
        }
        return $dateEligible;
    }

    /**
    * @role Permet de récupérer le nombre d'occurence d'un événement.
    * @return int nb d'occurence;
    * @author  J. Vidaillac
    */    
    public function getNbOccurence()
    {
        return count($this->tabOccurences);
    }

    
        
    /**
    * @role Permet de charger le tableau des medias associés à l'événement courant
    * @param array $tabCriteresRecherche crtitères de recherche
     *          $tabCriteresRecherche[nom colonne] = valeur
     *          $extendSql complément sql qui vient s'ajouter en fin d'ordre ( utilisé pour le order by ou autre)
    * @author  J. Vidaillac
    */
    public function chargerMedias() {
        $requete = new QueryBackEnd();
        /* récupérer tous les media (defaut) ordonnés par libellé (defaut) */
        $tabCriteresRecherche = array( 'med_eve_id'=>$this->getAttribut('eve_int_id'));
        $requete->preparerSelectTable(self::K_table_media,$tabCriteresRecherche,'');
        $tabMedias = $requete->executeSelect();
        foreach ($tabMedias as $media )
        {
            $this->tabObjMedia[] = new Media($media);
        }
        if ( count($this->tabObjMedia) ==  0)
            $this->tabObjMedia[] = new Media();
        $this->positionMedia=0;
    }
    
        /**
    * @role Permet de récupérer le media suivante si il existe
    * @return objet media sinon le dernier possible
    * @author  J. Vidaillac
    */
    public function getMediaSuivant() {
        $position = $this->positionMedia>=count($this->tabObjMedia)?(count($this->tabObjMedia)-1):++$this->positionMedia;
        $media = $this->tabObjMedia[$position]; 
        return $media;
    }

    /**
    * @role Permet de récupérer le media précédente si il existe
    * @return objet media sinon le premier 
    * @author  J. Vidaillac
    */
    public function getMediaPrecedent() {
        $position = $this->positionMedia<=0?0:--$this->positionMedia;
        $media = $this->tabObjMedia[$position];
        return $media;
    }
    
    /**
    * @role Permet de récupérer le media correspondant au pointeur courant pour l'événement courant
    * @return objet media
    * @author  J. Vidaillac
    */
    public function getMediaCourant() {
        $media = $this->tabObjMedia[$this->positionMedia]; 
        return $media;
    }
    
    public function isButeeMedia()
    {
        if ( $this->positionMedia <=0 || $this->positionMedia >= count($this->tabObjMedia) )
            return true;
        else
            return false;
    }
    /**
    * @role Permet de récupérer un Evénement
    * @param array $data contient les critères de sélection
    *        à noter comme [nomColonne]=valeur
    * @param array $tableKeyValeur contient les cles permettant de désigner l'enregistrement à modifier
    *        à noter comme [nomColonne]=valeur
    * @author  J. Vidaillac
    */
    public function RecupererEvenement($tabCriteresRecherche) {   
        $requete = new QueryBackEnd();
        $requete->preparerSelectTable(self::K_table_evenement,$tabCriteresRecherche);
        $tabEnregistrements = $requete->executeSelect();
        foreach ($tabEnregistrements as $evenement)
        {
            $this->tabOccurences[] = new Occurence($occurence);
        }
        if ( count($this->tabOccurences) ==  0)
            $this->tabOccurences[] = new Occurence();
        $this->positionOccurence=0;
        return $tabEnregistrements;
    }    

    /**
    * @role Permet de sauvegarder un Evénement
    * @param array $tabValeurs contient les valeurs à insérer
    *        à noter comme [nomColonne]=valeur
    * @author  J. Vidaillac
    */  
    public function AjouterEvenement($tabValeurs) {
        $requete = new QueryBackEnd();
        $requete->preparerInsertTable(self::K_table_evenement,$tabValeurs);
        $requete->executeInsert();
        return $requete->checkExcutionSql();
    }

    /**
    * @role Permet de modifier un Evénement
    * @param array $valColonnes contient les valeurs à modifier
    *        à noter comme [nomColonne]=valeur
    * @param array $tableKeyValeur contient les cles permettant de désigner l'enregistrement à modifier
    *        à noter comme [nomColonne]=valeur
    * @author  J. Vidaillac
    */
    public function ModifierEvenement($tableKeyValeur,$valColonnes) {
        // récupération des paramètres encodés
        $requete = new QueryBackEnd();
        $requete->preparerModifierTable(self::K_table_evenement,$tableKeyValeur,$valColonnes);
        $requete->executeUpdate();
        return $requete->checkExcutionSql();
    }
    /**
    * @role Permet de modifier un Evénement
    * @param array $valColonnes contient les valeurs à modifier
    *        à noter comme [nomColonne]=valeur
    * @param array $tableKeyValeur contient les cles permettant de désigner l'enregistrement à modifier
    *        à noter comme [nomColonne]=valeur
    * @author  J. Vidaillac
    */
    
    public function SupprimerEvenement($tableKeyValeur) {
        // récupération des paramètres encodés
        $requete = new QueryBackEnd();
        $requete->preparerSupprimerTable(self::K_table_evenement,$tableKeyValeur);
        $requete->executeDelete();
        return $requete->checkExcutionSql();
    }}
