<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of object
 *
 * @author phwu963
 */
class user {
    private $use_int_id;
    private $use_var_nom;
    private $use_var_prenom;
    private $use_var_mail;
    private $use_var_pwd;
    private $use_var_tel;
    private $use_pro_id;
    private $use_date_lastconnect;
    private $use_date_inscription;
    private $use_var_key;
    private $use_int_optin;
    private $use_var_unsuscribeKey;
    public function getUse_int_id() {
        return $this->use_int_id;
    }

    public function setUse_int_id($use_int_id) {
        $this->use_int_id = $use_int_id;
    }

    public function getUse_var_nom() {
        return $this->use_var_nom;
    }

    public function setUse_var_nom($use_var_nom) {
        $this->use_var_nom = $use_var_nom;
    }

    public function getUse_var_prenom() {
        return $this->use_var_prenom;
    }

    public function setUse_var_prenom($use_var_prenom) {
        $this->use_var_prenom = $use_var_prenom;
    }

    public function getUse_var_mail() {
        return $this->use_var_mail;
    }

    public function setUse_var_mail($use_var_mail) {
        $this->use_var_mail = $use_var_mail;
    }

    public function getUse_var_pwd() {
        return $this->use_var_pwd;
    }

    public function setUse_var_pwd($use_var_pwd) {
        $this->use_var_pwd = $use_var_pwd;
    }

    public function getUse_var_tel() {
        return $this->use_var_tel;
    }

    public function setUse_var_tel($use_var_tel) {
        $this->use_var_tel = $use_var_tel;
    }

    public function getUse_pro_id() {
        return $this->use_pro_id;
    }

    public function setUse_pro_id($use_pro_id) {
        $this->use_pro_id = $use_pro_id;
    }

    public function getUse_date_lastconnect() {
        return $this->use_date_lastconnect;
    }

    public function setUse_date_lastconnect($use_date_lastconnect) {
        $this->use_date_lastconnect = $use_date_lastconnect;
    }

    public function getUse_date_inscription() {
        return $this->use_date_inscription;
    }

    public function setUse_date_inscription($use_date_inscription) {
        $this->use_date_inscription = $use_date_inscription;
    }

    public function getUse_var_key() {
        return $this->use_var_key;
    }

    public function setUse_var_key($use_var_key) {
        $this->use_var_key = $use_var_key;
    }

    public function getUse_int_optin() {
        return $this->use_int_optin;
    }

    public function setUse_int_optin($use_int_optin) {
        $this->use_int_optin = $use_int_optin;
    }

    public function getUse_var_unsuscribeKey() {
        return $this->use_var_unsuscribeKey;
    }

    public function setUse_var_unsuscribeKey($use_var_unsuscribeKey) {
        $this->use_var_unsuscribeKey = $use_var_unsuscribeKey;
    }


    
}

class tor{
     private $tor_int_id;
     private $tor_var_libelle;
     private $tor_var_description;
     public function getTor_int_id() {
         return $this->tor_int_id;
     }

     public function setTor_int_id($tor_int_id) {
         $this->tor_int_id = $tor_int_id;
     }

     public function getTor_var_libelle() {
         return $this->tor_var_libelle;
     }

     public function setTor_var_libelle($tor_var_libelle) {
         $this->tor_var_libelle = $tor_var_libelle;
     }

     public function getTor_var_description() {
         return $this->tor_var_description;
     }

     public function setTor_var_description($tor_var_description) {
         $this->tor_var_description = $tor_var_description;
     }


}

class tme{
     private $tme_int_id;
     private $tme_var_libelle;
     
     public function getTme_int_id() {
         return $this->tme_int_id;
     }

     public function setTme_int_id($tme_int_id) {
         $this->tme_int_id = $tme_int_id;
     }

     public function getTme_var_libelle() {
         return $this->tme_var_libelle;
     }

