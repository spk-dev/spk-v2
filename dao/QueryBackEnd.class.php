<?php
    /**
    * Class des gestion des ordres SQL
    *
    * @author  J. Vidaillac
    *
    */
class QueryBackEnd {
    
    private $condition;
    private $requete;
    private $tableName;
    private $columns;
    private $valuesColumn=array();
    private $clesPrimaire;  
    private $codeRetourSql;
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
    const K_allColumns = true;
    const K_modifColumns = false;   
    
    /**
    * @role Contructeur
    * @param string $condition condition de la requete 
    * @author  J. Vidaillac
    */
    function __construct($condition=null){
        $this->setCondition($condition);
    }
    
    /**
    * @role Permet de positionner une condition sur l'order SQL
    * @param string $condition condition de recherche  
    * @author  J. Vidaillac
    */
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
    
    public function checkExcutionSql()
    {
        return $this->codeRetourSql;
    }
    
    /**
    * @role Permet de positionner l'order sql a exucter en base
    * @param string $sql ordre sql à exécuter
    * @author  J. Vidaillac
    */    
    public function setRequete($sql) {
        $this->requete=$sql;
    }
    
    /**
    * @role Permet d'exécuter en base l'ordre insert
    * @param aucun
    * @author  J. Vidaillac
    */   
    public function executeInsert() {
        $this->codeRetourSql = UtilsDao::getInstance()->executeInsert($this->requete);
    }
    
    /**
    * @role Permet d'exécuter en base un order sql de type select
    * @param string $sql ordre sql à exécuter
    * @author  J. Vidaillac
    */       
    public function executeSelect() {
        return UtilsDao::getInstance()->executeRequete($this->requete);
    }
    
        
    /**
    * @role Permet d'exécuter en base un order sql de type update
    * @param aucun
    * @author  J. Vidaillac
    */       
    public function executeUpdate() {
        $this->codeRetourSql = UtilsDao::getInstance()->executeUpdateDelete($this->requete);
    }
       
    /**
    * @role Permet d'exécuter en base un order sql de type delete
    * @param aucun
    * @author  J. Vidaillac
    */       
    public function executeDelete() {
        return UtilsDao::getInstance()->executeUpdateDelete($this->requete);
    }
    
    /**
    * @role Permet de définir la table concernée par l'ordre sql
    * @param aucun
    * @author  J. Vidaillac
    */
    public function setTableName($tableName) {
        $this->tableName=$tableName;
    }
    
    /**
    * @role Permet de définir la table concernée par l'ordre sql
    * @param aucun
    * @author  J. Vidaillac
    */
    public function setColonnesPrimaryKey(array $valeurs=null) {
        /*
         * requête récupérant les colonnes composant la cle primaire d'une table
         */
        $sql = "SELECT column_name as 'entete_colonne' FROM information_schema.columns"
                . " WHERE table_name = '". $this->tableName."' and column_key = '".self::K_clePrimaire."'";
        $this->setRequete($sql);
        $tableResults = $this->executeQuery();
        /*
         * on charge la cle primaire avec les critères utilisateur
         */
        foreach ($tableResults as $result) {
            $this->clesPrimaire[$result['entete_colonne']][self::K_getNomColonne] = $result['entete_colonne'];
            if (array_key_exists($result['entete_colonne'], $valeurs))
                $this->clesPrimaire[$result['entete_colonne']][self::K_getValColonne] = $valeurs[$result['entete_colonne']];
        }
    }
 
    /**
    * @role Permet de définir les colonnes de la table
    * @param aucun
    * @author  J. Vidaillac
    */
    public function setColumnList() {
        $sql = "SELECT column_name as 'entete_colonne',data_type,is_nullable FROM information_schema.columns"
                . " WHERE table_name = '". $this->tableName."' and column_key <> 'PRIM'";
        $this->setRequete($sql);
        $tableResults = $this->executeQuery();
        $index=0;
        foreach ( $tableResults as $result)
        {
            $this->columns[$index][self::K_getNomColonne] = $result['entete_colonne'];
            $this->columns[$index][self::K_getManColonne] = $result['is_nullable']==self::K_nullable?true:false;
            $this->columns[$index++][self::K_getTypColonne] = $result['data_type'];
        }
        /*
         * on tri la liste des colonnes pour rester uniforme
         */
        ksort($this->columns, SORT_REGULAR);
    }
    
    /**
    * @role Permet d'identifier le format d'une colonne
    * Datetime / text / varchar ou autre
    * @param string colonneName Nom de la colonne concernée
    * @param string valeur valeur a affecter
    * @return la valeur formatée en fonction du type de la colonne
    * @author  J. Vidaillac
    */
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

