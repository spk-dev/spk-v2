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
});

$(function() { //shorthand document.ready function
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
});


$('#EventSearchColumn').affix({
  offset: {
    top: 100,
    bottom: 1200 
  }
})

$(function(){
    $('.eventFilterEvent').click(function(e){
        e.preventDefault();
        pageHomeEvenement();
    });
});