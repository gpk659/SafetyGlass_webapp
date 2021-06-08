<?php
/**
 * Created by PhpStorm.
 * User: Grégory
 */
session_start();
include 'secure.php';
include 'head.inc.php';
require '../dbConnect.php';
include_once 'newRequests.php';
include_once "menu.php";

$idchutte=$_GET['chute'];

//echo "<br>emp : ".$_GET['emp'];

$query="SELECT idChutte,listchutte.largeur as lg, listchutte.hauteur as ht, dateMiseStock, listchutte.commentaire as cmt,
                      positionEmp,plateau_idPlateau, abreviation as rack, idRack, numPlateau, descriptionCourte as type, emplacement_idEmplacement as idEmp
              FROM  DB_Pyrobel.listechutte as listchutte,
                    DB_Pyrobel.emplacement as emp,
                    DB_Pyrobel.rack,  DB_Pyrobel.plateau,
                    DB_Pyrobel.type
              WHERE emplacement_idEmplacement = emp.idEmplacement
                    and rack_idRack = idRack
                    and plateau_idPlateau = idPlateau
                    and listchutte.type_idType = idType
                    and idChutte = '$idchutte'";

$rack="SELECT idRack, CONCAT(nomRack ,' - ', r.abreviation) as nomRack
                           FROM  DB_Pyrobel.rack as r,  DB_Pyrobel.zone as z
                           WHERE r.zone_idZone = z.idZone";
$rackSql = $db->query($rack);
                           //$modifrack='';

$chutte = $db->query($query);

foreach ($chutte as $key) {
  $id=$key['idChutte'];
  $_SESSION['idChutte']=$id;
  $rack=$key['rack'];
  $old=$key['idRack'];
  $_SESSION['oldrack']=$old;
  //echo $id;
  echo "<header id='currentUser'>Utilisateur en cours :";
  echo $_SESSION['pseudo'];
  ?>
  </header>
  <hr>
  <div id='addUser' class='tabcontents'>
    <form id="formnewloss" action='updaterack.php' method=''>
      <fieldset>
        <legend>Modification rack</legend>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label control-label" for='id'>Id Chute :</label>
          <div class="col-sm-10">
            <input class="form-control" type='text' id='id' name='idchutte' value='<?php echo $id; ?>' >
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label control-label" for='currentrack'>Rack Actuel :</label>
          <div class="col-sm-10">
            <input class="form-control" type='text' id='rack' name='currentrack' placeholder='<?php echo $rack; ?>' disabled>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label control-label" for='newrack'>Nouveau Rack :</label>
          <div class="col-sm-10">
            <select class="custom-select" id='newrack' name='listerack' size='1' required>
              <option name='newrack' value='' disabled selected hidden> Sélectionnez un rack... </option>";
              <?php
              foreach ($rackSql as $key) {
                //$modifrack=$row['idRack'];
                echo "<option name='rack' value=".$key['idRack'].">".$key['nomRack']."</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <div class='boutonsubmit'>
          <input type='submit' class='btn btn-primary' value='Modifier'>
        </div>
      </fieldset>
    </form>
      </div>
<?php } ?>
