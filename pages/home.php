<?php
/**
 * User: benjamin
 * Date: 13/11/14
 * Time: 21:32
 */
?>


<section  class="hidden-xs hidden-sm hidden-print row">
    <div class="container" >
        <div class="col-lg-5">
            <div class="row text-left bloc_home_page">
                <h3>Le portail internet des événéments catholique
                    <small>
                        <br/>Prochain événement dans 7 jours
                    </small>
                </h3>
            </div>

            <div class="row text-left bloc_home_page">
                <h4>Recherche rapide</h4>
                <div class="col-lg-6">
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker9'>
                            <input type='text' class="form-control" id="start"/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker10'>
                            <input type='text' class="form-control" id="end"/>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row text-left bloc_home_page">
                <div class="col-lg-6">
                    <input type="text" class="form-control" name="start" id='start' placeholder="mots clés"/>
                </div>
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-default col-lg-12">Rechercher</button>
                </div>

            </div>
        </div>
        <div class="col-lg-7" id="map-container" ></div>
    </div>
</section>




<!--    Dynamique grid EVENEMENTS-->
<section id="evenements" class="">
    <div class="container">
            <div class="col-lg-12 text-left" >
                <h2 class="titre" id="titre_evenement"><i class='fa fa-fw fa-calendar '></i>Les événements</h2>
            </div>
        </div>
    <div class="container">
        <div id="listeEvenements" >
            <!-- LISTE AJAX EVENEMENTS-->
        </div>
    </div>
    <div class="container text-right">
        <span class="voir-la-suite-blanc"><a href="index.php?page=evenements">Voir la suite <i class="fa fa-arrow-circle-o-right fleche"></i></a></span>
    </div>
</section>
<!--    /Dynamique grid EVENEMENTS-->
<!--    Dynamique grid EVENEMENTS-->
<section id="organisateurs" class="success">
        <div class="container">
            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" >

                    <h2 class="titre" id="titre_organisateurs"><i class='fa fa-fw fa-map-marker '></i>Les organisateurs</h2>
                    <div class=''>
                        <ul class='list-unstyled liste_organisateur_home' id='listeOrganisateurs'>
<!--                              <!-- LISTE AJAX ORGANISATEURS-->

                        </ul>
                        <div class="row text-right">
                            <span class="voir-la-suite-fonce"><a href="">Voir la suite <i class="fa fa-arrow-circle-o-right fleche"></i></a></span>
                        </div>
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
