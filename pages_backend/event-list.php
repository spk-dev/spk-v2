

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-star fa-fw"></i>Mes événements</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="table-responsive">
    <table class="table table-hover table-striped"  id="dataTables-example">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom de l'événement</th>
                <th>contact</th>
                <th>Prochaine Occurence</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php 

            /* récupération des évènements */
            $listEvenements = Evenement::recupererEvenements(array(),null);
            foreach ( $listEvenements as $evenements )
            {
                $objEvenement = new Evenement($evenements);
                $urlEncodeObj = urlencode(serialize($objEvenement));
        ?>
            <tr>
                <td><?php echo $objEvenement->getAttribut('eve_int_id');?></td>
                <td><?php echo $objEvenement->getAttribut('eve_var_libelle'); ?></td>
                <td></td>
                <td></td>
                <td>
                    <div class="tooltip-demo">
                        <a href="../index.php?page=evenement&id=6" target="_blank"><button type="button" class="btn btn-primary btn-circle" data-toggle="tooltip" data-placement="top" title="Voir sur le site"><i class="fa fa-globe fa-fw"></i></button></a>
                    </div>
                </td>
            </tr>                    
            <?php } ?>
        </tbody>
    </table>
</div>
<?php 

$codeObj = urlencode(serialize($objEvenement));
?>
    
<script>

var obj = undefined;    
/*
 * Permet de naviguer entre les occurences de l'événment
 * @param {type} sens donne le sens de navigation avant ou arrière
 * @returns {Boolean}
 */
