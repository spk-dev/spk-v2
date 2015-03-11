<?php

class OrganisateurSearchCriteria{
    
    private $condition;
    
    
    
    private $organisateurRegion;
    private $organisateurDepartement;
    private $organisateurCommune;
    private $organisateurCommunaute;
    private $organisateurType;
    private $organisateurDateMin;
    private $organisateurDateMax;
    private $organisateurMotsCles;
    private $organisateurAdministrateur;
    private $organisateurId;
    private $organisateurLimit;
    private $organisateurOrder;
    
    
//    public function __construct($Region,$departement,$commune,$communaute,$type,$dateMin,$dateMax,$motscles,$idAdministrateur) {
//       
//        $this->organisateurRegion = $Region;
//        $this->organisateurDepartement = $departement;
//        $this->organisateurCommune = $commune;
//        $this->organisateurCommunaute = $communaute;
//        $this->organisateurType = $type;
//        $this->organisateurDateMin = $dateMin;
//        $this->organisateurDateMax = $dateMax;
//        $this->organisateurMotsCles = $motscles;
//        $this->organisateurAdministrateur = $idAdministrateur;
//        
//    }
    
 
// Genere la condition pour la requete SQL
    public function getCondition(){
        
        $listeCritere = array();
        
        // Champ ID
        if(!is_null($this->organisateurId)){
            if(is_array($this->organisateurId)){
                if(sizeof($this->organisateurId)>0){
                    
                    $clauseType = Db::get("org","Id",null)." IN (";
                    
                    for ($i = 0; $i < sizeof($this->organisateurId); $i++) {
                        $clauseType .= $this->organisateurId[$i];
                        if($i!=sizeof($this->organisateurId)-1){
                            $clauseType .=",";
                        }
                    }
                    $clauseType .= ")";
                    array_push($listeCritere, $clauseType);      
                }  
            }   
        }
        
        // Champ Region
        if(!is_null($this->organisateurRegion)){
            if(is_array($this->organisateurRegion)){
                if(sizeof($this->organisateurRegion)>0){
                    //$RetraiteIds = IntervenantActionDao::recupererRetraitesIntervenant($this->RetraiteIntervenants);
                    
                    $clauseRegion = "SUBSTR(".Db::get("pla","Cp",null).",1,2) IN (SELECT ".Db::get("mde","Code",null)." FROM ".Db::get("mde",null,null)." WHERE ".Db::get("mde","RegionId",null)." IN (";
                    
                    for ($i = 0; $i < sizeof($this->organisateurRegion); $i++) {
                        $clauseRegion .= $this->organisateurRegion[$i];
                        if($i!=sizeof($this->organisateurRegion)-1){
                                $clauseRegion .=",";
                        }
                    }
                    $clauseRegion .= "))";
                    array_push($listeCritere, $clauseRegion);      
                }  
            }   
        }
                
        // Champ Departement
        if(!is_null($this->organisateurDepartement)){
            if(is_array($this->organisateurDepartement)){
                if(sizeof($this->organisateurDepartement)>0){
                    
                    $clauseDepartement = "SUBSTR(".Db::get("pla","Cp",null).",1,2) IN (";
                    
                    for ($i = 0; $i < sizeof($this->organisateurDepartement); $i++) {
                        $clauseDepartement .= $this->organisateurDepartement[$i];
                        if($i!=sizeof($this->organisateurDepartement)-1){
                                $clauseDepartement .=",";
                        }
                    }
                    $clauseDepartement .= ")";
                    array_push($listeCritere, $clauseDepartement);      
                }  
            }   
        }
        
        
        // Champ Communes
        if(!is_null($this->organisateurCommune)){
            if(is_array($this->organisateurCommune)){
                if(sizeof($this->organisateurCommune)>0){
                   
                   $clauseCommune = "SUBSTR(".Db::get("pla","Cp",null).",1,3) IN (SELECT SUBSTR(".Db::get("mvi","Cp",null).",1,3) FROM ".Db::get("mvi",null,null)." WHERE ".Db::get("mvi","Id",null)."=".$this->organisateurCommune.")";
                   array_push($listeCritere, $clauseCommune);      
                }  
            }   
        }
        
        // Champ Type
        if(!is_null($this->organisateurType)){
            if(is_array($this->organisateurType)){
                if(sizeof($this->organisateurType)>0){
                    
                    $clauseType = Db::get("org","TypeId",null)." IN (";
                    
                    for ($i = 0; $i < sizeof($this->organisateurType); $i++) {
                        $clauseType .= $this->organisateurType[$i];
                        if($i!=sizeof($this->organisateurType)-1){
                            $clauseType .=",";
                        }
                    }
                    $clauseType .= ")";
                    array_push($listeCritere, $clauseType);      
                }  
            }   
        }
        
        // Champ Administrateur
        if(!is_null($this->organisateurAdministrateur)){
            if(is_array($this->organisateurAdministrateur)){
                if(sizeof($this->organisateurAdministrateur)>0){
                    
                    $clauseType = Db::get("org","AdministrateurId",null)." IN (";
                    
                    for ($i = 0; $i < sizeof($this->organisateurAdministrateur); $i++) {
                        $clauseType .= $this->organisateurAdministrateur[$i];
                        if($i!=sizeof($this->organisateurAdministrateur)-1){
                            $clauseType .=",";
                        }
                    }
                    $clauseType .= ")";
                    array_push($listeCritere, $clauseType);      
                }  
            }   
        }
        
        
        
        // Champ Communaute
        if(!is_null($this->organisateurCommunaute)){
            if(is_array($this->organisateurCommunaute)){
                if(sizeof($this->organisateurCommunaute)>0){
                    
                    $clauseCommunaute = Db::get("org","CommunauteId",null)." IN (";
                    
                    for ($i = 0; $i < sizeof($this->organisateurCommunaute); $i++) {
                        $clauseCommunaute .= $this->organisateurCommunaute[$i];
                        if($i!=sizeof($this->organisateurCommunaute)-1){
                                $clauseCommunaute .=",";
                        }
                    }
                    $clauseCommunaute .= ")";
                    array_push($listeCritere, $clauseCommunaute);      
                }  
            }   
        }
        
        // CHAMP DES MOTS CLES
        if(!is_null($this->organisateurMotsCles)){    
            if(""!=$this->organisateurMotsCles){
                //$keywords = $this->RetraiteMotsCles;
                $tabWors = explode(" ", $this->organisateurMotsCles);
                $clauseKeyWords = "";
                $nbWords = count($tabWors);

                if($nbWords>1){
                    // Mot clé sur le Nom du lieu
                    $clauseKeyWords .="(";
                    for ($i = 0; $i < $nbWords; $i++) {
                        $clauseKeyWords .= "(".Db::get("org","Nom",null)." like '%".$tabWors[$i]."%')";
                        if($i<$nbWords-1){
                            $clauseKeyWords .= " AND ";
                        }
                    }
                    $clauseKeyWords .=") OR (";

                    // Mot clé sur la description
                    for ($i = 0; $i < $nbWords; $i++) {
                        $clauseKeyWords .= "(".Db::get("org","Description",null)." like '%".$tabWors[$i]."%')";
                        if($i<$nbWords-1){
                            $clauseKeyWords .= " AND ";
                        }
                    }
                    $clauseKeyWords .=")";
                }else{
                    $clauseKeyWords = "((".Db::get("org","Nom",null)." like '%".$tabWors[0]."%') OR (".Db::get("org","Description",null)." LIKE '%".$tabWors[0]."%'))";
                }

                array_push($listeCritere, $clauseKeyWords);
            }
        }
        
        
        
        // Champs dates
        if(""!=($this->organisateurDateMin) || ""!=($this->organisateurDateMax)){
            
            $dateMin = $this->organisateurDateMin;
            $dateMax = $this->organisateurDateMax;
            
           if(""!=($dateMin) && ""!=($dateMax)){
                $clauseDate = " (".Db::get("org","DateEnregistrement",null)." BETWEEN '".$dateMin."' AND '".$dateMax."' )";
            }
            if(""==($dateMin) && ""!=($dateMax)){
                    $clauseDate = "(".Db::get("org","DateEnregistrement",null)." <= '".$dateMax."')";
            }
            if(""!=($dateMin) && ""==($dateMax)){
                    $clauseDate = "(".Db::get("org","DateEnregistrement",null)." >= '".$dateMin."')";
            }
            array_push($listeCritere, $clauseDate);
            
        }
               
        
	
        
        
        
        // Construction de la clause
        if(sizeof($listeCritere)>0){
            $this->condition = " AND (";
            $i=0;
            foreach ($listeCritere as $value) {
		$this->condition .= $value;
                if($i< sizeof($listeCritere)-1){
                    $this->condition .= " AND ";
                }
                $i++;
            }
            $this->condition .= " )"; 
	}
        
        // AJOUT DU ORDER
        if(!is_null($this->organisateurOrder)){
            if(""!=$this->organisateurOrder){
                $order = $this->organisateurOrder;
                $this->condition .=" ORDER BY ".$order[0]." ".$order[1];
            }
        }
        
        
        
        // AJOUT DU LIMIT
        if(!is_null($this->organisateurLimit)){
            if(is_array($this->organisateurLimit)){
                $limits = $this->organisateurLimit;
                $this->condition .= " LIMIT ".$limits[0].",".$limits[1];
            }
            
        }
        
        Applog::ecrireLog("CONDITION ORGANISATEURSERACHCRITERIA", "debug");
        Applog::ecrireLog($this->condition, "debug");
        
        return $this->condition;
    }
    
    
    // GETTER & SETTER
    
