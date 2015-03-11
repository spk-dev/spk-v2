
<?php

class imageTreatment{

private static function getSize($cat){
    
        $tab['intervenant']     =   array(array(60,60),array(200,200));     // default image ok
        $tab['lieu']            =   array(array(260,130),array(600,300));   // default image ok
        $tab['evenement']        =   array(array(260,130),array(520,260));   // default image ok
        $tab['theme']           =   array(array(60,60),array(260,130));     // default image ok
        $tab['type']            =   array(array(60,60),array(260,130));     // default image ok
        $tab['communaute']      =   array(array(60,60),array(260,130));     // default image ok
        
        if(key_exists($cat, $tab)){
            return $tab[$cat];
        }else{
            Applog::ecrireLog("Erreur dans imageTreatment getSize, le type ".$cat." n'existe pas.", "debug");
            return false;
        }
}

    
public static function renameImage($fichier){
    $fichier = strtolower($fichier);
    $fichier = strtr($fichier, 
    'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
    'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
    $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
    return $fichier;
}    


/**
 * Gestion des upload, reductions et découpe d'image
 * @param string $context = on précise si on parle de retraite, de lieu, de theme....
 * @param string $fileFieldName = nom du champ de form pour l'upload d'image.
 * @param string $nomDuFichier Nom complet donné au fichier (sans extension)
 * @param string $prefixMiniature string qui sera ajouter au nom du fichier pour les miniatures
 * @param string $dossierPrincipal Chemin complet (relatif à la home page) de la grande image. (se termine par / )
 * @param string $dossierMiniature Chemin complet (relatif à la home page) de la miniature. (se termine par / )
 * @return boolean
 */
public static function imageManage($context,$fileFieldName,$nomDuFichier,$prefixMiniature,$dossierPrincipal, $dossierMiniature,$dossierOriginal){
    

    
    $taille_maxi = 6000000;
    $extensionsAllowed = array('.png', '.gif', '.jpg', '.jpeg','.PNG', '.GIF', '.JPG', '.JPEG');
    $dimensions = self::getSize($context);
    $conforme = true;
    // si les dimensions n'existent pas, on sort en false
    if(!$dimensions){
        return false;
    }else{
        $minLarg = $dimensions[0][0];
        $minHaut = $dimensions[0][1];
        $maxLarg = $dimensions[1][0];
        $maxHaut = $dimensions[1][1];
        
       
        $taille = filesize($_FILES[$fileFieldName]['tmp_name']);
        $extension = strrchr($_FILES[$fileFieldName]['name'], '.'); 
        
        /**
         * 1. On vérifie si le fichier est bien conforme (extensions)
         * 2. On vérifie si la taille ne dépasse pas la taille max.
         */
       
        if(!in_array($extension,$extensionsAllowed)){
            $conforme = false;
        }
        
        if($taille > $taille_maxi){
            $conforme = false;
        }
        
        /**
         * 1. on upload l'image dans le rep principal
         * 2. on réduit la taille à la max de haut et long
         * 3. on rogne l'autre mesure.
         * 4. on créé une copie dans le rep small
         * 5. on réduit la taille à la max de haut et long
         * 6. on rogne l'autre mesure.
         */
        if($conforme){
            if(move_uploaded_file($_FILES[$fileFieldName]['tmp_name'], $dossierPrincipal.$nomDuFichier)){
                Applog::ecrireLog("DANS IMAGE TREATMENT - APRES MOVE", "debug");
                if(copy($dossierPrincipal.$nomDuFichier, $dossierOriginal.$nomDuFichier)){
                    Applog::ecrireLog("DANS IMAGE TREATMENT - APRES COPY", "debug");
                    if(self::fctredimimage($maxLarg, $maxHaut, "", "", $dossierPrincipal, $nomDuFichier)){
                        Applog::ecrireLog("DANS IMAGE TREATMENT - APRES FCT", "debug");
                        if(!self::fctcropimage($maxLarg, $maxHaut, "", "", $dossierPrincipal, $nomDuFichier)){
                            Applog::ecrireLog("1 Impossible de rogner le fichier  [".$dossierPrincipal.$nomDuFichier."]", "debug");
                        }else{
                            Applog::ecrireLog("DANS IMAGE TREATMENT - APRES CROP", "debug");
                        }
                    }else{
                        Applog::ecrireLog("2 Impossible de redimmensionner le fichier  [".$dossierPrincipal.$nomDuFichier."]", "debug");
                    }
                }else{
                    Applog::ecrireLog("3 Impossible de copier le fichier [".$dossierPrincipal.$nomDuFichier."]", "debug");
                    Applog::ecrireLog("Dans [".$dossierOriginal.$nomDuFichier."]", "debug");
                }
            }else{
                Applog::ecrireLog("Photo à télécharger du champ : [".$fileFieldName."] = [".$_FILES[$fileFieldName]['tmp_name']."]", "debug");
                Applog::ecrireLog("4 Impossible de telecharger  la photo dans : [".$dossierPrincipal.$nomDuFichier."]", "debug");
            }
            
            Applog::ecrireLog("DANS IMAGETREATMENT  :: image Manage", "debug");
            Applog::ecrireLog("copy de : [".$dossierPrincipal.$nomDuFichier."]", "debug");
            Applog::ecrireLog("dans : [".$dossierMiniature.$prefixMiniature."_".$nomDuFichier."]", "debug");
            
            
            if(copy($dossierPrincipal.$nomDuFichier, $dossierMiniature.$prefixMiniature."_".$nomDuFichier)){
//              //L'image est téléchargée dans le répertoire.
                // Process taille
                if(self::fctredimimage($minLarg, $minHaut, "", "", $dossierMiniature,$prefixMiniature."_".$nomDuFichier)){
                    // L'image est réduite
                    if(!self::fctcropimage($minLarg, $minHaut, "", "", $dossierMiniature,$prefixMiniature."_".$nomDuFichier)){
                      Applog::ecrireLog("5 Impossible de rogner le fichier  [".$dossierMiniature,$prefixMiniature."_".$nomDuFichier."]", "debug");
                    }
                }else{
                        Applog::ecrireLog("6 Impossible de redimmensionner le fichier  [".$dossierMiniature,$prefixMiniature."_".$nomDuFichier."]", "debug");
                    }
            }else{
                    Applog::ecrireLog("7 Impossible de copier le fichier [".$dossierPrincipal.$nomDuFichier."]", "debug");
                    Applog::ecrireLog("Dans [".$dossierMiniature.$prefixMiniature."_".$nomDuFichier."]", "debug");
                }
        }else{
            
        }
        
        
        
        
    }
    return $conforme;
    
}

  
    
/** 	---------------------------------------------------------------
* fonction de REDIMENSIONNEMENT physique "PROPORTIONNEL" et Enregistrement
* 	---------------------------------------------------------------
* retourne : 1 (vrai) si le redimensionnement et l enregistrement ont bien eu lieu, sinon rien (false)
* 	---------------------------------------------------------------
* La FONCTION : fctredimimage ($W_max, $H_max, $rep_Dst, $img_Dst, $rep_Src, $img_Src)
* Les parametres :
* - $W_max : LARGEUR maxi finale --> ou 0
* - $H_max : HAUTEUR maxi finale --> ou 0
* - $rep_Dst : repertoire de l image de Destination (deprotégé) --> ou '' (meme repertoire)
* - $img_Dst : NOM de l image de Destination --> ou '' (meme nom que l image Source)
* - $rep_Src : repertoire de l image Source (deprotégé)
* - $img_Src : NOM de l image Source
* 	---------------------------------------------------------------
* 3 options :
* A- si $W_max != 0 et $H_max != 0 : a LARGEUR maxi ET HAUTEUR maxi fixes
* B- si $H_max != 0 et $W_max == 0 : image finale a HAUTEUR maxi fixe (largeur auto)
* C- si $W_max == 0 et $H_max != 0 : image finale a LARGEUR maxi fixe (hauteur auto)
* Si l'image Source est plus petite que les dimensions indiquees : PAS de redimensionnement.
* 	---------------------------------------------------------------
* $rep_Dst : il faut s'assurer que les droits en écriture ont été donnés au dossier (chmod)
* - si $rep_Dst = ''   : $rep_Dst = $rep_Src (meme repertoire que l image Source)
* - si $img_Dst = '' : $img_Dst = $img_Src (meme nom que l image Source)
* - si $rep_Dst='' ET $img_Dst='' : on ecrase (remplace) l image source !
* 	---------------------------------------------------------------
* NB : $img_Dst et $img_Src doivent avoir la meme extension (meme type mime) !
* Extensions acceptees (traitees ici) : .jpg , .jpeg , .png
* Pour ajouter d autres extensions : voir la bibliotheque GD ou ImageMagick
* (GD) NE fonctionne PAS avec les GIF ANIMES ou a fond transparent !
* 	---------------------------------------------------------------
* UTILISATION (exemple) :
* $redimOK = fctredimimage(120,80,'reppicto/','monpicto.jpg','repimage/','monimage.jpg');
* if ($redimOK == 1) { echo 'Redimensionnement OK !';  }
* 	--------------------------------------------------------------- */

/**
 *  Redimensionnement des images 
 * @param type $W_max
 * @param type $H_max
 * @param type $rep_Dst
 * @param type $img_Dst
 * @param type $rep_Src
 * @param type $img_Src
 * @return boolean 
 */    
public static function fctredimimage($W_max, $H_max, $rep_Dst, $img_Dst, $rep_Src, $img_Src) {
 // ------------------------------------------------------------------
 $condition = 0;
 // Si certains parametres ont pour valeur '' :
   if ($rep_Dst == '') { $rep_Dst = $rep_Src; } // (meme repertoire)
   if ($img_Dst == '') { $img_Dst = $img_Src; } // (meme nom)
 // ------------------------------------------------------------------
 // si le fichier existe dans le répertoire, on continue...
 if (file_exists($rep_Src.$img_Src) && ($W_max!=0 || $H_max!=0)) { 
   // ----------------------------------------------------------------
   // extensions acceptees : 
   $ExtfichierOK = '" jpg jpeg png"'; // (l espace avant jpg est important)
   // extension fichier Source
   $tabimage = explode('.',$img_Src);
   $extension = $tabimage[sizeof($tabimage)-1]; // dernier element
   $extension = strtolower($extension); // on met en minuscule
   // ----------------------------------------------------------------
   // extension OK ? on continue ...
   if (strpos($ExtfichierOK,$extension) != '') {
      // -------------------------------------------------------------
      // recuperation des dimensions de l image Src
      $img_size = getimagesize($rep_Src.$img_Src);
      $W_Src = $img_size[0]; // largeur
      $H_Src = $img_size[1]; // hauteur
      // -------------------------------------------------------------
      // condition de redimensionnement et dimensions de l image finale
      // -------------------------------------------------------------
      // A- LARGEUR ET HAUTEUR maxi fixes
      if ($W_max != 0 && $H_max != 0) {
         $ratiox = $W_Src / $W_max; // ratio en largeur
         $ratioy = $H_Src / $H_max; // ratio en hauteur
//         $ratio = max($ratiox,$ratioy); // le plus grand
         //BTE La photo sera coupée par la suite, il faut donc le min ratio.    
        $ratio = min($ratiox,$ratioy); 
         // FIN BTE
         $W = $W_Src/$ratio;
         $H = $H_Src/$ratio;   
         $condition = ($W_Src>$W) || ($W_Src>$H); // 1 si vrai (true)
      }      // -------------------------------------------------------------
      // B- HAUTEUR maxi fixe
      if ($W_max == 0 && $H_max != 0) {
         $H = $H_max;
         $W = $H * ($W_Src / $H_Src);
         $condition = $H_Src > $H_max; // 1 si vrai (true)
      }
      // -------------------------------------------------------------
      // C- LARGEUR maxi fixe
      if ($W_max != 0 && $H_max == 0) {
         $W = $W_max;
         $H = $W * ($H_Src / $W_Src);         
         $condition = $W_Src > $W_max; // 1 si vrai (true)
      }
      // -------------------------------------------------------------
      // on REDIMENSIONNE si la condition est vraie
      // -------------------------------------------------------------
      // Par defaut : 
	  // Si l'image Source est plus petite que les dimensions indiquees :
	  // PAS de redimensionnement.
	  // Mais on peut "forcer" le redimensionnement en ajoutant ici :
	  // $condition = 1;
      if ($condition == 1) {
         // ----------------------------------------------------------
         // creation de la ressource-image "Src" en fonction de l extension
         switch($extension) {
         case 'jpg':
         case 'jpeg':
           $Ress_Src = imagecreatefromjpeg($rep_Src.$img_Src);
           break;
         case 'png':
           $Ress_Src = imagecreatefrompng($rep_Src.$img_Src);
           break;
         }
         // ----------------------------------------------------------
         // creation d une ressource-image "Dst" aux dimensions finales
         // fond noir (par defaut)
         switch($extension) {
         case 'jpg':
         case 'jpeg':
           $Ress_Dst = imagecreatetruecolor($W,$H);
           break;
         case 'png':
           $Ress_Dst = imagecreatetruecolor($W,$H);
           // fond transparent (pour les png avec transparence)
           imagesavealpha($Ress_Dst, true);
           $trans_color = imagecolorallocatealpha($Ress_Dst, 0, 0, 0, 127);
           imagefill($Ress_Dst, 0, 0, $trans_color);
           break;
         }
         // ----------------------------------------------------------
         // REDIMENSIONNEMENT (copie, redimensionne, re-echantillonne)
         imagecopyresampled($Ress_Dst, $Ress_Src, 0, 0, 0, 0, $W, $H, $W_Src, $H_Src); 
         // ----------------------------------------------------------
         // ENREGISTREMENT dans le repertoire (avec la fonction appropriee)
         switch ($extension) { 
         case 'jpg':
         case 'jpeg':
           imagejpeg ($Ress_Dst, $rep_Dst.$img_Dst);
           break;
         case 'png':
           imagepng ($Ress_Dst, $rep_Dst.$img_Dst);
           break;
         }
         // ----------------------------------------------------------
         // liberation des ressources-image
         imagedestroy ($Ress_Src);
         imagedestroy ($Ress_Dst);
      }
      // -------------------------------------------------------------
   }
 }
// 	---------------------------------------------------------------
 // si le fichier a bien ete cree
 if ($condition == 1 && file_exists($rep_Dst.$img_Dst)) { return true; }
 else { return false; }
}


/** retourne : 1 (vrai) si le redimensionnement et l enregistrement ont bien eu lieu, sinon rien (false)
* 	---------------------------------------------------------------



* 	---------------------------------------------------------------
* fonction de REDIMENSIONNEMENT physique "CROP CENTRE" et Enregistrement
* 	---------------------------------------------------------------
* retourne : 1 (vrai) si le redimensionnement et l enregistrement ont bien eu lieu, sinon rien (false)
* 	---------------------------------------------------------------
* La FONCTION : fctcropimage ($W_fin, $H_fin, $rep_Dst, $img_Dst, $rep_Src, $img_Src)
* Les parametres :
* - $W_fin : LARGEUR finale --> ou 0
* - $H_fin : HAUTEUR finale --> ou 0
* - $rep_Dst : repertoire de l image de Destination (déprotégé) --> ou ''
* - $img_Dst : NOM de l image de Destination --> ou ''
* - $rep_Src : repertoire de l image Source (déprotégé)
* - $img_Src : NOM de l image Source
* 	---------------------------------------------------------------
* 4 options :
* A- si $W_fin != 0 et $H_fin != 0 : crop aux dimensions indiquees
* B- si $W_fin == 0 et $H_fin != 0 : crop en HAUTEUR (meme largeur que la source)
* C- si $W_fin != 0 et $H_fin == 0 : crop en LARGEUR (meme hauteur que la source)
* D- si $W_fin == 0 et $H_fin == 0 : (special) crop "carre" a la plus petite dimension de l image source
* 	---------------------------------------------------------------
* $rep_Dst : il faut s'assurer que les droits en écriture ont été donnés au dossier (chmod)
* - si $rep_Dst = '' --> $rep_Dst = $rep_Src (meme repertoire que le repertoire Source)
* - si $img_Dst = '' --> $img_Dst = $img_Src (meme nom que l image Source)
* - si $rep_Dst = '' ET $img_Dst = '' --> on ecrase (remplace) l image source ($img_Src) !
* 	---------------------------------------------------------------
* NB : $img_Dst et $img_Src doivent avoir la meme extension (meme type mime) !
* Extensions acceptees (traitees ici) : .jpg , .jpeg , .png
* Pour ajouter d autres extensions : voir la bibliotheque GD ou ImageMagick
* (GD) NE fonctionne PAS avec les GIF ANIMES ou a fond transparent !
* 	---------------------------------------------------------------
* UTILISATION (exemple) :
* $cropOK = fctcropimage(120,80,'reppicto/','monpicto.jpg','repimage/','monimage.jpg');
* if ($cropOK == 1) { echo 'Crop centré OK !';  }
* 	---------------------------------------------------------------
* 
*/

/**
 * Crop l'image
 * @param type $W_fin
 * @param type $H_fin
 * @param type $rep_Dst
 * @param type $img_Dst
 * @param type $rep_Src
 * @param type $img_Src
 * @return boolean 
 */
public static function fctcropimage($W_fin, $H_fin, $rep_Dst, $img_Dst, $rep_Src, $img_Src) {
 // ------------------------------------------------------------------
 $condition = 0;
 // Si certains parametres ont pour valeur '' :
   if ($rep_Dst == '') { $rep_Dst = $rep_Src; } // (meme repertoire)
   if ($img_Dst == '') { $img_Dst = $img_Src; } // (meme nom)
 // ------------------------------------------------------------------
 // si le fichier existe dans le répertoire, on continue...
 if (file_exists($rep_Src.$img_Src)) { 
   // ----------------------------------------------------------------
   // extensions acceptees : 
   $ExtfichierOK = '" jpg jpeg png"'; // (l espace avant jpg est important)
   // extension fichier Source
   $tabimage = explode('.',$img_Src);
   $extension = $tabimage[sizeof($tabimage)-1]; // dernier element
   $extension = strtolower($extension); // on met en minuscule
   // ----------------------------------------------------------------
   // extension OK ? on continue ...
   if (strpos($ExtfichierOK,$extension) != '') {
      // -------------------------------------------------------------
      $condition = 1;
      // -------------------------------------------------------------
      // recuperation des dimensions de l image Source
      $img_size = getimagesize($rep_Src.$img_Src);
      $W_Src = $img_size[0]; // largeur
      $H_Src = $img_size[1]; // hauteur
      // -------------------------------------------------------------
      // condition de crop et dimensions de l image finale
      // -------------------------------------------------------------
      // A- crop aux dimensions indiquees
      if ($W_fin != 0 && $H_fin != 0) {
         $W = $W_fin;
         $H = $H_fin;
      }      // -------------------------------------------------------------
      // B- crop en HAUTEUR (meme largeur que la source)
      if ($W_fin == 0 && $H_fin != 0) {
         $H = $H_fin;
         $W = $W_Src;
      }
      // -------------------------------------------------------------
      // C- crop en LARGEUR (meme hauteur que la source)
      if ($W_fin != 0 && $H_fin == 0) {
         $W = $W_fin;
         $H = $H_Src;         
      }
      // D- crop "carre" a la plus petite dimension de l image source
      if ($W_fin == 0 && $H_fin == 0) {
         if ($W_Src >= $H_Src) {
         $W = $H_Src;
         $H = $H_Src;
         } else {
         $W = $W_Src;
         $H = $W_Src;
         }   
      }
      // -------------------------------------------------------------
      // creation de la ressource-image "Src" en fonction de l extension
      switch($extension) {
      case 'jpg':
      case 'jpeg':
         $Ress_Src = imagecreatefromjpeg($rep_Src.$img_Src);
         break;
      case 'png':
         $Ress_Src = imagecreatefrompng($rep_Src.$img_Src);
         break;
      }
      // ----------------------------------------------------------
      // creation d une ressource-image "Dst" aux dimensions finales
      // fond noir (par defaut)
      switch($extension) {
      case 'jpg':
      case 'jpeg':
         $Ress_Dst = imagecreatetruecolor($W,$H);
         // fond blanc
         $blanc = imagecolorallocate ($Ress_Dst, 255, 255, 255);
         imagefill ($Ress_Dst, 0, 0, $blanc);
         break;
      case 'png':
         $Ress_Dst = imagecreatetruecolor($W,$H);
         // fond transparent (pour les png avec transparence)
         imagesavealpha($Ress_Dst, true);
         $trans_color = imagecolorallocatealpha($Ress_Dst, 0, 0, 0, 127);
         imagefill($Ress_Dst, 0, 0, $trans_color);
         break;
      }
      // -------------------------------------------------------------
      // CENTRAGE du crop
      // coordonnees du point d origine Scr : $X_Src, $Y_Src
      // coordonnees du point d origine Dst : $X_Dst, $Y_Dst
      // dimensions de la portion copiee : $W_copy, $H_copy
      // -------------------------------------------------------------
      // CENTRAGE en largeur
      if ($W_fin == 0) {
         if ($H_fin == 0 && $W_Src < $H_Src) {
            $X_Src = 0;
            $X_Dst = 0;
            $W_copy = $W_Src;
         } else {
            $X_Src = 0;
            $X_Dst = ($W - $W_Src) /2;
            $W_copy = $W_Src;
         }
      } else {
         if ($W_Src > $W) {
            $X_Src = ($W_Src - $W) /2;
            $X_Dst = 0;
            $W_copy = $W;
         } else {
            $X_Src = 0;
            $X_Dst = ($W - $W_Src) /2;
            $W_copy = $W_Src;
         }
      }
      // -------------------------------------------------------------
      // CENTRAGE en hauteur
      if ($H_fin == 0) {
         if ($W_fin == 0 && $H_Src < $W_Src) {
            $Y_Src = 0;
            $Y_Dst = 0;
            $H_copy = $H_Src;
         } else {
            $Y_Src = 0;
            $Y_Dst = ($H - $H_Src) /2;
            $H_copy = $H_Src;
         }
      } else {
         if ($H_Src > $H) {
            $Y_Src = ($H_Src - $H) /2;
            $Y_Dst = 0;
            $H_copy = $H;
         } else {
            $Y_Src = 0;
            $Y_Dst = ($H - $H_Src) /2;
            $H_copy = $H_Src;
         }
      }
      // -------------------------------------------------------------
      // CROP par copie de la portion d image selectionnee
      imagecopyresampled ($Ress_Dst, $Ress_Src, $X_Dst, $Y_Dst, $X_Src, $Y_Src, $W_copy, $H_copy, $W_copy, $H_copy);
      // ----------------------------------------------------------
      // ENREGISTREMENT dans le repertoire (avec la fonction appropriee)
      switch ($extension) { 
      case 'jpg':
      case 'jpeg':
         imagejpeg ($Ress_Dst, $rep_Dst.$img_Dst);
         break;
      case 'png':
         imagepng ($Ress_Dst, $rep_Dst.$img_Dst);
         break;
      }
      // ----------------------------------------------------------
      // liberation des ressources-image
      imagedestroy ($Ress_Src);
      imagedestroy ($Ress_Dst);
   }
   // -------------------------------------------------------------
 }
// 	---------------------------------------------------------------
 // si le fichier a bien ete cree
 if ($condition == 1 && file_exists($rep_Dst.$img_Dst)) { return true; }
 else { return false; }
}
// retourne : 1 (vrai) si le redimensionnement et l enregistrement ont bien eu lieu, sinon rien (false)
// 	---------------------------------------------------------------



}
?>