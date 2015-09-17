<?php
/**
 * User: benjamin
 * Date: 13/11/14
 * Time: 21:33
 */

?>
<!--<h1 id="evenement-titre"> TITRE DE L'EVENEMENT </h1>
<h3 id='evenement-type'> TYPE DE L'EVENEMENT  </h3>
<span id='evenement-date-debut'>DATE DE DEBUT DE L'EVENEMENT </span>
<span id='evenement-date-fin'>DATE DE FIN DE L'EVENEMENT</span>
<a href="#map" id='evenement-ville'>VILLE</a>
<div id='evenement-image' class=""> IMAGE DE L'EVENEMENT </div>
<div id="evenement-liste-themes"> LISTE DES THEMES </div>
<p id="evenement-adresse"> te </p>
<span id="evenement-time-debut"></span>
<span id="evenement-time-fin"></span>
<span id="evenement-mail" class="evenement-mail"> mail </span>
<span id="evenement-web"> site </span> 
<div role="tabpanel" class="block tab-pane active text-justify" id="evenement-description">    DESCRIPITON DE L'EVENEMENT     </div> 
<p id="evenement-hebergement"></p>
<p id="evenement-prix"></p>
<h3>Inscription</h3>
<p id="evenement-inscription"></p>
<p id="evenement-mail2" class="evenement-mail"></p>
<p id="evenement-contact"></p>
<h3>Intervenants</h3>
<p id="evenement-intervenants"></p>-->

 
<!-- AddThis Button BEGIN -->
<!--    <div class="addthis_toolbox addthis_default_style addthis_32x32_style text-center" >
    <a class="addthis_button_preferred_1 text-right"></a>
    <a class="addthis_button_preferred_2"></a>
    <a class="addthis_button_preferred_3"></a>
    <a class="addthis_button_preferred_4"></a>
    <div class='hidden-sm hidden-md'>
        <a class="addthis_button_preferred_5"></a>
        <a class="addthis_button_preferred_6"></a>
        <a class="addthis_button_preferred_7"></a>
    </div>
    <a class="addthis_button_compact"></a>

    </div>
    <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-538f1cbb01e1612d"></script>-->
<!-- AddThis Button END -->




<!--    Dynamique grid EVENEMENTS-->
<section id="evenement" class="container" >
    <!-- Colonne de droite -->
    <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
        
              <img class="" src="http://placehold.it/600x300"/>
            
              <div class="panel panel-body"><h1 id="evenement-titre"></h1></div>
            
                
            
    </div>
    <!-- Fin Colonne de droite -->
    
    <!-- Colonne centrale -->
    <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">
        <div class="panel panel-body" id='evenement-description_short'></div>
        
    </div>
    <!-- Fin Colonne centrale -->
    <!-- Colonne de gauche -->
    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class='panel panel-heading'>
               <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Agenda
            </div>
            <div class="panel panel-body" id='evenement-timing'>
                <span id='evenement-date-debut'></span>
                <span id='evenement-date-fin'></span>
            </div>
        </div>
        <div class="panel panel-default">
            <div class='panel panel-heading'>
               <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Adresse
            </div>
            <div class="panel panel-body" id='evenement-adresse'></div>

        </div>
       
    </div>
    <!-- Fin Colonne de gauche -->
    
    
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <div>

  <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
          <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
          <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
          <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="home">...</div>
            <div role="tabpanel" class="tab-pane fade" id="profile">...</div>
            <div role="tabpanel" class="tab-pane fade" id="messages">...</div>
            <div role="tabpanel" class="tab-pane fade" id="settings">...</div>
          </div>
    </div>
    
    
    
    
    
    
</section>
