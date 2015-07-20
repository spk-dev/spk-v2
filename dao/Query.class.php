<?php


/**
 * liste des requetes
 *
 * @author Ben
 */
class Query {
    
    /**
     * Renvoi la liste des événements ayant au moins 1 occurence
     * @param type $condition
     * @return string
     */
    public static function getListeEvenements($condition = ""){
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
    public static function getListeOrganisateurs($condition = ""){
        $sql = "SELECT org_int_id, org_var_libelle, pla_var_area1, pla_var_area2, pla_var_ville, com_int_id, com_var_libelle, tor_var_libelle, tor_int_id
                 FROM org_organisateurs
                left join pla_places on org_pla_int_id = pla_int_id
                left join com_communaute on com_int_id = org_com_int_id
                left join tor_type_organisateurs on org_tor_int_id = tor_int_id
                WHERE 1=1 ".$condition.";";
        
        return $sql;
    }
    
    /**
     * liste les événments
     * @param boolean $avecEvenement si liste des types utilisés ou non
     */
    public static function getListeTypeEvenement($avecEvenement){
        if($avecEvenement){
            $sql ="SELECT  distinct(tev_int_id), tev_var_libelle
                FROM eve_evenements 
                right join ocu_occurrences on eve_int_id = ocu_eve_id 
                left join tev_type_evenements on tev_int_id = eve_tev_int_id 
                left join pla_places on pla_int_id = ocu_pla_id 
                left join org_organisateurs on eve_org_int_id = org_int_id;";
        }else{
            $sql = "select tev_int_id, tev_var_libelle from tev_type_evenements;";
        }
        return $sql;
    }
    
    
    /**
     * Renvoi la liste des Themes d'événements
     * @param type $avecEvenement
     * @return string
     */
    public static function getListeThemeEvenement($avecEvenement){
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
    public static function getEvenement($id){
        $sql = "SELECT * FROM eve_evenements WHERE eve_int_id = ".$id;
        
        return $sql;
        
    }
    
    /**
     * Renvoi les données complètes d'un organisateur
     * @param type $id
     * @return string
     */
    public static function getOrganisateur($id){
        $sql = "select * from org_organisateurs
                left join com_communaute on org_com_int_id = com_int_id
                left join pla_places on org_pla_int_id = pla_int_id
                left join tor_type_organisateurs on org_tor_int_id = tor_int_id
                WHERE org_int_id = ".$id.";";
        
        return $sql;
    }
    
    public static function getPays(){
        $sql = "SELECT distinct(pla_var_pays) FROM pla_places;";
        return $sql;
    }
    
    
    public static function getArea1($q){
        $sql = "SELECT distinct(pla_var_area1) FROM pla_places WHERE  pla_var_pays LIKE ('%".$q."%');";
        return $sql;
    }
    
    
    public static function getArea2($area1){
        $sql = "SELECT distinct(pla_var_area2) FROM pla_places WHERE  pla_var_area1 LIKE ('%".$area1."%');";
        return $sql;
    }
    
    
        /**
     * Renvoi les informations de connexion à la bdd
     * @return array
     */
    public static function infoConnect(){
        $arr= array(
            'host'  =>  "localhost",
            'user'  =>  "root",
            'pwd'  =>  "root",
            'dbName'  =>  "spk-v2.1"
        );
        return $arr;
    }
}
