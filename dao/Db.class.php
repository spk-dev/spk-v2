<?php


/**
 * Description of db
 *
 * @author bteillard
 */
class Db {
    
    private static function loadDb(){
        // ADMINISTRATEUR
        
        $table = array();
        
        $table['adm']=array(
        "#"=>"adm_administrateur",
        "Id"=>"administrateurId",
        "Nom"=>"administrateurNom",
        "Prenom"=>"administrateurPrenom",
        "Mail"=>"administrateurMail",
        "Password"=>"administrateurPassword",
        "Tel"=>"administrateurTel",
        "RoleId"=>"administrateurRoleId",
        "DateLastConnect"=>"administrateurDateLastConnect"
        );

        $table['aro']=array(
        "#"=>"aro_adminRole",
        "Id"=>"adminRoleId",
        "Nom"=>"adminRoleNom",
        "Description"=>"adminRoleDescription"
        );

        $table['com']=array(
        "#"=>"com_communaute",
        "Id"=>"communauteId",
        "Nom"=>"communauteNom",
        "Description"=>"communauteDescription",
        "Photo"=>"communautePhoto",
        "Valid"=>"communauteValid"
        );

        $table['fav']=array(
        "#"=>"fav_favoris",
        "Id"=>"favorisId",
        "Communautes"=>"favorisCommunautes",
        "Types"=>"favorisTypes",
        "ategories"=>"favoriCategories",
        "Lieus"=>"favorisLieus",
        "Retraites"=>"favorisRetraites",
        "Intervenants"=>"favorisIntervenants",
        "UserId"=>"favorisUserId"
        );

        $table['int']=array(
        "#"=>"int_intervenant",
        "Id"=>"intervenantId",
        "Nom"=>"intervenantNom",
        "Photo"=>"intervenantPhoto",
        "Description"=>"intervenantDescription",
        "Prenom"=>"intervenantPrenom",
        "Mail"=>"intervenantMail",
        "Genre"=>"intervenantGenre",
        "Titre"=>"intervenantTitre",
        "Valid"=>"intervenantValid"
        );

        $table['ire']=array(
        "#"=>"ire_intervenantRetraite",
        "IntervenantId"=>"intervenantRetraiteIntervenantId",
        "RetraiteId"=>"intervenantRetraiteRetraiteId"
        );

        $table['lge']=array(
        "#"=>"lge_lieuGeocode",
        "Id"=>"lieuGeocodeId",
        "Lat"=>"lieuGeocodeLat",
        "Long"=>"lieuGeocodeLong"
        );

        $table['lie']=array(
        "#"=>"lie_lieu",
        "Id"=>"lieuId",
        "Nom"=>"lieuNom",
        "Adresse1"=>"lieuAdresse1",
        "Adresse2"=>"lieuAdresse2",
        "Cp"=>"lieuCp",
        "Ville"=>"lieuVille",
        "Pays"=>"lieuPays",
        "Description"=>"lieuDescription",
        "Hebergement"=>"lieuHebergement",
        "Mainphoto"=>"lieuMainphoto",
        "AccesTrain"=>"lieuAccesTrain",
        "AccesVoiture"=>"lieuAccesVoiture",
        "AccesAvion"=>"lieuAccesAvion",
        "LienSiteweb"=>"lieuLienSiteweb",
        "Mail"=>"lieuMail",
        "Tel"=>"lieuTel",
        "Fax"=>"lieuFax",
        "TypeId"=>"lieuTypeId",
        "CommunauteId"=>"lieuCommunauteId",
        "AdministrateurId"=>"lieuAdministrateurId",
        "DateEnregistrement"=>"lieuDateEnregistrement"
        );

        $table['mde']=array(
        "#"=>"mde_mapDepartement",
        "Id"=>"mapDepartementId",
        "RegionId"=>"mapDepartementRegionId",
        "Code"=>"mapDepartementCode",
        "Nom"=>"mapDepartementNom"
        );

        $table['mre']=array(
        "#"=>"mre_mapRegion",
        "Id"=>"mapRegionId",
        "Nom"=>"mapRegionNom"
        );

        $table['mvi']=array(
        "#"=>"mvi_mapVille",
        "Id"=>"mapVilleId",
        "DepartementId"=>"mapVilleDepartementId",
        "Nom"=>"mapVilleNom",
        "Cp"=>"mapVilleCp",
        "lat"=>"mapVillelat",
        "lon"=>"mapVillelon"
        );

        $table['new']=array(
        "#"=>"new_newsletter",
        "Mail"=>"newsletterMail",
        "Status"=>"newsletterStatus",
        "DateInscription"=>"newsletterDateInscription"
        );

        $table['pli']=array(
        "#"=>"pli_photoLieu",
        "Id"=>"photoLieuId",
        "Nom"=>"photoLieuNom",
        "LieuID"=>"photoLieuLieuID"
        );

        $table['pre']=array(
        "#"=>"pre_photoRetraite",
        "Id"=>"photoRetraiteId",
        "Nom"=>"photoRetraiteNom",
        "RetraiteId"=>"photoRetraiteRetraiteId"
        );

        $table['pro']=array(
        "#"=>"pro_profil",
        "Id"=>"profilId",
        "Nom"=>"profilNom",
        "Description"=>"profilDescription"
        );

        $table['ret']=array(
        "#"=>"ret_retraite",
        "Id"=>"retraiteId",
        "Nom"=>"retraiteNom",
        "Description"=>"retraiteDescription",
        "MailInscription"=>"retraiteMailInscription",
        "ContacInscription"=>"retraiteContacInscription",
        "Datedebut"=>"retraiteDatedebut",
        "Datefin"=>"retraiteDatefin",
        "Mainphoto"=>"retraiteMainphoto",
        "Prix"=>"retraitePrix",
        "Garderie"=>"retraiteGarderie",
        "Hebergement"=>"retraiteHebergement",
        "LieuId"=>"retraiteLieuId",
        "DateEnregistrement"=>"retraiteDateEnregistrement"
        );

        $table['the']=array(
        "#"=>"the_theme",
        "Id"=>"themeId",
        "Nom"=>"themeNom",
        "Description"=>"themeDescription",
        "Image"=>"themeImage",
        "Valid"=>"themeValid"
        );

        $table['tre']=array(
        "#"=>"tre_themeRetraite",
        "ThemeId"=>"themeRetraiteThemeId",
        "RetraiteId"=>"themeRetraiteRetraiteId",
        "Priority"=>"themeRetraitePriority"
        );

        $table['typ']=array(
        "#"=>"typ_type",
        "Id"=>"typeId",
        "Nom"=>"typeNom",
        "Description"=>"typeDescription",
        "Photo"=>"typePhoto"
        );

        $table['use']=array(
        "#"=>"use_user",
        "Id"=>"userId",
        "Login"=>"userLogin",
        "om"=>"useNom",
        "Prenom"=>"userPrenom",
        "Mail"=>"userMail",
        "Password"=>"userPassword",
        "Tel1"=>"userTel1",
        "Tel2"=>"userTel2",
        "Newsletter"=>"userNewsletter",
        "Optin"=>"userOptin",
        "ProfilId"=>"userProfilId"
        );
        return $table;
    }
    
    
    /**
     * Renvoi les infos des tables et champ de la bd.
     * @param String $strTableName
     * @param String $strFieldName
     * @param String $strAlias
     * @return string 
     */
    public static function get($strTableName,$strFieldName,$strAlias){
        $value = "";
        $table = array();
        include 'dbInventory.php';
        //$table = self::loadDb();
        
        // Verification que le nom de la table soit défini
        if($strTableName == "" || is_null($strTableName)){
            Applog::ecrireLog("[DB-GET]- parametre strTableName [".$strTableName."] est vide ou null", "sql");
                      
        }
        // Verification de l'existance du nom de table def
        // ini
        else if(!array_key_exists($strTableName, $table)){
                Applog::ecrireLog($table["'".$strTableName."'"],"sql");
                Applog::ecrireLog("[DB-GET]- La table [".$strTableName."] n'est pas referencee dans la base", "sql");
        
         
        }else{
            // NOM DE TABLE SAISI ET VALIDE
            
            // Si le nom du champ n'est pas défini --> Afficher le nom de table
            if($strFieldName == "" || is_null($strFieldName)){
                $strFieldName = "#";
                $value =  "`".$table[$strTableName][$strFieldName]."`";
            }
            // Si le nom du champ est saisi mais faux, ERREUR
            else if(!array_key_exists($strFieldName, $table[$strTableName])){
                   Applog::ecrireLog("[DB-GET]- Le champ [".$strFieldName."] de la table [".$strTableName."] n'existe pas", "sql");
            }
            // Si le nom est valide (correspond a un des champs de la table définie)
            else{
            // NOM DU CHAMP SAISI ET VALIDE  
                $value .=  "`".$table[$strTableName][$strFieldName]."`";
                // Vérification de la présence ou nom d'un alias
                if(isset($strAlias)){
                    // Si l'alias n'est pas null ou vide
                    if(!is_null($strAlias) && trim($strAlias) != ""){      
                        $value = $value." AS ".  str_replace(" ","",$strAlias);
                    }
                }
                
            }
            
        }
      
        
         
         
         return $value;
        
    }
    
    
     /**
     * Renvoi les infos des tables et champ de la bd.
     * @param String $strTableName
     * @param String $strFieldName
     * @param String $strAlias
     * @return string 
     */
    public static function getParam($strTableName,$strFieldName){
        $value = "";
        $table = array();
        include 'dbInventory.php';
        //$table = self::loadDb();
        
        // Verification que le nom de la table soit défini
        if($strTableName == "" || is_null($strTableName)){
            Applog::ecrireLog("[DB-GET]- parametre strTableName [".$strTableName."] est vide ou null", "sql");
                      
        }
        // Verification de l'existance du nom de table def
        // ini
        else if(!array_key_exists($strTableName, $table)){
                Applog::ecrireLog($table["'".$strTableName."'"],"sql");
                Applog::ecrireLog("[DB-GET]- La table [".$strTableName."] n'est pas referencee dans la base", "sql");
        
         
        }else{
            // NOM DE TABLE SAISI ET VALIDE
            
            // Si le nom du champ n'est pas défini --> Afficher le nom de table
            if($strFieldName == "" || is_null($strFieldName)){
                $strFieldName = "#";
                $value =  $table[$strTableName][$strFieldName];
            }
            // Si le nom du champ est saisi mais faux, ERREUR
            else if(!array_key_exists($strFieldName, $table[$strTableName])){
                   Applog::ecrireLog("[DB-GET]- Le champ [".$strFieldName."] de la table [".$strTableName."] n'existe pas", "sql");
            }
            // Si le nom est valide (correspond a un des champs de la table définie)
            else{
            // NOM DU CHAMP SAISI ET VALIDE  
                $value .= $table[$strTableName][$strFieldName];
                // Vérification de la présence ou nom d'un alias
                if(isset($strAlias)){
                    // Si l'alias n'est pas null ou vide
                    if(!is_null($strAlias) && trim($strAlias) != ""){      
                        $value = $value." AS ".  str_replace(" ","",$strAlias);
                    }
                }
                
            }
            
        }
      
        
         
         
         return $value;
        
    }
    
    

}



?>
