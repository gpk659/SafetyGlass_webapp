<?php
  /**
   * Created by PhpStorm.
   * User: Grégory
   * Date: 04-09-18
   * Time: 16:15
   */
  session_start();
  include 'secure.php';
  require "../dbConnect.php";
  include_once 'newRequests.php';

  $_SESSION['comment']="...importation...";

  include 'codetest.php';



  $urgent="";
  $jPlusUn="";
  $jPlusDeux="";
  $jPlusTrois="";
  $jPlusPlus="";

  $dateppp = date('Y-m-d',strtotime(date('Y-m-d') . "+3 days"));

  function etatVolume($date){
    global $urgent, $jPlusUn, $jPlusDeux,$jPlusTrois,$jPlusPlus, $dateppp;

    if($date == date('Y-m-d')){
    /*echo "Urgent JO";*/
      $urgent++;
    }else if ($date < date('Y-m-d')) {
      $urgent++;
    }else if($date == date('Y-m-d',strtotime(date('Y-m-d') . "+1 days"))){
      //echo "J+1";
      $jPlusUn++;
    }else if($date == date('Y-m-d',strtotime(date('Y-m-d') . "+2 days"))){
      //echo "J+2";
      $jPlusDeux++;
    }else if($date == date('Y-m-d',strtotime(date('Y-m-d') . "+3 days"))){
      //echo "J+3";
      $jPlusTrois++;
    }else if($date > $dateppp){
      //echo "J>3";
      $jPlusPlus++;
    }else{
      echo "erreur<br />";
    }
  }

    $sqlcount="SELECT datelivraison FROM  DB_Pyrobel.listevolume;";
    $nbvols = $db->query($sqlcount);

    foreach ($nbvols as $key) {
      etatVolume($key['datelivraison']);
    }




?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="fr">
<?php include 'head.inc.php'; ?>
<body>
<?php /* print_r($_SESSION); */
include_once "menu.php";
?>

<header id="currentUser">Utilisateur en cours : <?php echo $_SESSION['pseudo'];?></header>
<hr />

  <div class="tab">
    <button class="tablinks" onclick="openCity(event, 'addVol')"> Nouveau volume </button>
    <button class="tablinks" onclick="openCity(event, 'listVol')"> Liste volumes </button>
    <button class="tablinks" onclick="openCity(event, 'listVolBon')"> Liste volumes faits </button>

    <div class="statusvol">
      <table class="statustable">
        <tbody>
          <tr>
            <td></td>
            <td class="stylestatus danger">Urgent</td>
            <td class="stylestatus">J+1</td>
            <td class="stylestatus">J+2</td>
            <td class="stylestatus">J+3</td>
            <td class="stylestatus">J>3</td>
          </tr><tr>
            <td>Nb volume(s) </td>
            <td class="stylestatus danger"><?php echo $urgent; ?></td>
            <td class="stylestatus"><?php echo $jPlusUn; ?></td>
            <td class="stylestatus"><?php echo $jPlusDeux; ?></td>
            <td class="stylestatus"><?php echo $jPlusTrois; ?></td>
            <td class="stylestatus"><?php echo $jPlusPlus; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

<hr />
<div id="addVol" class="tabcontent"> <!-- Formulaire ajouter un volume -->
  <form id="newVolume" action="newVolSql.php" method="post">
    <fieldset class="form_add">
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">NumCom :</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="numCom" placeholder="Ex : 18,12345" required>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Lettre :</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="lettre" placeholder="Lettre" required>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Qté totale de volume identique (x) :</label>
        <div class="col-sm-10">
            <input class="form-control" type="number" name="quantite" placeholder="x" required>
        </div>
      </div>
      <!-- ajouter automatiquement le nb de volumes identique avec leur numero  -->

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Largeur :</label>
        <div class="col-sm-10">
            <input class="form-control" type="number" step="1" min="1" name="largeur" placeholder="Largeur (mm)" required>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Hauteur :</label>
        <div class="col-sm-10">
            <input class="form-control" type="number" step="1" min="1" name="hauteur" placeholder="Hauteur (mm)" required>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Date de livraison :</label>
        <div class="col-sm-10">
            <input class="form-control" type="date" name="datelivraison" placeholder="" required>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Type de verre :</label>
        <div class="col-sm-10">
          <?php  elementNewLoss('chute');?>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Façonnage :</label>
        <div class="col-sm-10">
            <input class="form-control" type="textarea" name="faconnage" placeholder="Façonnage">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Commentaire :</label>
        <div class="col-sm-10">
            <input class="form-control" type="textarea" name="comment" placeholder="Commentaire">
        </div>
      </div>

      <div class="boutonsubmit">
          <input type="submit" class="btn btn-primary" value="Ajouter">
      </div>
    </fieldset>
  </form>
