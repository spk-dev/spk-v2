<?php


/**
 * liste des requetes
 *
 * @author Ben
 */
class Query {
    
    
    /**
     * Renvoi les informations d'un theme en fonction d'un ID
     * @param int $id
     * @return sql
     */
    public static function getTheme($id){
        $sql = "SELECT the_int_id, the_var_nom FROM the_theme WHERE the_int_id = ". $id . ";";
        return $sql;
    }
    
    /**
     * Renvoi les informations d'un type d'organisateur en fonction d'un ID
     * @param int $id
     * @return sql
     */ 
    public static function getTypeOrganisateur($id){
        $sql = "SELECT typ_int_id, typ_var_nom FROM typ_type WHERE typ_int_id = ".$id.";";
        return $sql;
    }
    
        /**
     * Renvoi les informations d'un type d'événement en fonction d'un ID
     * @param int $id
     * @return sql
     */ 
    public static function getTypeEvenement($id){
        $sql = "SELECT tev_int_id, tev_var_nom FROM tev_type_evenement WHERE tev_int_id = ".$id.";";
        return $sql;
    }
    
    /**
     * Renvoi les informations d'un événement en fonction d'un ID
     * @param int $id
     * @return sql
     */
    public static function getEvenement($id){
        $sql = "SELECT 
                eve_int_id as 'id',
                eve_var_titre as 'titre',
                eve_var_description as 'description',
                eve_var_mail_inscription as 'mail',
                eve_var_contact as 'contact',
                eve_date_debut as 'debut',
                eve_date_fin as 'fin',
                eve_var_image as 'image',
                eve_var_prix as 'prix',
                eve_var_url as 'url',
                eve_boo_garderie as 'garderie',
                eve_boo_hebergement as 'hebergement',
                eve_org_int_id as 'lieu_id',
                org_var_nom as 'lieu_nom',
                eve_tev_int_id as 'type_id',
                tev_var_nom as 'type_nom',
                pla_var_adresse1 as 'adresse1',
                pla_var_adresse2 as 'adresse2',
                pla_int_cp as 'cp',
                pla_var_ville as 'ville',
                pla_var_pays as 'pays',
                pla_dec_lat as 'lat',
                pla_dec_long as 'long',

                group_concat(distinct(tet_the_int_id)) as themes,
                group_concat(distinct(itt_ire_int_id)) as intervenants


              FROM eve_evenements 
                left join tet_theme_evenement       ON tet_eve_int_id = eve_int_id
                left join itt_intervenant_evenement ON itt_eve_int_id = eve_int_id
                left join org_organisateurs         ON eve_org_int_id=org_int_id
                left join pla_places                ON eve_pla_int_id = pla_int_id
                left join tev_type_evenement        ON tev_int_id = eve_tev_int_id
              WHERE

                eve_int_id = ".$id.";";
        return $sql;
    }
    
    /**
     * Renvoi les informations d'un organisateur en fonction d'un ID
     * @param int $id
     * @return sql
     */
    public static function getOrganisateur($id){
        $sql = "SELECT
                    org_int_id as 'id',
                     org_var_nom as 'nom',
                     org_var_description as 'description',
                     org_var_hebergement as 'hebergement',
                     org_var_photo as 'image',
                     org_var_train as 'train',
                     org_var_voiture as 'voiture',
                     org_var_avion as 'avion',
                     org_var_siteweb as 'url',
                     org_var_mail as 'mail',
                     org_var_tel as 'tel',
                     org_var_fax as 'fax',
                     org_typ_int_id as 'type_id',
                     typeNom as 'type_nom',
                     org_com_int_id as 'communaute_id',
                     communauteNom as 'communaute_nom',
                     org_adm_int_id as 'admin_id',
                     org_date_enregistrement as 'date_enregistrement',
                     org_boo_valid_admin as 'valid_admin',
                     org_boo_valid_super_admin as 'valid_superadmin',
                     org_pla_int_id as 'place_id',
                     pla_var_adresse1 as 'adresse1',
                     pla_var_adresse2 as 'adresse2',
                     pla_int_cp as 'cp',
                     pla_var_ville as 'ville',
                     pla_var_pays as 'pays',
                     pla_dec_lat as 'lat',
                     pla_dec_long as 'long'

                FROM org_organisateurs
                     left join pla_places on org_pla_int_id = pla_int_id
                     left join typ_type on typ_int_id = org_typ_int_id
                     left join com_communaute on com_communaute.communauteId = org_organisateurs.org_com_int_id

                WHERE org_int_id = ".$id.";";
        return $sql;
    }
    