    public function getOrganisateurRegion() {
        return $this->organisateurRegion;
    }

    public function setOrganisateurRegion($organisateurRegion) {
        $this->organisateurRegion = $organisateurRegion;
    }

    public function getOrganisateurDepartement() {
        return $this->organisateurDepartement;
    }

    public function setOrganisateurDepartement($organisateurDepartement) {
        $this->organisateurDepartement = $organisateurDepartement;
    }

    public function getOrganisateurCommune() {
        return $this->organisateurCommune;
    }

    public function setOrganisateurCommune($organisateurCommune) {
        $this->organisateurCommune = $organisateurCommune;
    }

    public function getOrganisateurCommunaute() {
        return $this->organisateurCommunaute;
    }

    public function setOrganisateurCommunaute($organisateurCommunaute) {
        $this->organisateurCommunaute = $organisateurCommunaute;
    }

    public function getOrganisateurType() {
        return $this->organisateurType;
    }

    public function setOrganisateurType($organisateurType) {
        $this->organisateurType = $organisateurType;
    }

    public function getOrganisateurMotsCles() {
        return $this->organisateurMotsCles;
    }

    public function setOrganisateurMotsCles($organisateurMotsCles) {
        $this->organisateurMotsCles = $organisateurMotsCles;
    }

    public function getOrganisateurDateMin() {
        return $this->organisateurDateMin;
    }