    /**
    * @role Permet de charger les valeurs à inserer 
    * @param array tabValues tableau contenant les valeurs de mise à jour
    * @param booleen VRAI si on intialise les valeurs non définies par l'utilisateur
    * @author  J. Vidaillac
    */
    public function setvaluesList(array $tabValues, $completerList) {
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
        ksort($this->valuesColumn, SORT_REGULAR);
    }
    
        /**
    * @role Permet de créer la condition associée à la cle primaire de la table
    * @param aucun
    * @author  J. Vidaillac
    */
    public function setWhereKey()
    {
        foreach ($this->clesPrimaire as $cle)
        {
            $condition .= " AND ".$cle[self::K_getNomColonne]." =".$cle[self::K_getValColonne]; 
        }
        $this->setCondition($condition);
    }
    
    /**
    * @role Permet de créer l'order SQL d'un select de table
    * @param string tableName Nom de la table concernée
    * @param array valColonnes valeur a affecter
    * @param string orderBy codage sql de l'order by. ex order by 1,2 ou order by colonne1 asc , colonne 1 desc
    * @author  J. Vidaillac
    */
    public function preparerSelectTable($tableName,array $tabWhere,$orderBy=null) {
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
        $this->setvaluesList($tabWhere,(boolean) self::K_modifColumns);
        /*
         * Création de l'ordre SQL
         */
        $tempoSql = "Select ";
        /*
         * 
         */
        $listColonnes='';
        foreach ($this->columns as $colonne)
        {
            $listColonnes .= $colonne[self::K_getNomColonne].',';
        }
        $tempoSql .=  substr($listColonnes, 0, -1) . " from ". $this->tableName;
        $tempoSql .= " where 1=1 ";
        $liskeys = array_keys($this->valuesColumn);
        foreach ($liskeys as $key) {
            if ( !empty($this->valuesColumn[$key]))
                $tempoSql .= " and ".$key." =".$this->valuesColumn[$key];
        }
        
        $tempoSql .= ' '.$orderBy;
        $this->requete = $tempoSql;
    }

    
    /**
    * @role Permet de créer l'order SQL d'un insert de table
    * @param string tableName Nom de la table concernée
    * @param array valColonnes valeur a affecter
    * @author  J. Vidaillac
    */
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
        $this->setvaluesList($valColonnes,(boolean) self::K_modifColumns);

        /*
         * Création de l'ordre SQL
         */
        $tempoSql = "Insert into ". $this->tableName;
        $listColonnes = '(';
        $listValues .= ' values (';
        foreach (array_keys($this->valuesColumn) as $key ) {
            $listColonnes .=  $key.",";
            $listValues .= $this->valuesColumn[$key].',';
        }
        $tempoSql .= substr($listColonnes, 0, -1).")" . substr($listValues, 0, -1).")";        
        $this->requete = $tempoSql;
    }
    
    /**
    * @role Permet de créer l'order SQL de mise à jour de table
    * @param string tableName Nom de la table concernée
    * @param array valeurs associées à la cle primaire de la table
    * @param array valColonnes valeur à affecter
    * @author  J. Vidaillac
    */
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
        $this->setColumnList();     
        /*
         * On charge les valeurs à mettre à jour
         */
        $this->setvaluesList($valColonnes,(boolean) self::K_modifColumns);
        
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
            $tempoSql .= " and ".$key." =".$this->clesPrimaire[$key][self::K_getValColonne];
        }
        $this->requete = $tempoSql;
        
    }    

        
    /**
    * @role Permet de créer l'order SQL de mise à jour de table
    * @param string tableName Nom de la table concernée
    * @param array valeurs associées à la cle primaire de la table
    * @param array valColonnes valeur à affecter
    * @author  J. Vidaillac
    */
    public function preparerSupprimerTable($tableName,$tableKeyValeur) {
        /*
         * On se positionne sur la table à modifier
         */
        $this->setTableName($tableName);
        /*
         * on charge les cles primaire de la table
         */
        $this->setColonnesPrimaryKey($tableKeyValeur);
        
        /*
         * création de l'ordre SQL
         */
        $tempoSql = "delete from ". $this->tableName. " ";
        $tempoSql .= " where 1=1 ";
        $liskeys = array_keys($this->clesPrimaire);
        foreach ($liskeys as $key) {
            $tempoSql .= " and ".$key." =".$this->clesPrimaire[$key][self::K_getValColonne];
        }
        $this->requete = $tempoSql;
        
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
    
        public function executeQuery() {
        return UtilsDao::getInstance()->executeRequete($this->requete);
    }

}