<?php

class EvenementSearchCriteria{
    
    private $condition;
    
    
    private $EvenementIntervenants= null;
    private $EvenementLieu= null;
    private $EvenementGarderie= null;
    private $EvenementHebergement= null;
    private $EvenementDateMin= null;
    private $EvenementDateMax= null;
    private $EvenementPrix= null;
    private $EvenementMotsCles= null;
    private $EvenementTheme= null;
    private $EvenementLimit= null;
    private $EvenementExclue= null;
    private $EvenementType= null;
    private $EvenementInclue= null;
    private $EvenementOrder= null;
    private $EvenementAfterToday = null;
// Genere la condition pour la requete SQL
    
    
    
    private $fields = array(
        'id'=>'eve_int_id',
        'titre'=>'eve_var_titre',
        'description'=>'eve_var_description',
        'mail_inscription'=>'eve_var_mail_inscription',
        'contact'=>'eve_var_contact',
        'debut'=>'eve_date_debut',
        'fin'=>'eve_date_fin',
        'image'=>'eve_var_image',
        'prix'=>'eve_var_prix',
        'url'=>'eve_var_url',
        'garderie'=>'eve_boo_garderie',
        'hebergement'=>'eve_boo_hebergement',
        'organisateur'=>'eve_org_int_id',
        'typeEvenement'=>'eve_tev_int_id',
        'place'=>'eve_pla_int_id',
        'enregistrement'=>'eve_date_enregistrement'
    );
    