     public function setTme_var_libelle($tme_var_libelle) {
         $this->tme_var_libelle = $tme_var_libelle;
     }


}

class tho{
     private $tho_the_id;
     private $tho_ocu_id;
     public function getTho_the_id() {
         return $this->tho_the_id;
     }

     public function setTho_the_id($tho_the_id) {
         $this->tho_the_id = $tho_the_id;
     }

     public function getTho_ocu_id() {
         return $this->tho_ocu_id;
     }

     public function setTho_ocu_id($tho_ocu_id) {
         $this->tho_ocu_id = $tho_ocu_id;
     }


}

class the{
     private $the_int_id;
     private $the_var_libelle;
     private $the_var_description;
     private $the_int_valid;
     
     public function getThe_int_id() {
         return $this->the_int_id;
     }

     public function setThe_int_id($the_int_id) {
         $this->the_int_id = $the_int_id;
     }

     public function getThe_var_libelle() {
         return $this->the_var_libelle;
     }

     public function setThe_var_libelle($the_var_libelle) {
         $this->the_var_libelle = $the_var_libelle;
     }

     public function getThe_var_description() {
         return $this->the_var_description;
     }

     public function setThe_var_description($the_var_description) {
         $this->the_var_description = $the_var_description;
     }

     public function getThe_int_valid() {
         return $this->the_int_valid;
     }

     public function setThe_int_valid($the_int_valid) {
         $this->the_int_valid = $the_int_valid;
     }


}

class tev{
     private $tev_int_id;
     private $tev_var_libelle;
     private $tev_var_description;
     
     public function getTev_int_id() {
         return $this->tev_int_id;
     }

     public function setTev_int_id($tev_int_id) {
         $this->tev_int_id = $tev_int_id;
     }

     public function getTev_var_libelle() {
         return $this->tev_var_libelle;
     }

     public function setTev_var_libelle($tev_var_libelle) {
         $this->tev_var_libelle = $tev_var_libelle;
     }

     public function getTev_var_description() {
         return $this->tev_var_description;
     }

     public function setTev_var_description($tev_var_description) {
         $this->tev_var_description = $tev_var_description;
     }


     
}

class pro{
     private $pro_int_id;
     private $pro_var_libelle;
     private $tev_var_description;
     
     public function getPro_int_id() {
         return $this->pro_int_id;
     }

     public function setPro_int_id($pro_int_id) {
         $this->pro_int_id = $pro_int_id;
     }

     public function getPro_var_libelle() {
         return $this->pro_var_libelle;
     }

     public function setPro_var_libelle($pro_var_libelle) {
         $this->pro_var_libelle = $pro_var_libelle;
     }

     public function getTev_var_description() {
         return $this->tev_var_description;
     }

     public function setTev_var_description($tev_var_description) {
         $this->tev_var_description = $tev_var_description;
     }


     
}

class pla{
        private $pla_int_id;
        private $pla_int_cp;
        private $pla_var_ville;
        private $pla_var_area2;
        private $pla_var_area1;
        private $pla_var_strnumber;
        private $pla_var_route;
        private $pla_var_pays;
        private $pla_dec_lat;
        private $pla_dec_long;
        
        public function getPla_int_id() {
            return $this->pla_int_id;
        }

        public function setPla_int_id($pla_int_id) {
            $this->pla_int_id = $pla_int_id;
        }

        public function getPla_int_cp() {
            return $this->pla_int_cp;
        }

        public function setPla_int_cp($pla_int_cp) {
            $this->pla_int_cp = $pla_int_cp;
        }

        public function getPla_var_ville() {
            return $this->pla_var_ville;
        }

        public function setPla_var_ville($pla_var_ville) {
            $this->pla_var_ville = $pla_var_ville;
        }

        public function getPla_var_area2() {
            return $this->pla_var_area2;
        }

        public function setPla_var_area2($pla_var_area2) {
            $this->pla_var_area2 = $pla_var_area2;
        }

