<?php


/**
 * liste des requetes
 *
 * @author Ben
 */
class Query {
    
    private $condition;
    private $requete;
    private $tableName;
    private $columns;
    private $valuesColumn;
    private $clesPrimaire;  
    const K_getNomColonne = 'col';
    const K_getValColonne = 'val';
    const K_getTypColonne = 'typ';
    const K_getManColonne = 'man';
    const K_update = 'UPDATE';
    const K_insert = 'INSERT';
    const K_delete = 'DELETE';
    const K_clePrimaire = 'PRI';
    const K_typeDateTime = 'datetime';
    const K_typeVarchar = 'varchar';
    const K_typeText = 'text';
    const K_nullable = 'YES';
    const K_modeUpdate = false;
    const K_modeInsert = true;
    
    function __construct($condition=null){
        $this->setCondition($condition);
    }
    
    public function setCondition($condition){
        if (empty($this->condition))
            $this->condition = " Where 1=1 ";
        if (! empty($condition) ) {
            $this->condition .= $condition;
        }
        else {
            $this->condition =null;
        }
    }
    public function setRequete($sql) {
        $this->requete=$sql;
    }
    
    public function executeInsert() {
        return UtilsDao::getInstance()->executeInsert($this->requete);
    }
    
    public function executeQuery() {
        return UtilsDao::getInstance()->executeRequete($this->requete);
    }
    
    public function setTableName($tableName) {
        $this->tableName=$tableName;
    }
    
    public function setColonnesPrimaryKey($valeurs) {
        $sql = "SELECT column_name as 'entete_colonne' FROM information_schema.columns"
                . " WHERE table_name = '". $this->tableName."' and column_key = '".self::K_clePrimaire."'";
        $this->setRequete($sql);
        $tableResults = $this->executeQuery();
        foreach ($tableResults as $result) {
            $this->clesPrimaire[$result['entete_colonne']][self::K_getNomColonne] = $result['entete_colonne'];
            $this->clesPrimaire[$result['entete_colonne']][self::K_getValColonne] = $valeurs[$result['entete_colonne']];
        }
    }
 
    public function setColumnList() {
        $sql = "SELECT column_name as 'entete_colonne',data_type,is_nullable FROM information_schema.columns"
                . " WHERE table_name = '". $this->tableName."' and column_key <> 'PRIM'";
        $this->setRequete($sql);
        $tableResults = $this->executeQuery();
        $index=0;
        foreach ( $tableResults as $result)
        {
            $this->columns[$index][self::K_getNomColonne] = $result['entete_colonne'];
            $this->columns[$index][self::K_getManColonne] = $result['is_nullable']==K_nullable?true:false;
            $this->columns[$index++][self::K_getTypColonne] = $result['data_type'];
        }
        ksort($this->column);
    }
    
    public function formatValue($colonneName,$valeur)
    {
        foreach ($this->columns as $colonne)
        {
            if ( $colonne[self::K_getNomColonne] == $colonneName)
            {
                switch ($colonne[self::K_getTypColonne]) {
                    case self::K_typeDateTime :
                        $valeurFormat = 'strtotime('.$valeur.')';
                        break 2;
                    case self::K_typeText :
                    case self::K_typeVarchar :
                        $valeurFormat = "'".$valeur."'";
                        break 2;
                    default:
                        $valeurFormat = $valeur;
                        break 2;
                }
            }
        }
        return $valeurFormat;
    }

    public function setvaluesList($tabValues,$completerList) {
        foreach ($this->columns as $colonne)
        {
                if (array_key_exists($colonne[self::K_getNomColonne],$tabValues))
                {
                    $this->valuesColumn[$colonne[self::K_getNomColonne]]=$this->formatValue($colonne[self::K_getNomColonne],
                                                                                            $tabValues[$colonne[self::K_getNomColonne]]);
                }
                elseif ( $completerList )
                    $this->valuesColumn[$colonne[self::K_getNomColonne]]=($colonne[self::K_getTypColonne]?'null':"''");
        }
        ksort($this->valuesColumn);
    }
    
