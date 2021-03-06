<?php 
    require('../../services/Main.class.php');

    $index = new Main();
    $index->setLevel(2);
    $index->setBooAdmin(true);
    $index->setDefault_page("dashboard");
    $index->setPage_dir("../../pages_backend/");
    $index->init();

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="dist/css/timeline.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    
    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- SUMMER NOTE -->
    <link href="dist/summernote/summernote.css" rel="stylesheet">
    
    <!-- Custom spk -->
    <link href="css/custo.css" rel="stylesheet" type="text/css"/>
    <link href="css/typeahead.css" rel="stylesheet" type="text/css"/>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


 
    
    
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">SB Admin v2.0</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle danger" data-toggle="dropdown" href="#">
                       <span class="badge" style="color:#fff; background:red;">3</span> <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 2</strong>
                                        <span class="pull-right text-muted">20% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">80% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="index.php?page=user-profil"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
<!--                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>-->
                        <li class="divider"></li>
                        <li><a href="login.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                             <a href="index.php?page=dashboard"><i class="fa fa-dashboard fa-fw"></i> Tableau de bord</a>
                        </li>
                        <li>
                             <a href="index.php?page=msg-list"><i class="fa fa-envelope fa-fw"></i> Messagerie </a>
                             
                        </li>
                        <li>
                            <a><i class="fa fa-star fa-fw pointer-click"></i>Evenements</a>
                            <ul class="nav nav-second-level">
                                <li><a href="index.php?page=event-list"><i class="fa fa-list-ul fa-fw"></i> Voir tous les événements</a></li>
                                <li><a href="index.php?page=media-list"><i class="fa fa-plus-circle fa-fw"></i> Créer un événement</a></li>
                                
                            </ul>
                        </li>
                        
                        <li>
                             <a href="#"><i class="fa fa-map-marker fa-fw pointer-click"></i> Organisations</a>
                             <ul class="nav nav-second-level">
                                <li><a href="index.php?page=org-list"><i class="fa fa-list-ul fa-fw"></i> Voir toutes les organsiations</a></li>
                                <li><a href="index.php?page=org-manage"><i class="fa fa-plus-circle fa-fw"></i> Ajouter une organisation</a></li>
                                
                            </ul>
                        </li>
                        
                         
                        <li>
                            <a><i class="fa fa-ambulance fa-fw"></i> Assistance <span class="fa arrow "></span></a>
                             <ul class="nav nav-second-level">
                                <li class="">
                                   <a href="index.php?page=help"><i class="fa fa-question"></i> FAQ</a>
                                </li>
                                <li class="">
                                    <a href="index.php?page=contact"><i class="fa fa-mail-forward"></i> Contact</a>
                                </li>
                             </ul>
                        </li>
                        
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            
            <?php
                $index->run();
            ?>
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    
    
    
    
    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    
    
   
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true,
                language: {
                    url: 'bower_components/datatables-plugins/i18n/French.lang'
                }
        });
    });
    </script>       
    
        <!-- Flot Charts JavaScript -->
<!--    <script src="bower_components/flot/excanvas.min.js"></script>
    <script src="bower_components/flot/jquery.flot.js"></script>
    <script src="bower_components/flot/jquery.flot.pie.js"></script>
    <script src="bower_components/flot/jquery.flot.resize.js"></script>
    <script src="bower_components/flot/jquery.flot.time.js"></script>
    <script src="bower_components/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="js/flot-data.js"></script>-->
    
    <!-- MORRIS -->
<!--    <script src="bower_components/raphael/raphael-min.js"></script>
    <script src="bower_components/morrisjs/morris.min.js"></script>
    <script src="js/morris-data.js"></script>    -->


    <!-- DataTables JavaScript -->
    <script src="bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>


    
    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
    
     <!-- Notification -->
    <script>
    // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })

    // popover demo
    $("[data-toggle=popover]")
        .popover()
    </script>
    
    
<!--    GEOLOCALISATION-->
 <script src="http://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<!-- <script src="bower_components/jquery/jquery.js"></script>-->
 <script src="bower_components/typeahead.js/dist/bloodhound.js"></script>
 <script src="bower_components/typeahead.js/dist/typeahead.jquery.js"></script>
 <script src="dist/typeahead-addresspicker/typeahead-addresspicker.js"></script>
 <script>
     
  function displayResults(result, div) {

    $("#Latitude").val(result.lat());
    $("#Longitude").val(result.lng());
    $("#administrative_area_level_1").val(result.nameForType('administrative_area_level_1',false));
    $("#administrative_area_level_2").val(result.nameForType('administrative_area_level_2',false));
    $("#street_number").val(result.nameForType('street_number',false));
    $("#route").val(result.nameForType('route',false));
    $("#postal_code").val(result.nameForType('postal_code',false));
    $("#country").val(result.nameForType('country',false));
    $("#locality").val(result.nameForType('locality',false));
 
  }

  $( function() {
    var addressPicker = new AddressPicker();
    $('#address1').typeahead(null, {
      displayKey: 'description',
      source: addressPicker.ttAdapter()
    });
    addressPicker.bindDefaultTypeaheadEvent($('#address1'))
    $(addressPicker).on('addresspicker:selected', function (event, result) { displayResults(result, $('#response1'))})
    $(addressPicker).on('addresspicker:predictions', function(event, result) {
      if (result && result.length > 0)
        $('#address1').removeClass("empty")
      else
        $('#address1').addClass("empty")
    })
  })

  $( function() {
    // instantiate the addressPicker suggestion engine (based on bloodhound)
    var addressPicker = new AddressPicker({map: {id: '#map'}, marker: {draggable: true, visible: true}, zoomForLocation: 20, reverseGeocoding: true});

    // instantiate the typeahead UI
    $('#address2').typeahead(null, {
      displayKey: 'description',
      source: addressPicker.ttAdapter()
    });
    addressPicker.bindDefaultTypeaheadEvent($('#address2'))
    $(addressPicker).on('addresspicker:selected', function (event, result) {
      displayResults(result, $('#response2'))
      if (result.isReverseGeocoding()) {
        $('#address2').val(result.address())
      }
    });
  })


  </script>
  
  <!-- SUMMER NOTE -->
<script src="dist/summernote/summernote.min.js"></script>
<script>
    $(document).ready(function() {
      $('.summernote').summernote({
          
            
            minHeight: 300,             // set minimum height of editor
            maxHeight: 600,             // set maximum height of editor

           toolbar: [
                //[groupname, [button list]]

                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']]
           ]
      });
});
</script>

</body>

</html>
