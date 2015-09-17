<?php

/**
 * Description of Place
 *
 * @author J. Vidaillac
 */
class Place {
    //Définition des constantes
    const K_table_place = 'pla_places';
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
    function __construct($tabPlace=null) {
        if (!empty($tabPlace)) {
            $this->attributsKeys = array_keys($tabPlace);
            foreach ($this->attributsKeys as $key )
                $this->tabAttributs[$key] = $tabPlace[$key];
        }
    }

    public function getAttribut($attributKey) {
        if (array_key_exists($attributKey,$this->tabAttributs))
             return $this->tabAttributs[$attributKey];
        else
            return self:: K_undefinedAttribut;
    }
    
    /**
    * @role Permet de récupérer la palce associée à une occurence
    * @param array $tabOccurence tableau contenant un evenement sous la forme
     *          $tabOccurence[nom colonne] = valeur
     *          Si evenement vide creation de l'objet à vide.
     *          SI evenement chargé création de l'occurence + place.
    * @author  J. Vidaillac
    */
    public static function recupererPlace($placeId) {
        $requete = new QueryBackEnd();
        $tabCriteresRecherche= array('pla_int_id'=>$placeId);
        $requete->preparerSelectTable(self::K_table_place,$tabCriteresRecherche);
        $tabEnregistrements = $requete->executeSelect();
        return $tabEnregistrements;        
    }
    
    /**
    * @role Permet de charger le tableau de la place
    * @param reference $tabPlace tableau à remplir
    * @author  J. Vidaillac
    */    
    public function getPlace4Json (&$tabPlace)
    {
        foreach ($this->attributsKeys as $key )
            $tabPlace[$key] =$this->tabAttributs[$key] ;
    }
    
    /**
    * @role Permet de sauvegarder une place
    * @param array $tabValeurs contient les valeurs à insérer
    *        à noter comme [nomColonne]=valeur
    * @author  J. Vidaillac
    */  
    public function ajouterPlace($tabValeurs) {
        $requete = new QueryBackEnd();
        $requete->preparerInsertTable(self::K_table_place,$tabValeurs);
        $requete->executeInsert();
        return $requete->checkExcutionSql();
    }

    /**
    * @role Permet de modifier une palce
    * @param array $valColonnes contient les valeurs à modifier
    *        à noter comme [nomColonne]=valeur
    * @param array $tableKeyValeur contient les cles permettant de désigner l'enregistrement à modifier
    *        à noter comme [nomColonne]=valeur
    * @author  J. Vidaillac
    */
    public function modifierPlace($tableKeyValeur,$valColonnes) {
        // récupération des paramètres encodés
        $requete = new QueryBackEnd();
        $requete->preparerModifierTable(self::K_table_place,$tableKeyValeur,$valColonnes);
        $requete->executeUpdate();
        return $requete->checkExcutionSql();
    }

    
    /**
    * @role Permet de supprimer une place
    * @param array $tableKeyValeur contient les cles permettant de désigner l'enregistrement à modifier
    *        à noter comme [nomColonne]=valeur
    * @author  J. Vidaillac
    */
    public function supprimerPlace($tableKeyValeur) {
        // récupération des paramètres encodés
        $requete = new QueryBackEnd();
        $requete->preparerSupprimerTable(self::K_table_place,$tableKeyValeur);
        $requete->executeDelete();
        return $requete->checkExcutionSql();
    }

}
