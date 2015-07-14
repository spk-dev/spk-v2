<?php
require ('objetsCibles.class.php');
execution::loadEvenement();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of exec
 *
 * @author phwu963
 */
class execution {
    
    public static function loadEvenement(){
        $sql = "SELECT * FROM `spk-prod`.`adm_administrateur` ";
        try {
            $db = getConnection();
            $db->query('SET CHARACTER SET utf8');
            $stmt = $db->query($sql);
            $liste = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo "toto";die("titi");
            
        } catch(PDOException $e) {
            die("KO DANS LOADEVENEMENT");
        }
    }
    
}

?>
