<div class="row">
    <div class="twelve">
        Test google analytics
        <?php
//        $ga = GAnalytics::instance();
//        $navigateurs = $ga->getDimensionByMetric('visits', 'browser', date('Y-m-d', time()));
//        $countries = $ga->getDimensionByMetric('visits', 'country', date('Y-m-d', time()));
//        $visits = $ga->getMetric('visits', date('Y-m-d', time()));
//        $unique_visits = $ga->getMetric('visitors', date('Y-m-d', time()));
//        $page_views = $ga->getMetric('pageviews', date('Y-m-d', time()));
        
        // TEST
        $email = 'spibook.contact@gmail.com';
        $passwd = 'spibook2014';
        $ids = 40754466;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://www.google.com/accounts/ClientLogin");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $data = array('accountType' => 'GOOGLE',
        'Email' => $email,
        'Passwd' => $passwd,
        'source'=>'CLI_GAnalytics',
        'service'=>'analytics');

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $hasil = curl_exec($ch);
        $hasil = @split("Auth=", $hasil);
        $auth = $hasil[1];

        curl_close($ch);

        $uri = "index.php";

        $current_date = date('Y-m-d', time());
        $ch1 = curl_init("https://www.google.com/analytics/feeds/data?ids=ga:" . $ids . "&metrics=ga:pageviews&dimensions=ga:pagePath&filters=ga:pagePath%3D%3D" . $uri . "&start-date=" . $current_date . "&end-date=" . $current_date);

        $header[] = 'Authorization: GoogleLogin auth=' . $auth;

        curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch1, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch1, CURLOPT_HEADER, false);

        $response = curl_exec($ch1);
        curl_close($ch1);

        $XML_response = @str_replace('dxp:','',$response);
        $XML_object = simplexml_load_string($XML_response);

        $pv = $XML_object->entry->metric['value'] ? $XML_object->entry->metric['value'] : 0;

        echo 'Vue ' . $pv . ' fois aujourd\'hui.';

        ?>
     
    </div>
<?php 
    $listeLieuxAdmin = AdministrateurAction::getAdministrateur(UtilSession::getSessionAdminId())->getLieux();
    $nombreLieux = count($listeLieuxAdmin);
    $aujourdhui = new DateTime();
    $aujourdhui->format('Y-m-d');
?>

<ul class="tabs-content contained">
    <li class="active" id="simpleContained1Tab">
        <div class="row">
            
            <h3>Mes événements <small><a href="admin.php?page=evenement" >&nbsp;[&nbsp;Cliquer ici pour creer un événement&nbsp;]&nbsp;</a></small></h3>
                
            <?php if($nombreLieux<1){ ?>
                    <dl class="tabs evenements">
                      <dd class="active"><a href="#avenir">Evenements</a></dd>
                    </dl>
                    <ul class="tabs-content">
                      <li class="active evenements" id="avenirTab">
                          Aucun événement.

                      </li>


                    </ul>
             <?php }else{ ?>
           
            
                
                <?php
                $filter = new EvenementSearchCriteria();
                $aujourdhui = new DateTime();
                $aujourdhui->format('Y-m-d');
                $filter->setEvenementLieu($nombreLieux);
               
            ?>   
            
            <dl class="tabs evenements">
              <dd class="active"><a href="#avenir">Evenements à venir</a></dd>
              <dd><a href="#passes">Evenements passés</a></dd>
            </dl>
            <ul class="tabs-content">
              <li class="active evenements panel" id="avenirTab">
                  <?php
                        $filterMin = $filter;
                        $filterMin->setEvenementDateMin($aujourdhui->format('Y-m-d'));    
                        $filterMin->setEvenementDateMax("");
                        $filterMin->setEvenementLieu($listeLieuxAdmin);
                        echo EvenementAction::afficherTableEvenementsSynthese($filterMin, "toto",true);
                    ?>

              </li>
              <li id="passesTab" class="panel">
                  <?php
                        $filterMax = $filter;
                        $filterMax->setEvenementDateMax($aujourdhui->format('Y-m-d'));    
                        $filterMax->setEvenementDateMin("");
                        $filterMax->setEvenementLieu($listeLieuxAdmin);
                        echo EvenementAction::afficherTableEvenementsSynthese($filterMax, "toto",true);
                    ?>
              </li>

            </ul>
             <?php } ?>
        </div>
        </div>
        <div class="row">

            <div class='twelve columns'>
                <h3>Fiche organisateur <small><a href="admin.php?page=lieu" >&nbsp;[&nbsp;cliquer ici pour compléter ma fiche organisateur&nbsp;]&nbsp;</a></small></h3>
   
                
                <?php 
                    $lieu = new Lieu();
                    $filterLieu = new OrganisateurSearchCriteria();
                    $filterLieu->setOrganisateurAdministrateur(array(UtilSession::getSessionAdminId()));
                        LieuAction::afficherGridLieuxAdmin($filterLieu,2,2);
                    foreach (LieuAction::listerLieuxFiltered($filterLieu, true) as $lieu) {
                ?>
                <div class="twelve columns panel">    
                    <div class="three columns">
                        <img class='twelve' src='<?php echo HtmlUtilComponents::imageControl("lieux", $lieu->getMainPhoto(), 0); ?>'/>
                   
                    </div>
                <div class="five columns ">
                   
                    <a href="admin.php?page=lieu&idLieu=<?php echo $lieu->getId(); ?>">
                        <h4><?php echo $lieu->getNom(); ?></h4>
                        <br/>
                        Modifier mes informations
                   
                    </a>
                   
                   
                </div>
                    <div class="four columns">
                        <div>
                        <a href='admin.php?page=lieu&idLieu<?php echo $lieu->getId(); ?>#activation'>
                        <?php if($lieu->getValidationAdmin()==1){ ?>
                              <p class="success label round ">Vous avez activé votre fiche</p>
                        <?php }else{ ?>
                              <p class="alert label round ">N'oubliez pas d'activer votre fiche.</p>
                        <?php } ?>
                        </a>
<!--                   <div class="twelve columns panel">-->
                        </div><br/>
                        <?php if($lieu->getValidationSuperAdmin()==1){ ?>
                              <span class="success label round ">Validé</span>
                        <?php }else{ ?>
                              <span class="alert label round ">En cours de validation par Spibook</span>
                        <?php } ?>
                              <br/>
                              
<!--                    </div>-->
                </div>
                </div>
                <?php   }  ?>
                
            </div>

            <hr/>
            <div class="twelve columns">
                <ul class=" twelve accordion">
                    <li class="active assistance">
                      <div class="title">
                        <h3>Besoin d'aide</h3>
                      </div>
                      <div class="content">
                          <ul>
                            
                            <li><a href='admin.php?page=contact'>Contacter l'assistance</a></li>
                          </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        
        
        
        
        <div class="row">
            
            
            
            
            
            
            
            
        </div>
    </li>



</div>