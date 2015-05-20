
<div id="divAddIntervenant" class="reveal-modal medium">
  <h2>Ajouter un intervenant</h2>
  <p>Seuls les champs pr&eacute;c&eacute;d&eacute;s d'une * sont obligatoires.</p>
  <form  action="ajaxManagement.php" method="POST" name='formAddIntervenant' id='formAddIntervenant'>
        <input type="hidden" name="idAdmin" value="<?php $currentAdmin->getId(); ?>"/>
        <label for='intervenant-text-nom'>Nom</label>
        <input type="text" name="intervenant-text-nom" id="intervenant-text-nom" class="contactItem contactField"/>
        <label for='intervenant-text-prenom'>Prenom</label>
        <input type="text" name="intervenant-text-prenom" id="intervenant-text-prenom" class="contactItem contactField"/>
        <label for='intervenant-mail-mail'>Mail</label>
        <input type="text" name="intervenant-mail-mail" id="mail" class="contactItem contactField"/>
        <label for='intervenant-text-titre'>Titre</label>
        <input type="text" name="intervenant-text-titre" id="titre" class="contactItem contactField"/>
        <label for='intervenant-select-genre'>Genre</label>
        <select name='intervenant-select-genre' id='intervenant-select-genre' class="contactItem contactField">
            <option val='H' disabled selected>Selectionner dans la liste ci-dessous</option>
            <option val='H'>Masculin</option>
            <option val='F'>Feminin</option>           
        </select>
        
        
        <label class='labelAdmin' for="intervenant-html-description">Description</label>
        <div class='contentWysiwyg' class='twelve columns'>
        <textarea name="intervenant-html-description" id="descriptionIntervenant" class="contactItem contactField"></textarea>
        </div>
<!--        <label class='labelAdmin' for="data-file-photo">Photo</label>
        <input type="file" name="data-file-photo" id="mainPhoto" value="" />-->
        <input class='button'  value="ok" name="intervenant-submit" id="intervenant-submit"/>
        <input class='button' type="reset" value="reset"/>
        
  </form>
  <input id="currentInterv" type="hidden" value=""/>
  <a class="close-reveal-modal">&#215;</a>
</div>

<script type="text/javascript">


$(document).ready(function() {

    var $form = $('#formAddIntervenant');

    $('#intervenant-submit').on('click', function() {
            $form.trigger('submit');
            return false;
    });

    $form.on('submit', function() {
 
    var nom = $('#intervenant-text-nom').val();
    var prenom = $('#intervenant-text-prenom').val();
    var genre = $('#intervenant-select-genre').val();
    var val = "";
    if(nom === '' || prenom === '' || genre==='Selectionner dans la liste ci-dessous') {
            alert('Les champs Genre, Nom et Prénom doivent être saisis.');
            $('#divAddIntervenant').trigger('reveal:open');
    } else {
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(json) {
               
                if(json.reponse === 'erreur dans l\'enregistrement') {
//                    document.getElementById('#divAddIntervenant').innerHTML = 'Erreur : '+ json.reponse ;
                    alert('Erreur : '+ json.reponse);
                } else {
                    alert("Intervenant correctement enregistre. Vous pouvez le s&eacute;lectionner dans la liste.");
//                  
                }
            }
             
        });
    }

        
        remplirListeIntervenant(val);
        document.getElementById('formAddIntervenant').reset();
        $('#divAddIntervenant').trigger('reveal:close');
        return false;
    });
});

</script>
    