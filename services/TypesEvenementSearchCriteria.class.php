<?php

class TypesEvenementSearchCriteria{
    
    private $condition;
    
    private $motscles;
    private $id;
    private $limit;
    private $order;
    

 
// Genere la condition pour la requete SQL
    public function getCondition(){
        
        $listeCritere = array();
        
        // Champ ID
        if(!is_null($this->id)){
            if(is_array($this->id)){
                if(sizeof($this->id)>0){
                    
                    $clauseType = "tev_int_id IN (";
                    
                    for ($i = 0; $i < sizeof($this->id); $i++) {
                        $clauseType .= $this->id[$i];
                        if($i!=sizeof($this->id)-1){
                            $clauseType .=",";
                        }
                    }
                    $clauseType .= ")";
                    array_push($listeCritere, $clauseType);      
                }  
            }   
        }
        
       
        
        // CHAMP DES MOTS CLES
        if(!is_null($this->motscles)){    
            if(""!=$this->motscles){
                //$keywords = $this->RetraiteMotsCles;
                $tabWors = explode(" ", $this->motscles);
                $clauseKeyWords = "";
                $nbWords = count($tabWors);

                if($nbWords>1){
                    // Mot clé sur le Nom du lieu
                    $clauseKeyWords .="(";
                    for ($i = 0; $i < $nbWords; $i++) {
                        $clauseKeyWords .= "(tev_var_nom like '%".$tabWors[$i]."%')";
                        if($i<$nbWords-1){
                            $clauseKeyWords .= " AND ";
                        }
                    }
                    $clauseKeyWords .=") OR (";

                    // Mot clé sur la description
                    for ($i = 0; $i < $nbWords; $i++) {
                        $clauseKeyWords .= "(tev_var_nom like '%".$tabWors[$i]."%')";
                        if($i<$nbWords-1){
                            $clauseKeyWords .= " AND ";
                        }
                    }
                    $clauseKeyWords .=")";
                }else{
                    $clauseKeyWords = "((tev_var_nom like '%".$tabWors[0]."%') OR (tev_var_nom LIKE '%".$tabWors[0]."%'))";
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
                
        return $this->condition;
    }
    
    
    
    
    public function getTypesMotsCles() {
        return $this->motscles;
    }

    public function getTypesId() {
        return $this->id;
    }

    public function getLimit() {
        return $this->limit;
    }

    public function getOrder() {
        return $this->order;
    }

    public function setTypesMotsCles($TypesMotsCles) {
        $this->motscles = $TypesMotsCles;
    }

    public function setTypesId($TypesId) {
        $this->id = $TypesId;
    }

    public function setLimit($limit) {
        $this->limit = $limit;
    }

    public function setOrder($order) {
        $this->order = $order;
    }


  

	
}