    public function setOrganisateurDateMin($organisateurDateMin) {
        $this->organisateurDateMin = $organisateurDateMin;
    }

    public function getOrganisateurDateMax() {
        return $this->organisateurDateMax;
    }

    public function setOrganisateurDateMax($organisateurDateMax) {
        $this->organisateurDateMax = $organisateurDateMax;
    }
    public function getOrganisateurAdministrateur() {
        return $this->organisateurAdministrateur;
    }

    public function setOrganisateurAdministrateur($organisateurAdministrateur) {
        $this->organisateurAdministrateur = $organisateurAdministrateur;
    }

    public function getOrganisateurId() {
        return $this->organisateurId;
    }

    public function setOrganisateurId($organisateurId) {
        $this->organisateurId = $organisateurId;
    }
    
    public function getOrganisateurLimit() {
        return $this->organisateurLimit;
    }

    public function setOrganisateurLimit($start,$nblignes) {
        if(is_null($start) || is_null($nblignes)){
            $this->organisateurLimit = null;
        }else{
            $this->organisateurLimit = array($start,$nblignes);
        }
    }

    public function getOrganisateurOrder() {
        return $this->organisateurOrder;
    }

    public function setOrganisateurOrder($champ,$sens) {
        $this->organisateurOrder = array($champ, $sens);
    }

	
}