    /**
     * Renvoi une liste d'événements en fonction de la condition
     * @param str $condition
     * @return sql
     */
    public static function getListeEvenements($condition){
        $sql = "SELECT 
                distinct(eve_int_id) as 'id',
                eve_var_titre as 'titre',
                eve_var_description as 'description',
                eve_var_mail_inscription as 'mail',
                eve_var_contact as 'contact',
                eve_date_debut as 'debut',
                eve_date_fin as 'fin',
                eve_var_image as 'image',
                eve_var_prix as 'prix',
                eve_var_url as 'url',
                eve_boo_garderie as 'garderie',
                eve_boo_hebergement as 'hebergement',
                eve_org_int_id as 'lieu_id',
                org_var_nom as 'lieu_nom',
                eve_tev_int_id as 'type_id',
                tev_var_nom as 'type_nom',
                pla_var_adresse1 as 'adresse1',
                pla_var_adresse2 as 'adresse2',
                pla_int_cp as 'cp',
                pla_var_ville as 'ville',
                pla_var_pays as 'pays',
                pla_dec_lat as 'lat',
                pla_dec_long as 'long',
                tet_the_int_id as 'theme'
            FROM eve_evenements 
                left join org_organisateurs on eve_org_int_id = org_int_id
                left join pla_places on eve_pla_int_id = pla_int_id
                left join tev_type_evenement on tev_int_id = eve_tev_int_id
                left join tet_theme_evenement on tet_eve_int_id = eve_int_id

            WHERE 1=1".$condition." GROUP BY eve_int_id ;";
        
        
              
        return $sql;
    }
    /**
     * Renvoi une liste d'organisateurs en fonction de la condition
     * @param str $condition
     * @return sql
     */
    public static function getListeOrganisateursResume($condition){
        $sql = "SELECT
                    org_int_id as 'id',
                    org_var_nom as 'nom'
                FROM org_organisateurs
                WHERE 1=1 ".$condition.";";
        return $sql;
    }
    /**
     * Renvoi une liste d'organisateurs en fonction de la condition
     * @param str $condition
     * @return sql
     */
    public static function getListeOrganisateurs($condition){
        $sql = "SELECT
                    org_int_id as 'id',
                    org_var_nom as 'nom',
                    org_var_description as 'description',
                    org_var_hebergement as 'hebergement',
                    org_var_photo as 'image',
                    org_var_train as 'train',
                    org_var_voiture as 'voiture',
                    org_var_avion as 'avion',
                    org_var_siteweb as 'url',
                    org_var_mail as 'mail',
                    org_var_tel as 'tel',
                    org_var_fax as 'fax',
                    org_typ_int_id as 'type_id',
                    typeNom as 'type_nom',
                    org_com_int_id as 'communaute_id',
                    communauteNom as 'communaute_nom',
                    org_adm_int_id as 'admin_id',
                    org_date_enregistrement as 'date_enregistrement',
                    org_boo_valid_admin as 'valid_admin',
                    org_boo_valid_super_admin as 'valid_superadmin',
                    org_pla_int_id as 'place_id',
                    pla_var_adresse1 as 'adresse1',
                    pla_var_adresse2 as 'adresse2',
                    pla_int_cp as 'cp',
                    pla_var_ville as 'ville',
                    pla_var_pays as 'pays',
                    pla_dec_lat as 'lat',
                    pla_dec_long as 'long'
                FROM org_organisateurs
                    left join pla_places on org_pla_int_id = pla_int_id
                    left join typ_type on typ_int_id = org_organisateurs.org_typ_int_id
                    left join com_communaute on com_int_id = org_com_int_id
                WHERE 1=1 ".$condition.";";
        return $sql;
    }
    
    /**
     * Renvoi la liste complète des themes
     * @return sql
     */
    public static function getListeThemes($condition){
        $sql = "SELECT the_int_id as id, the_var_nom as nom FROM the_theme WHERE 1=1 ".$condition.";";
        return $sql;
    }

    /**
     * Renvoi une liste complète des types d'événéments
     * @return sql
     */
    public static function getListeTypesOrganisateur($condition){
        $sql = "SELECT typ_int_id as id, typ_var_nom as nom FROM typ_type WHERE 1=1 ".$condition.";";
        return $sql;
    }
    
    /**
     * Renvoi une liste complète des types d'événéments
     * @return sql
     */
    public static function getListeTypesEvenement($condition){
        $sql = "SELECT tev_int_id as id, tev_var_nom as nom FROM tev_type_evenement WHERE 1=1 ".$condition.";";
        return $sql;
    }
   
