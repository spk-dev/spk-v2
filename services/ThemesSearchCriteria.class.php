<?php

class ThemesSearchCriteria{
    
    private $condition;
    
    private $MotsCles;
    private $Id;
    private $evenement;
    private $limit;
    private $order;
    

 
// Genere la condition pour la requete SQL
    public function getCondition(){
        
        $listeCritere = array();
        
        // Champ ID
        if(!is_null($this->Id)){
            if(is_array($this->Id)){
                if(sizeof($this->Id)>0){
                    
                    $clauseType = "the_int_id IN (";
                    
                    for ($i = 0; $i < sizeof($this->Id); $i++) {
                        $clauseType .= $this->Id[$i];
                        if($i!=sizeof($this->Id)-1){
                            $clauseType .=",";
                        }
                    }
                    $clauseType .= ")";
                    array_push($listeCritere, $clauseType);      
                }  
            }   
        }
        
       
        
        // CHAMP DES MOTS CLES
        if(!is_null($this->MotsCles)){    
            if(""!=$this->MotsCles){
                //$keywords = $this->RetraiteMotsCles;
                $tabWors = explode(" ", $this->MotsCles);
                $clauseKeyWords = "";
                $nbWords = count($tabWors);

                if($nbWords>1){
                    // Mot clé sur le Nom du lieu
                    $clauseKeyWords .="(";
                    for ($i = 0; $i < $nbWords; $i++) {
                        $clauseKeyWords .= "(the_var_nom like '%".$tabWors[$i]."%')";
                        if($i<$nbWords-1){
                            $clauseKeyWords .= " AND ";
                        }
                    }
                    $clauseKeyWords .=") OR (";

                    // Mot clé sur la description
                    for ($i = 0; $i < $nbWords; $i++) {
                        $clauseKeyWords .= "(the_var_nom like '%".$tabWors[$i]."%')";
                        if($i<$nbWords-1){
                            $clauseKeyWords .= " AND ";
                        }
                    }
                    $clauseKeyWords .=")";
                }else{
                    $clauseKeyWords = "((the_var_nom like '%".$tabWors[0]."%') OR (the_var_nom LIKE '%".$tabWors[0]."%'))";
                }

                array_push($listeCritere, $clauseKeyWords);
            }
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
        if(!is_null($this->order)){
            if(""!=$this->order){
                $order = $this->order;
                $this->condition .=" ORDER BY ".$order[0]." ".$order[1];
            }
        }
        
        
        
        // AJOUT DU LIMIT
        if(!is_null($this->limit)){
            if(is_array($this->limit)){
                $limits = $this->limit;
                $this->condition .= " LIMIT ".$limits[0].",".$limits[1];
            }
            
        }
        
        Applog::ecrireLog("CONDITION THEMES SEARCH CRITERIA", "debug");
        Applog::ecrireLog($this->condition, "debug");
        
        return $this->condition;
    }
    
    public function getMotsCles() {
        return $this->MotsCles;
    }

    public function getId() {
        return $this->Id;
    }

    public function getLimit() {
        return $this->limit;
    }

    public function getOrder() {
        return $this->order;
    }

    public function setMotsCles($MotsCles) {
        $this->MotsCles = $MotsCles;
    }

    public function setId($Id) {
        $this->Id = $Id;
    }

    public function setLimit($limit) {
        $this->limit = $limit;
    }

    public function setOrder($order) {
        $this->order = $order;
    }



  

	
}