    public function getCondition(){
        
        $listeCritere = array();
        
        // Champ intervenants
        if(!is_null($this->EvenementIntervenants)){
            if(is_array($this->EvenementIntervenants)){
                if(sizeof($this->EvenementIntervenants)>0){
                    $EvenementIds = IntervenantActionDao::recupererRetraitesIntervenant($this->EvenementIntervenants);
                   
                    
                    $clauseId = $this->getFields('id')." IN (";
			for ($i = 0; $i < sizeof($EvenementIds); $i++) {
				$clauseId .= $EvenementIds[$i];
				if($i!=sizeof($EvenementIds)-1){
					$clauseId .=",";
				}
			}
			$clauseId .= ")";
                        array_push($listeCritere, $clauseId);      
                }  
            }   
        }
        // Champ theme
        if(!is_null($this->EvenementTheme)){
            if(is_array($this->EvenementTheme)){
                if(sizeof($this->EvenementTheme)>0){
                    
                    $themesIds = ThemeAction::recupererRetraiteFromTheme($this->EvenementTheme);
                    
                    $clauseTheme = $this->getFields('id')." IN (";
			for ($i = 0; $i < sizeof($themesIds); $i++) {
                            if ($themesIds[$i])
                            {
				$clauseTheme .= $themesIds[$i]->getId();
				if($i!=sizeof($themesIds)-1){
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
        if(!is_null($this->EvenementLieu)){
            if(is_array($this->EvenementLieu)){
                if(sizeof($this->EvenementLieu)>0){
                    $tabSize = sizeof($this->EvenementLieu);
                    $tabLieu = $this->EvenementLieu;
                    $clauseLieu = $this->getFields('organisateur')." IN (";
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
        if(!is_null($this->EvenementExclue)){
            if(is_array($this->EvenementExclue)){
                if(sizeof($this->EvenementExclue)>0){
                    $tabSize = sizeof($this->EvenementExclue);
                    $tabLieu = $this->EvenementExclue;
                    $clauseExclu = $this->getFields('id')." NOT IN (";
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
        if(!is_null($this->EvenementInclue)){
            if(is_array($this->EvenementInclue)){
                if(sizeof($this->EvenementInclue)>0){
                    $tabSize = sizeof($this->EvenementInclue);
                    $tabLieu = $this->EvenementInclue;
                    $clauseInclu = $this->getFields('id')." IN (";
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
        if(!is_null($this->EvenementType)){
            if(is_array($this->EvenementType)){
                if(sizeof($this->EvenementType)>0){
                    $tabSize = sizeof($this->EvenementType);
                    $tabRet = $this->EvenementType;
                    $clauseType = $this->getFields('typeEvenement')." IN (";
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
        if(!is_null($this->EvenementGarderie)){
            if(!is_string($this->EvenementHebergement)){
                if($this->EvenementGarderie==0 || $this->EvenementGarderie== 1){
                    $clauseGarderie = "(".$this->getFields('garderie')."=".$this->EvenementGarderie.")";
                    array_push($listeCritere, $clauseGarderie);
                }
            }
            
        }
        //Champ hebergemenet
        if(!is_null($this->EvenementHebergement)){
            if(!is_string($this->EvenementHebergement)){
                if($this->EvenementHebergement==0 || $this->EvenementHebergement== 1){
                    $clauseHebergement = "(".$this->getFields('hebergement')."=".$this->EvenementHebergement.")";
                    array_push($listeCritere, $clauseHebergement);
                }
            }
            
        }
        // Champs dates
        if(""!=($this->EvenementDateMin) || ""!=($this->EvenementDateMax)){
            
            $dateMin = $this->EvenementDateMin;
            $dateMax = $this->EvenementDateMax;
            
           if(""!=($dateMin) && ""!=($dateMax)){
                $clauseDate = " (".$this->getFields('debut')." BETWEEN '".$dateMin."' AND '".$dateMax."' )";
            }
            if(""==($dateMin) && ""!=($dateMax)){
                    $clauseDate = "(".$this->getFields('fin')." <= '".$dateMax."')";
            }
            if(""!=($dateMin) && ""==($dateMax)){
                    $clauseDate = "(".$this->getFields('debut')." >= '".$dateMin."')";
            }
            array_push($listeCritere, $clauseDate);
            
        }
        if(!is_null($this->EvenementAfterToday)){
            if($this->EvenementAfterToday){ 
                $clauseToday = "(".$this->getFields('fin')." >= CURDATE())";
                array_push($listeCritere, $clauseToday);
            }else if(!$this->EvenementAfterToday){
                $clauseToday = "(".$this->getFields('fin')." < CURDATE())";
                array_push($listeCritere, $clauseToday);
            }
        }

        
        
        // Champs prix       
        if(!is_null($this->EvenementPrix)){
            $clausePrix = "(".$this->getFields('prix')." <= ".$this->EvenementPrix.")";
            array_push($listeCritere, $clausePrix);
        }
        // Champs mots clés
        if(!is_null($this->EvenementMotsCles)){    
            if(""!=$this->EvenementMotsCles){
                //$keywords = $this->EvenementMotsCles;
                $tabWors = explode(" ", $this->EvenementMotsCles);
                $clauseKeyWords = "";
                $nbWords = count($tabWors);

                if($nbWords>1){
                    // Mot clé sur le Nom de la retraite
                    $clauseKeyWords .="(";
                    for ($i = 0; $i < $nbWords; $i++) {
                        $clauseKeyWords .= "(".$this->getFields('titre')." like '%".$tabWors[$i]."%')";
                        if($i<$nbWords-1){
                            $clauseKeyWords .= " AND ";
                        }
                    }
                    $clauseKeyWords .=") OR (";

                    // Mot clé sur la description
                    for ($i = 0; $i < $nbWords; $i++) {
                        $clauseKeyWords .= "(".$this->getFields('description')." like '%".$tabWors[$i]."%')";
                        if($i<$nbWords-1){
                            $clauseKeyWords .= " AND ";
                        }
                    }
                    $clauseKeyWords .=")";
                }else{
                    $clauseKeyWords = "((".$this->getFields('titre')." like '%".$tabWors[0]."%') OR (".$this->getFields('description')." LIKE '%".$tabWors[0]."%'))";
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
        if(!is_null($this->EvenementOrder)){
            if(is_array($this->EvenementOrder)){
                $order = $this->EvenementOrder;
                $this->condition .=" ORDER BY ".$order[0]." ".$order[1];
            }
        }
        
        if(!is_null($this->EvenementLimit)){
            if(is_array($this->EvenementLimit)){
                $limits = $this->EvenementLimit;
                $this->condition .= " LIMIT ".$limits[0].",".$limits[1];
            }
            
        }
        AppLog::ecrireLog($this->condition, "debug");
        return $this->condition;
    }
    
    
    
// GETTER & SETTER    
    public function getEvenementTheme() {
        return $this->EvenementTheme;
    }

    public function setEvenementTheme($EvenementTheme) {
        $this->EvenementTheme = $EvenementTheme;
    }

    public function getIntervenants() {
        return $this->EvenementIntervenants;
    }

    public function setIntervenants($Intervenants) {
        $this->EvenementIntervenants = $Intervenants;
    }

    public function getEvenementLieu() {
        return $this->EvenementLieu;
    }

    public function setEvenementLieu($EvenementLieu) {
        $this->EvenementLieu = $EvenementLieu;
    }

    public function getEvenementGarderie() {
        return $this->EvenementGarderie;
    }

    public function setEvenementGarderie($EvenementGarderie) {
        $this->EvenementGarderie = $EvenementGarderie;
    }

    public function getEvenementHebergement() {
        return $this->EvenementHebergement;
    }

    public function setEvenementHebergement($EvenementHebergement) {
        $this->EvenementHebergement = $EvenementHebergement;
    }

    public function getEvenementDateMin() {
        return $this->EvenementDateMin;
    }

    public function setEvenementDateMin($EvenementDateMin) {
        $this->EvenementDateMin = $EvenementDateMin;
    }

    public function getEvenementDateMax() {
        return $this->EvenementDateMax;
    }

    public function setEvenementDateMax($EvenementDateMax) {
        $this->EvenementDateMax = $EvenementDateMax;
    }

    public function getEvenementPrix() {
        return $this->EvenementPrix;
    }

    public function setEvenementPrix($EvenementPrix) {
        $this->EvenementPrix = $EvenementPrix;
    }

    public function getEvenementMotsCles() {
        return $this->EvenementMotsCles;
    }

    public function setEvenementMotsCles($EvenementMotsCles) {
        $this->EvenementMotsCles = $EvenementMotsCles;
    }
    
    public function getEvenementLimit(){
        return $this->EvenementLimit;
    }
    
    public function setEvenementLimit($start,$nblignes){
        if(is_null($start) || is_null($nblignes)){
            $this->EvenementLimit = null;
        }else{
          $this->EvenementLimit = array($start,$nblignes);  
        }
        
    }
    
    public function getEvenementExclue() {
        return $this->EvenementExclue;
    }

    public function setEvenementExclue($EvenementExclue) {
        $this->EvenementExclue = $EvenementExclue;
    }

    public function getEvenementType() {
        return $this->EvenementType;
    }

    public function setEvenementType($EvenementType) {
        $this->EvenementType = $EvenementType;
    }

    public function getEvenementInclue() {
        return $this->EvenementInclue;
    }

    public function setEvenementInclue($EvenementInclue) {
        $this->EvenementInclue = $EvenementInclue;
    }

    public function getEvenementOrder() {
        return $this->EvenementOrder;
    }

    public function setEvenementOrder($champ,$sens) {
        $champ = $this->getFields($champ);
        $this->EvenementOrder = array($champ, $sens);
    }

    public function setEvenementAfterToday($EvenementAfterToday){
        $this->EvenementAfterToday = $EvenementAfterToday;
    }
    
    private function getFields($key){
        return $this->fields[$key];
    }


	
}

?>

