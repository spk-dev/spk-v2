<?php
$liens = array();
$liens['hom']="index.php";
$liens['eve']="index.php?page=evenements";
$liens['org']="index.php?page=organisateurs";
$liens['ins']="index.php?page=inscription";
$liens['you']="http://www.youtube.com";
$liens['fac']="http://www.facebook.com";
$liens['blo']="http://blog.spibook.com";
$liens['con']="index.php?page=contact";

require('../services/Main.class.php');



$index = new Main();

$index->setBooAdmin(false);
$index->setDefault_page("home");
$index->setPage_dir("../pages/");
$index->init();
$classHeader = "hidden";
$classNavBar = "";

//AppLog::ecrireLog("Dans www/index",'debug');

if($index->getPage()=="home"){
    $liens['hom']="#page-top";
    $liens['eve']="#evenements";
    $liens['org']="#organisateurs";
    $classHeader = "";
    $classNavBar = "navbar-fixed-top";
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Freelancer - Start Bootstrap Theme</title>
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="css/lib/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/project/freelancer.css" rel="stylesheet"/>
    <link href="css/project/custo.css" rel="stylesheet"/>
    <link href="css/lib/timeline.css" rel="stylesheet"/>

    <!-- Custom Fonts -->
    <link href="css/fonts/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
       <! -- <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <script src="js/lib/html5shiv.js"></script>
        <script src="js/lib/respond.min.js"></script>-->
    <!--[endif]-->

    <script src='js/project/utilMap.js'></script>
</head>

<body id="page-top" class="index">
    <div id="fb-root"></div>
    <!-- SDK Facebook -->
    <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <!-- FIN SDK Facebook -->


    <!-- Navigation -->
    <nav class="navbar navbar-default <?php echo $classNavBar; ?>">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="" href="<?php echo $liens['hom']; ?>">
                    <img src="img/spk.png" alt="logo spk" class="img-responsive"/>
                    
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="<?php echo $liens['hom']; ?>"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="<?php echo $liens['eve']; ?>" id="top_menu_evenements">Evénements</a>
                    </li>
                    <li class="page-scroll">
                        <a href="<?php echo $liens['org']; ?>" id="top_menu_organisateurs">Organisateurs</a>
                    </li>
                    <li class="page-scroll">
                        <a href="<?php echo $liens['ins']; ?>" id="top_menu_inscription">Inscription</a>
                    </li>
                    
                    <li class="page-scroll">
                        <a href="<?php echo $liens['fac']; ?>" id="top_menu_inscription">Facebook</a>
                    </li>
                    <li class="page-scroll">
                        <a href="<?php echo $liens['you']; ?>" id="top_menu_inscription">Youtube</a>
                    </li>
                    <li class="page-scroll">
                        <a href="<?php echo $liens['blo']; ?>" id="top_menu_inscription">Le blog</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
       
    </nav>
    
    <!-- Header -->
    
    <header class="<?php echo $classHeader; ?>" >
        <div class="container " id="top">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="intro-text " >
                        <span class="skills">Vivez les <span class="high1">événements</span> qui vous  <span class="high2">ressemblent</span></span>
                    </div>
                </div>
            </div>
        </div>
    </header>
   
    <?php
    // MAIN INCLUDE HERE
    $index->run();
    // END MAIN INCLUDE
    ?>

   


    

    <!-- Footer -->
    <footer class="text-center" id="footers">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4 col-lg-3 col-sm-12 col-xs-12" id='newsletter-widget'>
                       <h2 class="titre" id="titre_newsletter"><i class='fa fa-fw fa-envelope'></i>Restons en contact</h2>
                        <p>Inscrivez-vous à notre newsletter</p>
                        <form role="form">
                            <div class="form-group">
        <!--                        <label for="newsletter_nom" class='floating-label-form-group'>Nom</label>-->
                                <input type="text" name="newsletter_nom" class="form-control" id="newsletter_nom" placeholder="Nom">
                            </div>
                            <div class="form-group">
        <!--                        <label for="newsletter_prenom">Prénom</label>-->
                                <input type="text" name='newsletter_prenom' class="form-control" id="newsletter_prenom" placeholder="Prénom">
                            </div>
                            <div class="form-group">
        <!--                        <label for="newsletter_email">Adresse email</label>-->
                                <input type="email" name="newsletter_email" class="form-control" id="newsletter_email" placeholder="Email">
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="newsletter_part" value="1" checked="checked"> J'accepte de recevoir les mails de spibook et de ses partenaires
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">S'inscrire</button>
                        </form>
                    </div>
                    <div class="footer-col col-md-8 col-lg-9 col-sm-12 col-xs-12">
                        <h3>&nbsp;</h3>
                        <div class="row panel panel-default">
                            <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FSpibook%2F283290738383457%3Ffref%3Dts&amp;width&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false&amp;appId=309771042522657" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100%;height:258px;" allowTransparency="true"></iframe>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <ul class="list-inline">
                        <li>
                            <a href="#" class="btn-social btn-outline btn-facebook"><i class="fa fa-fw fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline btn-google"><i class="fa fa-fw fa-google-plus"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline btn-twitter"><i class="fa fa-fw fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline btn-youtube"><i class="fa fa-fw fa-youtube"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-link"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <p>Conception, infographie, rédaction et développement réalisé par SPIBOOK. - &copy; Tous droits réservés
                            <br/>
                            <small>Page générée en <?php echo $index->getChrono(); ?> secondes</small>
                        </p>
                        
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll visible-xs visble-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>





    <!-- jQuery Version 1.11.0 -->
    <script src="js/lib/jquery-2.1.1.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/lib/bootstrap.min.js"></script>
    
   

    <!-- Plugin JavaScript -->
    <script src="js/lib/jquery.easing.min.js"></script>
    <script src="js/lib/classie.js"></script>
    <script src="js/lib/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/lib/jqBootstrapValidation.js"></script>
    <!-- <script src="js/contact_me.js"></script> -->

    <script src="js/lib/bootstrap-datepicker.js"></script>
    
    <!-- Custom Theme JavaScript -->
    <script src="js/project/trigger.js"></script>
    <script src="js/project/url.js"></script>
    <script src="js/project/freelancer.js"></script>
    <script src="js/project/service.js"></script>
    <script src="js/project/Ihm.js"></script>
    <script src="js/project/model.js"></script>

    <script src="js/project/util.js"></script>
    <script src="js/project/utilForm.js"></script>
    <script src="js/project/api.js"></script>
    
    <script src="js/lib/bootstrap-select.js"></script>
    <script src="js/lib/infiniteScroll.js"></script>
    <script src="js/project/root.js"></script>
    <script>
        launcher('<?php echo $index->getPage(); ?>','<?php echo $index->getId(); ?>');
    </script>


</body>

</html>
