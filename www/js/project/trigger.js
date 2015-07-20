/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

   

$(function(){
    $('#save_value').click(function(){
        var valeurs = [];
        $('input:checked[name=types]').each(function() {
            valeurs.push($(this).val());
        });
        console.log(valeurs);
    });

    $('#formResearch').on('submit', function(e) { //use on if jQuery 1.7+

        e.preventDefault();  //prevent form from submitting
        pageEvenements(false,false);
        recupCheckbox('themes[]');
        alert(recupTextField('search-motscles'));
        
    });
    
    $('#resetSearchForm').on('click', function(e) { //use on if jQuery 1.7+
        e.preventDefault();  //prevent form from submitting
        $('#formResearch')[0].reset();
        pageEvenements(false,false);
    });

//    $('#EventSearchColumn').affix({
//      offset: {
//        top: 100,
//        bottom: 1200 
//      }
//    })

//$('#keyword-search-event').on('keyDown',function(e){
//    e.preventdefault();
//    alert(e);
//})



// détection de la saisie dans le champ de recherche
  $('#mots').keyup( function(){
//    $field = $(this);
//
//    
//    if ($field.keyCode == 8 || $field.keyCode == 46) {
        setParamEvenementStr();
        pageEvenements(true);
//    }
  });

//$('#mots').on("keypress", function(e) {
//        if(e.ke)
//        setParamEvenementStr();
//        pageEvenements(true);
//
//    });
    
$('.eventSearchInput').on("change", function(e){
    setParamEvenementStr();
    pageEvenements(true);
}); 
    
});

$('#listePays').on("change",function(e){
    var tabpays = {};
    tabpays['pays'] = $('#listePays').val();
    loadAreaListes('area1',tabpays);
    setParamEvenementStr();
    pageEvenements(true);
})
$('#listeArea1').on("change",function(e){
    var tabarea1 = {};
    tabarea1['area1'] = $('#listeArea1').val();
    loadAreaListes('area2',tabarea1);
    
    setParamEvenementStr();
    pageEvenements(true);
})
$('#listeArea2').on("change",function(e){
    setParamEvenementStr();
    pageEvenements(true);
   
})