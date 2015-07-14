<?php
/**
 * User: benjamin
 * Date: 13/11/14
 * Time: 21:32
 */
?>

<section id="evenements">
    <div class="container">
        <div class="col-lg-12 home_bloc">
            <div class="col-lg-5">
                <a href='index.php?page=evenements'>
                    <h2 class="titre" id="titre_evenement">
                        <i class='fa fa-fw fa-calendar '></i>
                        En ce moment sur Spibook
                    </h2>
                </a>
                <h5>Des événements pour vous:</h5>
                <a href="" class='eventFilterEvent' id='event1'><span class="label label-primary">de la semaine</span></a>
                <a href="" class='eventFilterEvent' id='event2'><span class="label label-primary">Pentecote</span></a>
                <a href="" class='eventFilterEvent' id='event3'><span class="label label-primary">autour de moi</span></a>
                <a href="" class='eventFilterEvent' id='event4'><span class="label label-primary">JMJ Cracovie</span></a>
            
                <br/>
                
                <h5>Filtrer les types d'événements:</h5>
                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" id="listeTypesEvenements">
<!--                Liste des themes pour filtrer-->
                </div>
                
                <div id="loading" ><img src="img/ajax-loader.gif"/> ... chargement ...</div>
                             
            </div>
            <div class="col-lg-7">
                <div id="map-container" ></div>
            </div>
        </div>
        <div class="col-lg-12" id="listeEvenements">
            
            <!-- LISTE AJAX EVENEMENTS -->
        </div>

        <div class="container text-right">
            <span class="voir-la-suite-blanc"><a href="index.php?page=evenements">Voir la suite <i class="fa fa-arrow-circle-o-right fleche"></i></a></span>
        </div>
    </div>
</section>


<section id="organisateurs" class="success">
        <div class="container">
            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" >

                    <h2 class="titre" id="titre_organisateurs">
                        <i class='fa fa-fw fa-map-marker '></i>
                        Les organisateurs
                        
                            
                    </h2>
                <div id="listeOrganisateurs">
                     <!-- LISTE AJAX ORGANISATEURS -->
                </div>
                
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-lg-offset-1 col-md-offset-1 col-xs-12" id='liste_home_themes'>
               <h2 class="titre" id="titre_thematiques"><i class='fa fa-fw fa-bookmark'></i>Tous les thèmes</h2>
               <div class="row">
                   <ul class='list-inline list-unstyled' id="home-list-themes">
                      <!-- Nb d'événement par themes -->
                    </ul>
                </div>
            </div>

        </div>


</section>
<!--    /Dynamique grid EVENEMENTS-->


<!-- About Section -->
<section class="container" id="inscription">
    <h2 class="titre" id="titre_videos"><i class='fa fa-fw fa-video-camera'></i>Ils parlent de nous</h2>
    <div class="row text-right">
       <a href="https://www.youtube.com/channel/UC_CZcfqlq06gWMwmqXYU3Eg/feed" class="btn-social btn-outline btn-youtube"><i class="fa fa-fw fa-youtube"></i></a>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-10 col-sm-12 col-xs-12">
        <div class="embed-responsive embed-responsive-4by3">
            <iframe src="//www.youtube.com/embed/Hzy2NHHYxmk?rel=0" width="100%" height="300px" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-10 col-sm-12 col-xs-12">
        <div class="embed-responsive embed-responsive-4by3">
            <iframe src="//www.youtube.com/embed/MPjqSooIQmo?rel=0" width="100%" height="300px" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>




</section>
