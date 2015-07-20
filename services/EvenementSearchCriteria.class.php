<?php

class EvenementSearchCriteria{
    
    private $condition;
    
    
//    private $EvenementIntervenants= null;
    private $EvenementOrganisateur= null;
    private $EvenementGarderie= null;
    private $EvenementHebergement= null;
    private $EvenementDateMin= null;
    private $EvenementDateMax= null;
//    private $EvenementPrix= null;
    private $EvenementMotsCles= null;
//    private $EvenementTheme= null;
    private $EvenementLimit= null;
//    private $EvenementExclue= null;
    private $EvenementType= null;
//    private $EvenementInclue= null;
    private $EvenementOrder= null;
    private $EvenementAfterToday = null;

    private $EvenementPays = null;
    private $EvenementArea1 = null;
    private $EvenementArea2 = null;
    
    private $fields = array(
        'id'=>'eve_int_id',
        'titre'=>'eve_var_libelle',
        'description'=>'eve_var_description',
        'debut'=>'ocu_date_debut',
        'fin'=>'ocu_date_fin',
        'garderie'=>'eve_var_gardeenfant',
        'hebergement'=>'eve_var_hebergement',
        'organisateur'=>'eve_org_int_id',
        'typeEvenement'=>'tev_int_id',
        'ville'=>'pla_var_ville',
        'cp'=> 'pla_int_cp',
        'area1' => 'pla_var_area1',  
        'area2' => 'pla_var_area2',  
        'pays' => 'pla_var_pays',  
        'enregistrement'=>'eve_date_enregistrement'
        
    );
    
    public function getCondition(){
        
        $listeCritere = array();
        
        // Champ Lieu
        if(!is_null($this->EvenementOrganisateur)){
            if(is_array($this->EvenementOrganisateur)){
                if(sizeof($this->EvenementOrganisateur)>0){
                    $tabSize = sizeof($this->EvenementOrganisateur);
                    $tabLieu = $this->EvenementOrganisateur;
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
        
        
        // Champ Area1
        if(!is_null($this->EvenementArea1)){
            if(is_array($this->EvenementArea1)){
                if(sizeof($this->EvenementArea1)>0){
                    $tabSize = sizeof($this->EvenementArea1);
                    $tabRet = $this->EvenementArea1;
                    $clauseType = $this->getFields('area1')." IN ('";
                    for ($i = 0; $i < $tabSize; $i++) {
                            $clauseType .=$tabRet[$i];
                            if($i<$tabSize-1){
                                    $clauseType .="','";
                            }
                    }
                    $clauseType .= "')";
                    array_push($listeCritere, $clauseType);

                }  
            }   
        }
        
        // Champ Area1
        if(!is_null($this->EvenementArea2)){
            if(is_array($this->EvenementArea2)){
                if(sizeof($this->EvenementArea2)>0){
                    $tabSize = sizeof($this->EvenementArea2);
                    $tabRet = $this->EvenementArea2;
                    $clauseType = $this->getFields('area2')." IN ('";
                    for ($i = 0; $i < $tabSize; $i++) {
                            $clauseType .=$tabRet[$i];
                            if($i<$tabSize-1){
                                    $clauseType .="','";
                            }
                    }
                    $clauseType .= "')";
                    array_push($listeCritere, $clauseType);

                }  
            }   
        }
         // Champ Area1
        if(!is_null($this->EvenementPays)){
            if(is_array($this->EvenementPays)){
                if(sizeof($this->EvenementPays)>0){
                    $tabSize = sizeof($this->EvenementPays);
                    $tabRet = $this->EvenementPays;
                    $clauseType = $this->getFields('pays')." IN ('";
                    for ($i = 0; $i < $tabSize; $i++) {
                            $clauseType .=$tabRet[$i];
                            if($i<$tabSize-1){
                                    $clauseType .="','";
                            }
                    }
                    $clauseType .= "')";
                    array_push($listeCritere, $clauseType);

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
        
        // SI EVENT A VENIR OU PASSE
        if(!is_null($this->EvenementAfterToday)){
            if($this->EvenementAfterToday){ 
                $clauseToday = "(".$this->getFields('fin')." >= CURDATE())";
                array_push($listeCritere, $clauseToday);
            }else if(!$this->EvenementAfterToday){
                $clauseToday = "(".$this->getFields('fin')." < CURDATE())";
                array_push($listeCritere, $clauseToday);
            }
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

    public function getEvenementMotsCles() {
        return $this->EvenementMotsCles;
    }

    public function setEvenementMotsCles($EvenementMotsCles) {
        $this->EvenementMotsCles = $EvenementMotsCles;
    }

    public function getEvenementType() {
        return $this->EvenementType;
    }

    public function setEvenementType($EvenementType) {
        $this->EvenementType = $EvenementType;
    }

    public function getEvenementAfterToday() {
        return $this->EvenementAfterToday;
    }

    public function setEvenementAfterToday($EvenementAfterToday) {
        $this->EvenementAfterToday = $EvenementAfterToday;
    }

    public function getEvenementOrganisateur() {
        return $this->EvenementOrganisateur;
    }

    public function setEvenementOrganisateur($EvenementOrganisateur) {
        $this->EvenementOrganisateur = $EvenementOrganisateur;
    }


    function getEvenementArea1() {
        return $this->EvenementArea1;
    }

    function getEvenementArea2() {
        return $this->EvenementArea2;
    }

    function setEvenementArea1($EvenementArea1) {
        $this->EvenementArea1 = $EvenementArea1;
    }

    function setEvenementArea2($EvenementArea2) {
        $this->EvenementArea2 = $EvenementArea2;
    }

    function getEvenementPays() {
        return $this->EvenementPays;
    }

    function setEvenementPays($EvenementPays) {
        $this->EvenementPays = $EvenementPays;
    }

                
    public function setEvenementLimit($start,$nblignes){
        if(is_null($start) || is_null($nblignes)){
            $this->EvenementLimit = null;
        }else{
          $this->EvenementLimit = array($start,$nblignes);  
        }
        
    }

    public function setEvenementOrder($champ,$sens) {
        $champ = $this->getFields($champ);
        $this->EvenementOrder = array($champ, $sens);
    }

//    public function setEvenementAfterToday($EvenementAfterToday){
//        $this->EvenementAfterToday = $EvenementAfterToday;
//    }
//    
    private function getFields($key){
        return $this->fields[$key];
    }


	
}

?>

