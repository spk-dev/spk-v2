<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tag
 *
 * @author xpdf585
 */
class TagEvenement {
    //put your code here
    private $idEvenement;
    private $mot;
    const K_separateur = ',';


    function __construct($id) {
        if ( !empty($id))
        {
            $condition = 'and tae_eve_id='.$id;
            $requete = new Query($condition);
            $requete->getTagsEvenement();
            $tagEvenements = $requete->executeQuery(); 
            foreach ( $tagEvenements as $tagEvenement ) {
                $this->idEvenement = $tagEvenement['tae_eve_id'];
                $this->mot[] = $tagEvenement['tag_var_mot'];           
            }
        }
    }
    
    public function getId() {
        return $this->idEvenement;
    }
    
    public function getListeMots() {
        return  count($this->mot) > 0?implode(self::K_separateur,$this->mot):'';
    }
    
    public function setLibelleTypeEvenement($libelle) {
        $this->libelleTypeEvenement = $libelle;
    }
    
    public function getDescriptionTypeEvenement() {
        return $this->descriptionTypeEvenement;
    }
    
    public function setDescriptionTypeEvenement($description) {
        $this->descriptionTypeEvenement = $description;
    }   
}