function navOccurence(sens)
{
    if ( obj == undefined )
        /*
         * l'objet est encodé pour pouvoir le récupérer côté AJAX
         * il sera passé en POST au scipt AJAX
         */
        obj = '<?php echo $codeObj ?>';
    $.ajax({
        url:'../backend/ajax/EvenementAjax.php',
        method: 'POST',
        data: {sens: sens, objEncoded: obj, act: 'navOccurence'},
        dataType: 'json', 
        success: function(json) { 
            /* on décode l'objet evenement car il a été modifié */
            obj = json.encodedObjet;
            /*
             * on affecte avec les valeurs récupérées les champs
             */
            document.forms['frmOccEvt'].elements["ocu_int_id"].value=json.ocu_int_id;
            document.forms['frmOccEvt'].elements["ocu_date_debut"].value=json.ocu_date_debut;
            document.forms['frmOccEvt'].elements["ocu_date_fin"].value=json.ocu_date_fin;
            /*
             * pour test on afin si on est en butée haute ou basse
             */
            if ( json.butee ) {
                alert('en butée');
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert('Récupération des occurences impossible : '+thrownError)
        }
    });
    return false;
}

/*
 * Permet de naviguer entre les occurences de l'événment
 * @param {type} sens donne le sens de navigation avant ou arrière
 * @returns {Boolean}
 */
function navMedia(sens)
{
    if ( obj == undefined )
        /*
         * l'objet est encodé pour pouvoir le récupérer côté AJAX
         * il sera passé en POST au scipt AJAX
         */
        obj = '<?php echo $codeObj ?>';
    $.ajax({
        url:'../backend/ajax/MediaAjax.php',
        method: 'POST',
        data: {sens: sens, objEncoded: obj, act: 'navMedia'},
        dataType: 'json', 
        success: function(json) { 
            /* on décode l'objet evenement car il a été modifié */
            obj = json.encodedObjet;
            /*
             * on affecte avec les valeurs récupérées les champs
             */
            document.forms['frmMedEvt'].elements["med_int_id"].value=json.med_int_id;
            document.forms['frmMedEvt'].elements["med_var_url"].value=json.med_var_url;
            /*
             * pour test on afin si on est en butée haute ou basse
             */
            if ( json.butee ) {
                alert('en butée');
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert('Récupération des médias impossible : '+thrownError)
        }
    });
    return false;
}


/*
 * permet de sauvegarder un événement
 */
function saveFrm(idForm) 
{
    var FormEncoded = $( '#'+idForm ).serialize();
    var obj = '<?php echo $codeObj ?>';
    if ( document.forms[idForm].elements["eve_int_id"] == undefined)
        act = 'SaveEvenement';
    else
        act = 'ModifEvenement';

    $.ajax({
        url:'../backend/ajax/EvenementAjax.php',
        method: 'POST',
        data: {act: act,FormEncoded: FormEncoded,objEncoded:obj },
        dataType: 'text', 
        success: function(text) { 
            $("textarea#pla_invites").val(text);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert('Récupération des invités impossible : '+thrownError)
        }
    });
    return false;
}
</script>  

    
<div class='row'>
    <h3>Test de modification d'un événement </h3>
    <!-- exemple de sauvegarde d'un événement -->
    <form action="" name="frmEvt" onsubmit="return modFrm('#frmEvt')" id="frmEvt" method="POST">
        <div class="row">
            <input id="ocu_int_id" name="eve_int_id" class="form-control" type="text" placeholder="id" value="<?php echo $objEvenement->getAttribut('eve_int_id')?>">
            <input id="eve_var_libelle" name="eve_var_libelle" class="form-control" type="text" placeholder="libelle" value="<?php echo $objEvenement->getAttribut('eve_var_libelle')?>">
            <input id="eve_var_description" name="eve_var_description" class="form-control" type="text" placeholder="description" value="<?php echo $objEvenement->getAttribut('eve_var_desciption')?>">
            <input id="eve_org_int_id" name="eve_org_int_id" class="form-control" type="text" placeholder="eve_org_int_id" value="<?php echo $objEvenement->getAttribut('eve_org_int_id')?>">
            <input id="eve_tev_int_id" name="eve_tev_int_id" class="form-control" type="text" placeholder="eve_tev_int_id" value="<?php echo $objEvenement->getAttribut('eve_tev_int_id')?>">
            <button type="submit" class="btn btn-default col-lg-12"><i class="fa fa-floppy-o"></i></button>
        </div>
    </form>
</div> 


<div class='row'>
    <h3>Test de création d'un événement </h3>
    <!-- exemple de sauvegarde d'un événement -->
    <form action="" name="frmInsEvt" onsubmit="return saveFrm('frmInsEvt')" id="frmInsEvt" method="POST">
        <div class="row">
            <input id="eve_var_libelle" name="eve_var_libelle" class="form-control" type="text" placeholder="libelle" value="">
            <input id="eve_var_description" name="eve_var_description" class="form-control" type="text" placeholder="description" value="">
            <input id="eve_org_int_id" name="eve_org_int_id" class="form-control" type="text" placeholder="eve_org_int_id" value="<?php echo $objEvenement->getAttribut('eve_org_int_id')?>">
            <input id="eve_tev_int_id" name="eve_tev_int_id" class="form-control" type="text" placeholder="eve_tev_int_id" value="<?php echo $objEvenement->getAttribut('eve_tev_int_id')?>">
            <button type="submit" class="btn btn-default col-lg-12"><i class="fa fa-floppy-o"></i></button>
        </div>
    </form>
</div>  

<?php
/*
 * récupération des occurences 
 */
$occurenceCourante = $objEvenement->getOccurenceCourante();
?>
<div class='row'>
    <h3>Test de navigation sur les occurences  </h3>    
    <div class="col-lg-6">
        <a href="#" Onclick=" return navOccurence('<?php echo Evenement::K_precedent ?>');">Précédent</a>
    </div>
    <div class="col-lg-6">
        <a href="#" onclick=" return navOccurence('<?php echo Evenement::K_suivant ?>');">Suivant</a>
    </div>
    <form action="" name="frmOccEvt" onsubmit="return saveFrm('#frmOccEvt')" id="frmOccEvt" method="POST">
        <div class="row">
            <input id="ocu_int_id" name="ocu_int_id" class="form-control" type="text" placeholder="id" value="<?php echo $occurenceCourante->getAttribut('ocu_int_id')?>">
            <input id="ocu_date_debut" name="ocu_date_debut" class="form-control" type="text" placeholder="date début" value="<?php echo $occurenceCourante->getAttribut('ocu_date_debut')?>">
            <input id="ocu_date_fin" name="ocu_date_fin" class="form-control" type="text" placeholder="date fin" value="<?php echo $occurenceCourante->getAttribut('ocu_date_fin')?>">
        </div>
    </form>
</div>

<?php
/*
 * récupération des medias 
 */
$mediaCourant = $objEvenement->getMediaCourant();
$objOrganisateur = $mediaCourant->getObjOrganisateur();
?>
<div class='row'>
    <h3>Test de navigation sur les médias  </h3>    
    <div class="col-lg-6">
        <a href="#" Onclick=" return navMedia('<?php echo Evenement::K_precedent ?>');">Précédent</a>
    </div>
    <div class="col-lg-6">
        <a href="#" onclick=" return navMedia('<?php echo Evenement::K_suivant ?>');">Suivant</a>
    </div>
    <form action="" name="frmMedEvt" onsubmit="return saveFrm('#frmMedEvt')" id="frmMedEvt" method="POST">
        <div class="row">
            <input id="med_int_id" name="med_int_id" class="form-control" type="text" placeholder="id" value="<?php echo $mediaCourant->getAttribut('med_int_id')?>">
            <input id="med_var_url" name="med_var_url" class="form-control" type="text" placeholder="url media" value="<?php echo $mediaCourant->getAttribut('med_var_url')?>">
            Organisateur : <p><?php echo $objOrganisateur->getAttribut('org_var_libelle')?></p>
        </div>
    </form>
</div>