        public function getPla_var_area1() {
            return $this->pla_var_area1;
        }

        public function setPla_var_area1($pla_var_area1) {
            $this->pla_var_area1 = $pla_var_area1;
        }

        public function getPla_var_strnumber() {
            return $this->pla_var_strnumber;
        }

        public function setPla_var_strnumber($pla_var_strnumber) {
            $this->pla_var_strnumber = $pla_var_strnumber;
        }

        public function getPla_var_route() {
            return $this->pla_var_route;
        }

        public function setPla_var_route($pla_var_route) {
            $this->pla_var_route = $pla_var_route;
        }

        public function getPla_var_pays() {
            return $this->pla_var_pays;
        }

        public function setPla_var_pays($pla_var_pays) {
            $this->pla_var_pays = $pla_var_pays;
        }

        public function getPla_dec_lat() {
            return $this->pla_dec_lat;
        }

        public function setPla_dec_lat($pla_dec_lat) {
            $this->pla_dec_lat = $pla_dec_lat;
        }

        public function getPla_dec_long() {
            return $this->pla_dec_long;
        }

        public function setPla_dec_long($pla_dec_long) {
            $this->pla_dec_long = $pla_dec_long;
        }


}


class org{
    private $org_int_id;
    private $org_var_libelle;
    private $org_var_description;
    private $org_var_hebergement;
    private $org_var_deplacement;
    private $org_var_siteweb;
    private $org_var_mail;
    private $org_var_tel;
    private $org_var_fax;
    private $org_date_enregistrement;
    private $org_com_int_id;
    private $org_pla_int_id;
    private $org_tor_int_id;
    private $org_boo_valid_admin;
    private $org_boo_valid_super_admin;
    
    public function getOrg_int_id() {
        return $this->org_int_id;
    }

    public function setOrg_int_id($org_int_id) {
        $this->org_int_id = $org_int_id;
    }

    public function getOrg_var_libelle() {
        return $this->org_var_libelle;
    }

    public function setOrg_var_libelle($org_var_libelle) {
        $this->org_var_libelle = $org_var_libelle;
    }

    public function getOrg_var_description() {
        return $this->org_var_description;
    }

    public function setOrg_var_description($org_var_description) {
        $this->org_var_description = $org_var_description;
    }

    public function getOrg_var_hebergement() {
        return $this->org_var_hebergement;
    }

    public function setOrg_var_hebergement($org_var_hebergement) {
        $this->org_var_hebergement = $org_var_hebergement;
    }

    public function getOrg_var_deplacement() {
        return $this->org_var_deplacement;
    }

    public function setOrg_var_deplacement($org_var_deplacement) {
        $this->org_var_deplacement = $org_var_deplacement;
    }

    public function getOrg_var_siteweb() {
        return $this->org_var_siteweb;
    }

    public function setOrg_var_siteweb($org_var_siteweb) {
        $this->org_var_siteweb = $org_var_siteweb;
    }

    public function getOrg_var_mail() {
        return $this->org_var_mail;
    }

    public function setOrg_var_mail($org_var_mail) {
        $this->org_var_mail = $org_var_mail;
    }

    public function getOrg_var_tel() {
        return $this->org_var_tel;
    }

    public function setOrg_var_tel($org_var_tel) {
        $this->org_var_tel = $org_var_tel;
    }

    public function getOrg_var_fax() {
        return $this->org_var_fax;
    }

    public function setOrg_var_fax($org_var_fax) {
        $this->org_var_fax = $org_var_fax;
    }

    public function getOrg_date_enregistrement() {
        return $this->org_date_enregistrement;
    }

    public function setOrg_date_enregistrement($org_date_enregistrement) {
        $this->org_date_enregistrement = $org_date_enregistrement;
    }

    public function getOrg_com_int_id() {
        return $this->org_com_int_id;
    }