</div>

<div id="listVol" class="tabcontent"> <!-- Tableau des volumes à faire -->
  <header id="headerlistVol">
<!-- tab info -->
<?php echo "<p style='color:green'>". $_SESSION['comment'] ."</p>"; ?>
  </head1er>
  <table id="tableVolToDo" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        <th>Num Commande</th>
        <th>Qté</th>
        <th>Date Livraison</th>
        <th id='office'>Type Verre</th>
        <th>Largeur</th>
        <th>Hauteur</th>
        <th>Façonnage</th>
        <th>Commentaire</th>
        <th>Chute(s) suggérée(s)</th>
        <th>Produire</th>
        <th>Supprimer</th>
      </tr>
    </thead>
    <tbody>
      <?php
          $sqllistvol = "SELECT idListeVolume,numCom,lettre,x,nnn,datelivraison,typeverre,largeur,hauteur,faconnage,commentaire,chutesug
                         FROM DB_Pyrobel.listevolume as list
                         where list.deleted != '1'
                         ORDER BY numCom
						 ;";
          $listVol = $db->query($sqllistvol);

              foreach ($listVol as $row) {

              $qte=$row['nnn'] ."/". $row['x'];
              $numcom=$row['numCom'] ." ". $row['lettre'];
              $idVol=$row['idListeVolume'];

                      echo "<tr class='lignetab'>
                              <td id=$idVol>$numcom</td>
                              <td>$qte</td>
                              <td>"; changeDate($row['datelivraison']);  echo "</td>
                              <td>" . $row['typeverre'] . "</td>
                              <td>" . $row['largeur'] . "</td>
                              <td>" . $row['hauteur'] . "</td>
                              <td>" . $row['faconnage'] . "</td>
                              <td>" . $row['commentaire'] . "</td>
                              <td>" . $row['chutesug'] . "</td>
                              <td><a href='usevol.php?idVol=".$idVol."'>Produire</a></td>
                              <td><a class='deleteloss' href='deletevol.php?vol=".$idVol."'>
                                      <i class='far fa-trash-alt'></i>
                                    </a></td>
                              </tr>";
                  }
                  /* Utiliser : call a php sql script to use it */
                  /* Supprimer : call a php function with confirmation to delete */
      ?>
    </tbody>
  </table>
</div>
<div id="listVolBon" class="tabcontent"> <!-- Tableau des volumes faits -->
  <table id="listOkVol" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        <th scope="col">Num Commande</th>
        <th>Lettre</th>
        <th>Date Fabrication</th>
        <th>Largeur</th>
        <th>Hauteur</th>
        <th>Type Verre</th>
        <th>Commentaire</th>
        <th>Opérateur</th>
      </tr>
    </thead>
    <tbody>
      <?php
          $sqllistvolbon = "SELECT numCom,lettre,largeur,hauteur, typeverre,datefabrication, heureFabrication, commentaire, name as operateur
                          FROM  DB_Pyrobel.listevolumesbons as lv, DB_Pyrobel.user as u
                          where lv.userid = u.iduser
                          order by  dateFabrication desc,  heureFabrication desc;";
          $listVolbon = $db->query($sqllistvolbon);

              foreach ($listVolbon as $row) {
                      echo "<tr class='lignetab'>
                              <td scope=\"row\">" . $row['numCom'] . "</td>
                              <td>" . $row['lettre'] . "</td>
                              <td>" . $row['datefabrication'] . "</td>
                              <td>" . $row['largeur'] . "</td>
                              <td>" . $row['hauteur'] . "</td>
                              <td>". $row['typeverre'] ."</td>
                              <td>" . $row['commentaire'] . "</td>
                              <td>" . $row['operateur'] . "</td>
                              </tr>";
                  }
      ?>
    </tbody>
  </table>
</div>

<footer>
    <span class="credit">v. 0.1 - © P. G.</span>
</footer>
</body>
</html>
