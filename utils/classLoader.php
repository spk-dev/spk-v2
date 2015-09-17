<?php

        $classes = array(
            'Main'                              =>  'services/Main.class.php',
            
            //OBJET
            'Media'                             => 'model/Media.class.php',
            'Evenement'                         => 'model/Evenement.class.php',
            'Organisateur'                      => 'model/Organisateur.class.php',
            'TypeEvenement'                     => 'model/TypeEvenement.class.php',
            'Organisateur'                      => 'model/Organisateur.class.php',
            'Occurence'                         => 'model/Occurence.class.php',  
            'Place'                             => 'model/Place.class.php',  
            'TagEvenement'                      => 'model/Tag.class.php',
            'Message'                           => 'model/Message.class.php',
            
            //TRAITEMENT
            'AjaxAction'                        => 'AjaxAction.class.php',
            'NewsletterAction'                  => 'services/NewsletterAction.class.php',
            'EvenementSearchCriteria'           => 'services/EvenementSearchCriteria.class.php',
            'OrganisateurSearchCriteria'        => 'services/OrganisateurSearchCriteria.class.php',
            'ThemesSearchCriteria'              => 'services/ThemesSearchCriteria.class.php',
            'TypesOrganisateurSearchCriteria'   => 'services/TypesOrganisateurSearchCriteria.class.php',
            'TypesEvenementSearchCriteria'      => 'services/TypesEvenementSearchCriteria.class.php',
            
            //TECHNIQUE
            'Query'                         => 'dao/QueryV2.class.php',
            'QueryBackEnd'                  => 'dao/QueryBackEnd.class.php',
            'NewsletterDao'                 => 'dao/NewsletterDao.class.php',
            'UtilDao'                       => 'dao/UtilDao.class.php',
            
            //API PUBLIC
            'Mailjet'                       => 'api/mailjet/php-mailjet.class-mailjet-0.1.php',
            'PHPMailer'                     => 'api/phpmailer/class.phpmailer.php',
            'Slim'                          => 'api/Slim/Slim.php',

            //UTILS
            'AppLog'                        => 'utils/AppLog.class.php',
            'LoadConfig'                    => 'utils/loadConfig.php',
            'TextStatic'                    => 'utils/TextStatic.php',
            'Redirect'                      => 'utils/redirect.php',
            'imageTreatment'                => 'utils/imageTreatment.php',
            'DownloadBinaryFile'            => 'utils/DownloadBinaryFile.class.php',
            'SecurityUtil'                  => 'utils/SecurityUtil.class.php',
            'UtilSession'                   => 'utils/UtilSession.class.php',
            'UtilMail'                      => 'utils/UtilMail.class.php',
            'UtilNavigateur'                => 'utils/UtilNavigateur.class.php',
            'Util'                          => 'utils/Util.class.php',

            //EXCEPTION
            'NotFoundException'             => 'exception/NotFoundException.php',

            //DAO
            'Db'                            => 'dao/Db.class.php',
            'UtilsDao'                      => 'dao/UtilsDao.class.php'

        );
?>