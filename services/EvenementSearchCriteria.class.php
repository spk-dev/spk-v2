<?php

class EvenementSearchCriteria{
    
    private $condition;
    
    
    private $intervenants  =   null;
    private $Organisateurs =   null;
    private $garderie      =   null;
    private $hebergement   =   null;
    private $dateMin       =   null;
    private $dateMax       =   null;
    private $prix          =   null;
    private $motscles      =   null;
    private $themes        =   null;
    private $limit         =   null;
    private $exclue        =   null;
    private $types         =   null;
    private $inclue        =   null;
    private $order         =   null;
    private $aftertoday    = null;
    
    public function test(){
        return "TOTO FROM EVENEMENTSEARCHCRITERIA";
    }
    
// Genere la condition pour la requete SQL
    public function getCondition(){
        
        $listeCritere = array();
        
        // Champ intervenants
//        if(!is_null($this->intervenants)){
//            if(is_array($this->intervenants)){
//                if(sizeof($this->intervenants)>0){
//                    //$EvenementIds = IntervenantActionDao::recupererRetraitesIntervenant($this->intervenants);
//                   
//                    
//                    $clauseId = Db::get("eve","Id", null)." IN (";
//			for ($i = 0; $i < sizeof($EvenementIds); $i++) {
//				$clauseId .= $EvenementIds[$i];
//				if($i!=sizeof($EvenementIds)-1){
//					$clauseId .=",";
//				}
//			}
//			$clauseId .= ")";
//                        array_push($listeCritere, $clauseId);      
//                }  
//            }   
//        }
        // Champ theme
        if(!is_null($this->themes)){
            if(is_array($this->themes)){
                if(sizeof($this->themes)>0){
                    
                    //$themesIds = ThemeAction::recupererRetraiteFromTheme($this->themes);
                    
                    $clauseTheme = "tet_the_int_id IN (";
			for ($i = 0; $i < sizeof($this->themes); $i++) {
                            if ($this->themes[$i])
                            {
				$clauseTheme .= $this->themes[$i];
				if($i!=sizeof($this->themes)-1){
					$clauseTheme .=",";
				}
                            }
			}
			$clauseTheme .= ")";
                        array_push($listeCritere, $clauseTheme);
                        
                }  
            }   
        }
        // Champ Lieu
        if(!is_null($this->Organisateurs)){
            if(is_array($this->Organisateurs)){
                if(sizeof($this->Organisateurs)>0){
                    $tabSize = sizeof($this->Organisateurs);
                    $tabLieu = $this->Organisateurs;
                    $clauseLieu = "eve_org_int_id IN (";
                    for ($i = 0; $i < $tabSize; $i++) {
                            $clauseLieu .=$tabLieu[$i];
                            if($i<$tabSize-1){
                                    $clauseLieu .=",";
                            }
                    }
                    $clauseLieu .= ")";
                        array_push($listeCritere, $clauseLieu);

                }  
            }   
        }
        // Champ Exclusion
        if(!is_null($this->exclue)){
            if(is_array($this->exclue)){
                if(sizeof($this->exclue)>0){
                    $tabSize = sizeof($this->exclue);
                    $tabLieu = $this->exclue;
                    $clauseExclu = "eve_int_id NOT IN (";
                    for ($i = 0; $i < $tabSize; $i++) {
                            $clauseExclu .=$tabLieu[$i];
                            if($i<$tabSize-1){
                                    $clauseExclu .=",";
                            }
                    }
                    $clauseExclu .= ")";
                        array_push($listeCritere, $clauseExclu);

                }  
            }   
        }
        // Champ Inclusion
        if(!is_null($this->inclue)){
            if(is_array($this->inclue)){
                if(sizeof($this->inclue)>0){
                    $tabSize = sizeof($this->inclue);
                    $tabLieu = $this->inclue;
                    $clauseInclu = "eve_int_id IN (";
                    for ($i = 0; $i < $tabSize; $i++) {
                            $clauseInclu .=$tabLieu[$i];
                            if($i<$tabSize-1){
                                    $clauseInclu .=",";
                            }
                    }
                    $clauseInclu .= ")";
                        array_push($listeCritere, $clauseInclu);

                }  
            }   
        }
        // Champ TypesEvenements
        if(!is_null($this->types)){
            if(is_array($this->types)){
                if(sizeof($this->types)>0){
                    $tabSize = sizeof($this->types);
                    $tabRet = $this->types;
                    $clauseType = "eve_tev_int_id IN (";
                    for ($i = 0; $i < $tabSize; $i++) {
                            $clauseType .=$tabRet[$i];
                            if($i<$tabSize-1){
                                    $clauseType .=",";
                            }
                    }
                    $clauseType .= ")";
                        array_push($listeCritere, $clauseType);

                }  
            }   
        }
        // Champ garderie
        if(!is_null($this->garderie)){
            if(!is_string($this->hebergement)){
                if($this->garderie==0 || $this->garderie== 1){
                    $clauseGarderie = "(eve_boo_garderie=".$this->garderie.")";
                    array_push($listeCritere, $clauseGarderie);
                }
            }
            
        }
        //Champ hebergemenet
        if(!is_null($this->hebergement)){
            if(!is_string($this->hebergement)){
                if($this->hebergement==0 || $this->hebergement== 1){
                    $clauseHebergement = "(eve_boo_hebergement = ".$this->hebergement.")";
                    array_push($listeCritere, $clauseHebergement);
                }
            }
            
        }
        // Champs dates
        if(""!=($this->dateMin) || ""!=($this->dateMax)){
            
            $dateMin = $this->dateMin;
            $dateMax = $this->dateMax;
            
           if(""!=($dateMin) && ""!=($dateMax)){
                $clauseDate = " (eve_date_debut BETWEEN '".$dateMin."' AND '".$dateMax."' )";
            }
            if(""==($dateMin) && ""!=($dateMax)){
                    $clauseDate = "eve_date_fin <= '".$dateMax."')";
            }
            if(""!=($dateMin) && ""==($dateMax)){
                    $clauseDate = "(eve_date_debut >= '".$dateMin."')";
            }
            array_push($listeCritere, $clauseDate);
            
        }
        if(!is_null($this->aftertoday)){
            if($this->aftertoday){ 
                $clauseToday = "eve_date_fin >= CURDATE())";
                array_push($listeCritere, $clauseToday);
            }else if(!$this->aftertoday){
                $clauseToday = "eve_date_fin < CURDATE())";
                array_push($listeCritere, $clauseToday);
            }
        }

        
        
        // Champs prix       
        if(!is_null($this->prix)){
            $clausePrix = "(eve_var_prix <= ".$this->prix.")";
            array_push($listeCritere, $clausePrix);
        }
        // Champs mots clés
        if(!is_null($this->motscles)){    
            if(""!=$this->motscles){
                //$keywords = $this->EvenementMotsCles;
                $tabWors = explode(" ", $this->motscles);
                $clauseKeyWords = "";
                $nbWords = count($tabWors);

                if($nbWords>1){
                    // Mot clé sur le Nom de la retraite
                    $clauseKeyWords .="(";
                    for ($i = 0; $i < $nbWords; $i++) {
                        $clauseKeyWords .= "(eve_var_titre like '%".$tabWors[$i]."%')";
                        if($i<$nbWords-1){
                            $clauseKeyWords .= " AND ";
                        }
                    }
                    $clauseKeyWords .=") OR (";

                    // Mot clé sur la description
                    for ($i = 0; $i < $nbWords; $i++) {
                        $clauseKeyWords .= "(eve_var_description like '%".$tabWors[$i]."%')";
                        if($i<$nbWords-1){
                            $clauseKeyWords .= " AND ";
                        }
                    }
                    $clauseKeyWords .=")";
                }else{
                    $clauseKeyWords = "((eve_var_titre like '%".$tabWors[0]."%') OR (eve_var_description LIKE '%".$tabWors[0]."%'))";
                }

                array_push($listeCritere, $clauseKeyWords);
            }
        } 

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
        if(!is_null($this->order)){
            if(""!=$this->order){
                $order = $this->order;
                $this->order .=" ORDER BY ".$order[0]." ".$order[1];
            }
        }
        
        if(!is_null($this->limit)){
            if(is_array($this->limit)){
                $limits = $this->limit;
                $this->condition .= " LIMIT ".$limits[0].",".$limits[1];
            }
            
        }
        
        return $this->condition;
    }
    
    
    