    public function setOrg_com_int_id($org_com_int_id) {
        $this->org_com_int_id = $org_com_int_id;
    }

    public function getOrg_pla_int_id() {
        return $this->org_pla_int_id;
    }

    public function setOrg_pla_int_id($org_pla_int_id) {
        $this->org_pla_int_id = $org_pla_int_id;
    }

    public function getOrg_tor_int_id() {
        return $this->org_tor_int_id;
    }

    public function setOrg_tor_int_id($org_tor_int_id) {
        $this->org_tor_int_id = $org_tor_int_id;
    }

    public function getOrg_boo_valid_admin() {
        return $this->org_boo_valid_admin;
    }

    public function setOrg_boo_valid_admin($org_boo_valid_admin) {
        $this->org_boo_valid_admin = $org_boo_valid_admin;
    }

    public function getOrg_boo_valid_super_admin() {
        return $this->org_boo_valid_super_admin;
    }

    public function setOrg_boo_valid_super_admin($org_boo_valid_super_admin) {
        $this->org_boo_valid_super_admin = $org_boo_valid_super_admin;
    }



}

class ocu{
    private $ocu_eve_id;
    private $ocu_pla_id;
    private $ocu_date_debut;
    private $ocu_date_fin;
    private $ocu_int_id;
    
    public function getOcu_eve_id() {
        return $this->ocu_eve_id;
    }

    public function setOcu_eve_id($ocu_eve_id) {
        $this->ocu_eve_id = $ocu_eve_id;
    }

    public function getOcu_pla_id() {
        return $this->ocu_pla_id;
    }

    public function setOcu_pla_id($ocu_pla_id) {
        $this->ocu_pla_id = $ocu_pla_id;
    }

    public function getOcu_date_debut() {
        return $this->ocu_date_debut;
    }

    public function setOcu_date_debut($ocu_date_debut) {
        $this->ocu_date_debut = $ocu_date_debut;
    }

    public function getOcu_date_fin() {
        return $this->ocu_date_fin;
    }

    public function setOcu_date_fin($ocu_date_fin) {
        $this->ocu_date_fin = $ocu_date_fin;
    }

    public function getOcu_int_id() {
        return $this->ocu_int_id;
    }

    public function setOcu_int_id($ocu_int_id) {
        $this->ocu_int_id = $ocu_int_id;
    }


}

class med{
    private $med_int_id;
    private $med_var_url;
    private $med_tme_id;
    private $med_int_ordre;
    private $med_eve_id;
    private $med_org_id;
    
    public function getMed_int_id() {
        return $this->med_int_id;
    }

    public function setMed_int_id($med_int_id) {
        $this->med_int_id = $med_int_id;
    }

    public function getMed_var_url() {
        return $this->med_var_url;
    }

    public function setMed_var_url($med_var_url) {
        $this->med_var_url = $med_var_url;
    }

    public function getMed_tme_id() {
        return $this->med_tme_id;
    }

    public function setMed_tme_id($med_tme_id) {
        $this->med_tme_id = $med_tme_id;
    }

    public function getMed_int_ordre() {
        return $this->med_int_ordre;
    }

    public function setMed_int_ordre($med_int_ordre) {
        $this->med_int_ordre = $med_int_ordre;
    }

    public function getMed_eve_id() {
        return $this->med_eve_id;
    }

    public function setMed_eve_id($med_eve_id) {
        $this->med_eve_id = $med_eve_id;
    }

    public function getMed_org_id() {
        return $this->med_org_id;
    }

    public function setMed_org_id($med_org_id) {
        $this->med_org_id = $med_org_id;
    }



}

class ioc{
    private $ioc_int_id;
    private $ioc_ocu_id;
    public function getIoc_int_id() {
        return $this->ioc_int_id;
    }

    public function setIoc_int_id($ioc_int_id) {
        $this->ioc_int_id = $ioc_int_id;
    }

    public function getIoc_ocu_id() {
        return $this->ioc_ocu_id;
    }