    /**
     * Renvoi la liste des organisateurs dont les événements sont les plus imminents
     * @return sql
     */
    public static function getListeOrganisateurDateProchainEvenement(){
        $sql = "
            SELECT
               org_int_id as 'id',
               org_var_nom as 'nom',
               org_var_photo as 'image',
               org_boo_valid_admin as 'valid_admin',
               org_boo_valid_super_admin as 'valid_superadmin',
               pla_int_cp as 'cp',
               pla_var_ville as 'ville',
               pla_var_pays as 'pays',
               org_boo_valid_admin,
               org_boo_valid_super_admin,
               DATEDIFF(   (DATE(min(eve_date_debut))), (DATE(now())) ) as 'nbjours'
            FROM org_organisateurs
                    left join eve_evenements on org_int_id = eve_org_int_id
                    left join pla_places on org_pla_int_id = pla_int_id
            WHERE 
                    eve_date_debut > now() 
            AND 
                    org_boo_valid_admin = 1
            AND 
                    org_boo_valid_super_admin = 1
            
            GROUP BY org_var_nom 
            ORDER BY nbjours ASC
            LIMIT 3 ;";
     
         return $sql;
    }
    
    /**
     * Renvoi la liste des themes avec le nombre d'événements associés
     * @return sql
     */
    public static function getNbEvenementParThemes(){ 
        $sql = "SELECT tet_the_int_id AS id, the_var_nom AS nom, COUNT(tet_eve_int_id) AS nb
                FROM tet_theme_evenement, the_theme
                WHERE tet_the_int_id = the_int_id
                GROUP BY tet_the_int_id";
        return $sql;
    }
        
    /**
     * Renvoi la liste de départements
     * @param type $condition
     */
    public static function getListeDepartements($condition){
        
        switch ($condition) {
            case "org":
                $sql = "SELECT distinct(mde_var_code),mde_var_nom FROM mde_mapdepartement 
                        JOIN pla_places ON SUBSTR(pla_int_cp,1,2) = mde_var_code JOIN org_organisateurs on org_pla_int_id = pla_int_id ;";
                break;
            case "eve":
                $sql = "SELECT distinct(mde_var_code),mde_var_nom FROM mde_mapdepartement 
                        JOIN pla_places ON SUBSTR(pla_int_cp,1,2) = mde_var_code JOIN eve_evenements on eve_pla_int_id = pla_int_id ;";
            case "both":
                $sql = "SELECT distinct(mde_var_code),mde_var_nom FROM mde_mapdepartement 
                        JOIN pla_places ON SUBSTR(pla_int_cp,1,2) = mde_var_code JOIN org_organisateurs	 on org_pla_int_id = pla_int_id 
                        UNION 
                        SELECT distinct(mde_var_code),mde_var_nom FROM mde_mapdepartement 
                        JOIN pla_places ON SUBSTR(pla_int_cp,1,2) = mde_var_code JOIN eve_evenements on eve_pla_int_id = pla_int_id ;";
            case "all" :
                $sql = "SELECT distinct(mde_var_code),mde_var_nom FROM mde_mapdepartement;";
            default:
                $sql = "SELECT mde_var_code,mde_var_nom FROM mde_mapdepartement;";
                break;
        }
        return $sql;
    }
    
    /**
     * Renvoi la liste des régions
     * @param type $condition
     * @return string
     */
    public static function getListeRegions($condition){
        
        switch ($condition) {
            case "org":
                $sql = "SELECT distinct(mre_var_nom) FROM mre_mapregion
                        JOIN mde_mapdepartement ON mre_int_id = mde_mre_int_id
                        JOIN pla_places ON SUBSTR(pla_int_cp,1,2) = mde_var_code 
                        JOIN org_organisateurs	 on org_pla_int_id = pla_int_id ;";
                break;
            case "eve":
                $sql = "SELECT distinct(mre_var_nom) FROM mre_mapregion
                        JOIN mde_mapdepartement ON mre_int_id = mde_mre_int_id
                        JOIN pla_places ON SUBSTR(pla_int_cp,1,2) = mde_var_code 
                        JOIN eve_evenements on eve_pla_int_id = pla_int_id ;";
            case "both":
                $sql = "SELECT distinct(mre_var_nom) FROM mre_mapregion
                                JOIN mde_mapdepartement ON mre_int_id = mde_mre_int_id
                                JOIN pla_places ON SUBSTR(pla_int_cp,1,2) = mde_var_code 
                                JOIN org_organisateurs	 on org_pla_int_id = pla_int_id 
                            UNION 
                        SELECT distinct(mre_var_nom) FROM mre_mapregion
                                JOIN mde_mapdepartement ON mre_int_id = mde_mre_int_id
                                JOIN pla_places ON SUBSTR(pla_int_cp,1,2) = mde_var_code 
                                JOIN eve_evenements on eve_pla_int_id = pla_int_id ;";
            case "all" :
                $sql = "Select mre_mapregion from mre_mapregion;";
            default:
                $sql = "Select mre_mapregion from mre_mapregion;";
                break;
        }
        return $sql;
    }
    
    /**
     * Renvoi tous les paramètres d'une 
     * @param type $id
     * @return type
     */
    public static function getPlace($id){
        $sql = "Select * from pla_places where pla_int_id = ".$id.";";
        return $sql ;
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
            'dbName'  =>  "spk-prod"
        );
        return $arr;
    }
}
