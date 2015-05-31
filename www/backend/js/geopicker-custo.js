// instantiate the addressPicker suggestion engine (based on bloodhound)
console.log('rentre dans geopicker custo');
var addressPicker = new AddressPicker({
 map: {
  id: '#map'
 }
});

// instantiate the typeahead UI
$('#address').typeahead(null, {
  displayKey: 'description',
  source: addressPicker.ttAdapter()
});

// Bind some event to update map on autocomplete selection
$('#address').bind('typeahead:selected', addressPicker.updateMap);
$('#address').bind('typeahead:cursorchanged', addressPicker.updateMap);

console.log('sort de geopicker custo');