    public function setWhereKey()
    {
        foreach ($this->clesPrimaire as $cle)
        {
            $condition .= " AND ".$cle[self::K_getNomColonne]." =".$cle[self::K_getValColonne]; 
        }
        $this->setCondition($condition);
    }
    

    public function preparerInsertTable($tableName,$valColonnes) {
        /*
         * Identification de la table concernée
         */
        $this->setTableName($tableName);
        /*
         * récupération des colonnes
         */
        $this->setColumnList();     
        /*
         * chargement des données à insérer
         */
        $this->setvaluesList($valColonnes);

        /*
         * Création de l'ordre SQL
         */
        $tempoSql = "Insert into ". $this->tableName;
        foreach ($this->columns as $colonne)
        {
            $listColonnes .= $colonne[self::K_getNomColonne].',';
            $listValues .= $this->valuesColumn[$colonne[self::K_getNomColonne]].',';
        }
        $tempoSql .=  " (".substr($listColonnes, 0, -1).")";
        $tempoSql .= " values (".substr($listValues, 0, -1).")";
        $this->requete = $tempoSql;
    }
    
    public function preparerModifierTable($tableName,$tableKeyValeur,$valColonnes) {
        /*
         * On se positionne sur la table à modifier
         */
        $this->setTableName($tableName);
        /*
         * on charge les cles primaire de la table
         */
        $this->setColonnesPrimaryKey($tableKeyValeur);
        /*
         * on charge les colonnes de la table
         */
        $this->setColumnList(self::K_modeUpdate);     
        /*
         * On charge les valeurs à mettre à jour
         */
        $this->setvaluesList($valColonnes,self::K_modeUpdate);
        
        /*
         * création de l'ordre SQL
         */
        $tempoSql = "update ". $this->tableName. " set ";
        foreach (array_keys($this->valuesColumn) as $key ) {
            $listColonnes .=  $key."=".$this->valuesColumn[$key].",";
        }
        $tempoSql .=  substr($listColonnes, 0, -1);
        $tempoSql .= " where 1=1 ";
        $liskeys = array_keys($this->clesPrimaire);
        foreach ($liskeys as $key) {
            $tempoSql .= "and ".$key." =".$this->clesPrimaire[$key][self::K_getValColonne];
        }
        $this->sql = $tempoSql;
    }
    
            
    
    
    public function setInsertSql() {

    }
    
    
    public function setUpdateSql() {

    }           
    /*
     * permet de récupérer les évènements avec ou sans occurence
     *  * @param boolean $avecOccurence vrai si on veut récupérer les évènements avec occurences
     */
    public function getListeEvenements($condition=null,$avecOccurence=false) {
            $this->setCondition($condition);
            $this->requete = "select distinct * from eve_evenements ";
            if ($avecOccurence ) {
                $this->requete .= "right join ocu_occurrences on eve_int_id = ocu_eve_id ";
            }
            $this->requete .= $this->condition.";";
    }
    
    /**
     * Renvoi la liste des événements ayant au moins 1 occurence
     * @param type $condition
     * @return string
     */
    public function getListeEvenements_benjamin(){
        $sql = " SELECT 
                    ocu_int_id, ocu_date_debut, ocu_date_fin,
                    eve_var_libelle, eve_org_int_id, 
                    tev_int_id, tev_var_libelle, 
                    pla_var_ville, pla_dec_lat, pla_dec_long,pla_var_route,pla_int_cp,
                    org_int_id, org_var_libelle,
                    med_var_url
                
                FROM eve_evenements 
                    right join ocu_occurrences on eve_int_id = ocu_eve_id 
                    left join tev_type_evenements on tev_int_id = eve_tev_int_id 
                    left join pla_places on pla_int_id = ocu_pla_id 
                    left join org_organisateurs on eve_org_int_id = org_int_id 
                    left join med_medias on med_eve_id = ocu_eve_id
                WHERE 1=1
                AND
                (med_int_id is NULL
                OR
                med_int_id < 2) ".$condition.";";
        
        AppLog::ecrireLog("dans query - getlisteEvenement ".$sql, "debug");
        
        return $sql;
    }

