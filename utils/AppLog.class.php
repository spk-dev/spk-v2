<?php


/**
 * 
 */
class AppLog{
	
	
	
        /**
         * Ecrire un log 
         * @param text $message : message à écrire
         * @param text $type : info ou debug 
         */
	public static function ecrireLog($message,$type){
		
                $info = $_ENV['properties']['Logs']['info'];
                $debug = $_ENV['properties']['Logs']['debug'];
                $sql = $_ENV['properties']['Logs']['sql'];
                $mail = $_ENV['properties']['Logs']['logmail'];
//                $logActive = false;
//                
		
                if(($type=="info" && $info==1) || ($type=="debug" && $debug ==1) || ($type=="sql" && $sql ==1) || ($type=="mail" && $mail ==1)){
                   $fichier ="";
                    if($type=="info"){$fichier = $_ENV['properties']['Path']['LogPathInfo'];}
                    if($type=="debug"){$fichier = $_ENV['properties']['Path']['LogPathDebug'];}
                    if($type=="sql"){$fichier = $_ENV['properties']['Path']['LogPathSql'];}
                    if($type=="mail"){$fichier = $_ENV['properties']['Path']['LogPathMail'];}
                    
                   
                 
                    
                    $fichierLog = self::openFile($fichier);
                    fseek($fichierLog, 0); // On remet le curseur au d�but du fichier

                    if($message<>""){
                            $message = "[".@date("Y-m-d H:i:s")."]-[".$type."]==>".$message."\n";
                    }else{
                            $message ="\n";
                    }
                    fputs($fichierLog, $message); // On �crit le nouveau nombre de pages vues
                    self::closeFile($fichierLog);
                }
		
				
				
		
	}
	
	
	/**
	 * Ouverture du fichier
	 */
	private static function openFile($adresseFichier){
		$fichierLog = fopen($adresseFichier, 'a');
		return $fichierLog;
	}
	
	
	/**
	 * Fermeture du fichier
	 */
	private static function closeFile($fichierLog){
		fclose($fichierLog);
	}
	
	
	
	
}