    public function getIntervenants() {
        return $this->intervenants;
    }

    public function getOrganisateurs() {
        return $this->Organisateurs;
    }

    public function getGarderie() {
        return $this->garderie;
    }

    public function getHebergement() {
        return $this->hebergement;
    }

    public function getDateMin() {
        return $this->dateMin;
    }

    public function getDateMax() {
        return $this->dateMax;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getMotscles() {
        return $this->motscles;
    }

    public function getThemes() {
        return $this->themes;
    }

    public function getLimit() {
        return $this->limit;
    }

    public function getExclue() {
        return $this->exclue;
    }

    public function getTypes() {
        return $this->types;
    }

    public function getInclue() {
        return $this->inclue;
    }

    public function getOrder() {
        return $this->order;
    }

    public function getAftertoday() {
        return $this->aftertoday;
    }

    public function setIntervenants($intervenants) {
        $this->intervenants = $intervenants;
    }

    public function setOrganisateurs($Organisateurs) {
        $this->Organisateurs = $Organisateurs;
    }

    public function setGarderie($garderie) {
        $this->garderie = $garderie;
    }

    public function setHebergement($hebergement) {
        $this->hebergement = $hebergement;
    }

    public function setDateMin($dateMin) {
        $this->dateMin = $dateMin;
    }

    public function setDateMax($dateMax) {
        $this->dateMax = $dateMax;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
    }

    public function setMotscles($motscles) {
        $this->motscles = $motscles;
    }

    public function setThemes($themes) {
        $this->themes = $themes;
    }

    public function setLimit($limit) {
        $this->limit = $limit;
    }

    public function setExclue($exclue) {
        $this->exclue = $exclue;
    }

    public function setTypes($types) {
        $this->types = $types;
    }

    public function setInclue($inclue) {
        $this->inclue = $inclue;
    }

    public function setOrder($order) {
        $this->order = $order;
    }

    public function setAftertoday($aftertoday) {
        $this->aftertoday = $aftertoday;
    }


    


	
}

?>

