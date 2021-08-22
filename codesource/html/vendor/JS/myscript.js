/**
 * Created by Grégory on 20-09-18.
 */

$(document).ready(function(){
/*=============================================================== */
  // Plugin jquery DataTable sur le tableau des volumes à produire.
  // Ajout d'un champ pour filtrer le type de verre.
/*=============================================================== */
  // Setup - add a text input to each footer cell.
  $('#office, #typelistchute').each(function () {
    var title = $(this).text();
    $(this).html('<input type="text" class="form-control" placeholder="' + title + '" />');
  });



  var tableVol = $('#tableVolToDo').DataTable({
    "language" : {
      "url" : "../JS/French.json"
    },
    "lengthMenu": [50, 100, 200]
  });

  tableVol.columns().every(function () { // Apply the search
          var that = this;
          $('input', this.header()).on('keyup change', function () {
              if (that.search() !== this.value) {
                  that
                  .search(this.value)
                  .draw();
              }
          });
      });


/*=============================================================== */
/*
* Tableau des chutes.
*/
/*=============================================================== */

    $('#findTable, #modiftable, #listOkVol, #tableModifRack, #tableModifChute, #tableModifPlateau, #usechutetable').DataTable( {
            "language": {
                "url": "../JS/French.json"
            },
            "lengthMenu": [ 10,50,100 ],
            dom: 'Bfrtip',
            buttons: [
                'excelHtml5',
                'pdfHtml5'
            ]
        } );




// Bouton de retour sur la page UseVol
$('.backUseVol').click(function(){
		history.back();
	});

});