    /**
     * Renvoi la liste des organisateurs
     * @param type $condition
     * @return string
     */
    public function getListeOrganisateurs($condition = ""){
        $this->requete = "SELECT *
                          FROM org_organisateurs
                          WHERE 1=1 ".$condition.";";

    }
    
    /**
     * liste les événments
     * @param boolean $avecEvenement si liste des types utilisés ou non
     */
    public function getListeTypeEvenement($avecEvenement=false){
        if($avecEvenement){
            $this->requete ="SELECT  distinct(tev_int_id), tev_var_libelle
                FROM eve_evenements 
                right join ocu_occurrences on eve_int_id = ocu_eve_id 
                left join tev_type_evenements on tev_int_id = eve_tev_int_id 
                left join pla_places on pla_int_id = ocu_pla_id 
                left join org_organisateurs on eve_org_int_id = org_int_id ";
        }else{
            $this->requete = "select * from tev_type_evenements ";
        }
        $this->requete .= $this->condition;
    }
    
    public function getTagsEvenement () {
            $this->requete ="SELECT  *
                FROM tag_tags 
                right join tae_tag_evenement on tae_tag_id = tag_int_id ";
    }
    /**
     * Renvoi la liste des Themes d'événements
     * @param type $avecEvenement
     * @return string
     */
    public function getListeThemeEvenement($avecEvenement){
        if($avecEvenement){
            $sql = "SELECT the_int_id, the_var_libelle, count(tho_ocu_id) as 'nb' 
                    FROM the_theme 
                    right join tho_themes_occurence on the_int_id = tho_the_id 
                    group by the_int_id;";
        }else{
            $sql = "SELECT the_int_id, the_var_libelle FROM the_theme;";
           
        }
        return $sql;
    }


    /**
     * Renvoi les données completes d'un évenement
     * @param type $id
     * @return string
     */
    public function getEvenement($id){
        $sql = "SELECT * FROM eve_evenements WHERE eve_int_id = ".$id;
        
        return $sql;
        
    }
    
    /**
     * Renvoi les données complètes d'un organisateur
     * @param type $id
     * @return string
     */
    public function getOrganisateur(){
         $this->requete  = "select * from org_organisateurs" . $this->condition.";";
    }
    
    public function getPays(){
        $sql = "SELECT distinct(pla_var_pays) FROM pla_places;";
        return $sql;
    }
    
    
    public function getArea1($q){
        $sql = "SELECT distinct(pla_var_area1) FROM pla_places WHERE  pla_var_pays LIKE ('%".$q."%');";
        return $sql;
    }
    
    
    public function getArea2($area1){
        $sql = "SELECT distinct(pla_var_area2) FROM pla_places WHERE  pla_var_area1 LIKE ('%".$area1."%');";
        return $sql;
    }
    
    
    public function getMedia() {
        $this->requete ="SELECT med_medias.* from med_medias". $this->condition.";";
    }
    
    public function getListOccurence($condition=null,$avecEvenement=false) {
        $this->setCondition($condition);
        $this->requete ="SELECT ocu_occurrences.* from ocu_occurrences ";
        if ($avecEvenement ) {
            $this->requete .= "right join eve_evenements on eve_int_id = ocu_eve_id ";
        }
        $this->requete .= $this->condition.";";        
    }
    
    public function getListPlace($condition=null) {
        $this->setCondition($condition);
        $this->requete ="SELECT pla_places.* from pla_places ". $this->condition.";";
        
    }
        /**
     * Renvoi les informations de connexion à la bdd
     * @return array
     */
    public function infoConnect(){
        $arr= array(
            'host'  =>  "localhost",
            'user'  =>  "root",
            'pwd'  =>  "root",
            'dbName'  =>  "spk-v2.1"
        );
        return $arr;
    }
}
