<?php
require "../dbConnect.php";

  $sql="SELECT idformtest, abv, des, largeur, longueur FROM test.formtest";

  $listForm=$db->query($sql);
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Dialog - Modal form</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <style>
    label, input { display:block; }
    input.text { margin-bottom:12px; width:95%; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    h1 { font-size: 1.2em; margin: .6em 0; }
    div#users-contain { width: 350px; margin: 20px 0; }
    div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
    .ui-dialog .ui-state-error { padding: .3em; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
  </style>
  <script src="../JS/jquery-3.2.1.min.js"></script>
  <script src="../JS/jquery-ui.js"></script>
  <script>
    $( function() {
      var dialog, form

      function editField() {
        //redirection to another page

        $('#dialog-form').click(function(e){
          e.preventDefault();
          if($('#abreviation').val() == "" || $('#description').val() == "" || $('#largeur').val() == "" || $('#longueur').val() == "" ){
            alert("Vous n'avez pas rempli tout les champs!")
          } else {
            let abre = $('#abreviation').val();
            let desc = $('#description').val();
            let larg = $('#largeur').val();
            let long = $('#longueur').val();

            $.ajax({
              type:"POST",
              cache:false,
              url:"testsql.php",
              data: 'abre='+ abre  +'&desc='+ desc + '&larg='+ larg +'&long='+ long,   // multiple data sent using ajax
              success: function (responseJson) {
                if(!responseJson){
                    alert('An error occured!')
                } else {
                    let arr = JSON.parse(responseJson);
                    let html = "<tr><td>"+arr[0]+"</td><td>"+arr[1]+"</td><td>"+arr[2]+"</td><td>"+arr[3]+"</td></tr>";
                    console.log(html);
                    $('#tbody').append(html);
                }
              }
            });
          }
        });

        dialog.dialog( "close" );
      }

      dialog = $( "#dialog-form" ).dialog({
        autoOpen: false,
        height: 400,
        width: 350,
        modal: true,
        buttons: {
          "Confirm": editField,
          Cancel: function() {
            dialog.dialog( "close" );
          }
        }
      });


      $('.mailbutton').click(function() {
        dialog.dialog( "open" );
      });

    });
  </script>
</head>
<body>

<div id="dialog-form" title="Edit">
  <form id="formtest">
    <fieldset>
      <label for="abreviation">Abréviation</label>
        <input type="text" name="abreviation" id="abreviation" value="M1" class="text ui-widget-content ui-corner-all">
      <label for="description">Description</label>
        <input type="text" name="description" id="description" value="Rack Mistrello" class="text ui-widget-content ui-corner-all">
      <label for="largeur">Largeur</label>
        <input type="number" name="largeur" id="largeur" value="390" class="text ui-widget-content ui-corner-all">
      <label for="longueur">Longueur</label>
        <input type="number" name="longueur" id="longueur" value="6" class="text ui-widget-content ui-corner-all">

      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>

<div id="users-contain" class="ui-widget">
  <table id="users" class="ui-widget ui-widget-content">
    <thead>
      <tr class="ui-widget-header ">
        <th>Id</th>
        <th>Abréviation</th>
        <th>Description</th>
        <th>Largeur</th>
        <th>Longueur</th>
        <th></th>
      </tr>
    </thead>
    <tbody id="tbody">

      <?php
        foreach ($listForm as $key) {
          echo "<tr>
                  <td>".$key['idformtest']."</td>
                  <td>".$key['abv']."</td>
                  <td>".$key['des']."</td>
                  <td>".$key['largeur']."</td>
                  <td>".$key['longueur']."</td>
                  <td class='mailbutton'>Edit</td>
                </tr>";
        }
      ?>

    </tbody>
  </table>
</div>
</body>
</html>