    public function setIoc_ocu_id($ioc_ocu_id) {
        $this->ioc_ocu_id = $ioc_ocu_id;
    }


}

class eve{
    private $eve_int_id;
    private $eve_var_libelle;
    private $eve_var_description;
    private $eve_var_mail_inscription;
    private $eve_var_contact;
    private $eve_var_prix;
    private $eve_var_url;
    private $eve_var_gardeenfant;
    private $eve_var_hebergement;
    private $eve_org_int_id;
    private $eve_tev_int_id;
    private $eve_date_enregistrement;
    public function getEve_int_id() {
        return $this->eve_int_id;
    }

    public function setEve_int_id($eve_int_id) {
        $this->eve_int_id = $eve_int_id;
    }

    public function getEve_var_libelle() {
        return $this->eve_var_libelle;
    }

    public function setEve_var_libelle($eve_var_libelle) {
        $this->eve_var_libelle = $eve_var_libelle;
    }

    public function getEve_var_description() {
        return $this->eve_var_description;
    }

    public function setEve_var_description($eve_var_description) {
        $this->eve_var_description = $eve_var_description;
    }

    public function getEve_var_mail_inscription() {
        return $this->eve_var_mail_inscription;
    }

    public function setEve_var_mail_inscription($eve_var_mail_inscription) {
        $this->eve_var_mail_inscription = $eve_var_mail_inscription;
    }

    public function getEve_var_contact() {
        return $this->eve_var_contact;
    }

    public function setEve_var_contact($eve_var_contact) {
        $this->eve_var_contact = $eve_var_contact;
    }

    public function getEve_var_prix() {
        return $this->eve_var_prix;
    }

    public function setEve_var_prix($eve_var_prix) {
        $this->eve_var_prix = $eve_var_prix;
    }

    public function getEve_var_url() {
        return $this->eve_var_url;
    }

    public function setEve_var_url($eve_var_url) {
        $this->eve_var_url = $eve_var_url;
    }

    public function getEve_var_gardeenfant() {
        return $this->eve_var_gardeenfant;
    }

    public function setEve_var_gardeenfant($eve_var_gardeenfant) {
        $this->eve_var_gardeenfant = $eve_var_gardeenfant;
    }

    public function getEve_var_hebergement() {
        return $this->eve_var_hebergement;
    }

    public function setEve_var_hebergement($eve_var_hebergement) {
        $this->eve_var_hebergement = $eve_var_hebergement;
    }

    public function getEve_org_int_id() {
        return $this->eve_org_int_id;
    }

    public function setEve_org_int_id($eve_org_int_id) {
        $this->eve_org_int_id = $eve_org_int_id;
    }

    public function getEve_tev_int_id() {
        return $this->eve_tev_int_id;
    }

    public function setEve_tev_int_id($eve_tev_int_id) {
        $this->eve_tev_int_id = $eve_tev_int_id;
    }

    public function getEve_date_enregistrement() {
        return $this->eve_date_enregistrement;
    }

    public function setEve_date_enregistrement($eve_date_enregistrement) {
        $this->eve_date_enregistrement = $eve_date_enregistrement;
    }

}

class ado{
     private $ado_use_id;
     private $ado_org_id;
     private $ado_main_organisateur;
     public function getAdo_use_id() {
         return $this->ado_use_id;
     }

     public function setAdo_use_id($ado_use_id) {
         $this->ado_use_id = $ado_use_id;
     }

     public function getAdo_org_id() {
         return $this->ado_org_id;
     }

     public function setAdo_org_id($ado_org_id) {
         $this->ado_org_id = $ado_org_id;
     }

     public function getAdo_main_organisateur() {
         return $this->ado_main_organisateur;
     }

     public function setAdo_main_organisateur($ado_main_organisateur) {
         $this->ado_main_organisateur = $ado_main_organisateur;
     }


}







?>
