  <?php
    session_start();
    include 'secure.php';
    require "../dbConnect.php";
    include_once 'newRequests.php';


    $_SESSION['idVol']=$_GET['idVol'];
    //echo   $_SESSION['idVol'];

    function rendementEst($lgVol, $lgChute, $htVol, $htChute){
      global $codeCss;
      $rendement=(($lgVol+$htVol)*2)/(($lgChute+$htChute)*2)*100;
      echo round($rendement);
    }

    /*
    * - SQL NEW Plateau -
    * INSERT INTO `DB_Pyrobel`.`plateau` (`numCadre`, `positionCadre`, `numPlateau`, `largeur`, `hauteur`, `commentaire`, `date`, `nomFournisseur`)
    * VALUES ('44444', '0', 'CM1234', '1234', '1234', 'test', '2019-01-01', 'AGC');
    */
    if($_POST){
      $query="";

      $numPlateau=$_POST['numPlateau'];
      $numCadre=$_POST['numCadre'];
      $largeur=$_POST['largeur'];
      $hauteur=$_POST['hauteur'];
      $cmt=$_POST['cmt'];
      $dateAjout = date('y/m/j');
      $idPlateau;
  	  $typVerre;

      try {
        $query="INSERT INTO `DB_Pyrobel`.`plateau` (`idEmplacement`, `numCadre`, `positionCadre`, `numPlateau`, `largeur`, `hauteur`,`commentaire`, `date`)
                VALUES ('0', '$numCadre', '0', '$numPlateau', '$largeur', '$hauteur','$cmt','$dateAjout')";

        $addPlat=$db->query($query);
        echo "succes";
        header('Location: http://localhost/SafetyGlassProject/gestion/listvolume.php');
      }catch(PDOException $e){
        echo $addPlat . "<br>" . $e->getMessage();
      }
    }
  ?>

  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  <html lang="fr">
  <?php include 'head.inc.php'; ?>
  <body>
  <?php /* print_r($_SESSION); */ include_once "menu.php"; ?>

  <header id="currentUser">Utilisateur en cours : <?php echo $_SESSION['pseudo'];?></header>
  <hr />

  <?php /*echo "ID Volume : " . $idVol;*/
    $hauteur;
    $largeur;
    $numerocom;
    $numlettre;
    $sqlUseVol = "SELECT idListeVolume,numCom,lettre,x,nnn,datelivraison,codeAGCType,largeur,hauteur,faconnage,commentaire,chutesug
                  FROM DB_Pyrobel.listevolume as list, DB_Pyrobel.type
                  WHERE list.typeverre = type.idType and idListeVolume = ".$_SESSION['idVol'];

    $listUseVol = $db->query($sqlUseVol);
    $typeverre;
    foreach ($listUseVol as $row) {
      $qte=$row['nnn'] ."/". $row['x'];
      $numcom=$row['numCom'] ." ". $row['lettre'];
      $numerocom=$row['numCom'];
      $numlettre=$row['lettre'];
      $idVol=$row['idListeVolume'];
      $hauteur=$row['hauteur'];
      $largeur=$row['largeur'];
      $typeverre=$row['codeAGCType'];
      $_SESSION['VoltypeVerre']=$typeverre;
      echo "<button type='button' class='backUseVol'> < Retour </button>
      <div class='useVolContainer'>
              <div class='useVolinfo'>
              <h5>Détails Volume :</h5>
              <li><span>Num Commande :</span> $numcom</li>
              <li><span>Qté :</span> $qte</li>
              <li><span>Date Livraison :</span> ".$row['datelivraison']."</li>
              <li><span>Type :</span> ".$row['codeAGCType']."</li>
              <li><span>Largeur : </span>".$row['largeur']."</li>
              <li><span>Hauteur :</span> ".$row['hauteur']."</li>
              <li><span>Façonnage :</span> ".$row['faconnage']."</li>
              <li><span>Commentaire :</span> ".$row['commentaire']
              ."</li></div>";
    }
  ?>
  <div class="useVolchutes">
    <div class="tab">
      <hr>
      <button class="tablinks" onclick="openCity(event, 'usechute')"> Chutes à utiliser </button>
      <button class="tablinks" onclick="openCity(event, 'listplat')"> Plateaux Existants </button>
      <button class="tablinks" onclick="openCity(event, 'newplat')"> Nouveau Plateau </button>
      <!--<button class="tablinks" onclick="openCity(event, 'newchute')"> Nouvelle chute </button>-->
  		<button class="tablinks" onclick="openCity(event, 'fin')"> Fin </button>
      <hr>
    </div>

    <div id="usechute" class="tabcontent">
      <table id="usechutetable" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr>
            <th>Id Chute</th>
            <th>Hauteur</th>
            <th>Largeur</th>
            <th>Date</th>
            <th>Commentaire</th>
            <th>Rendement</th>
            <th>Emplacement</th>
            <th>Position</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        <?php
          $sql = "SELECT idChutte,listchutte.largeur as lg, listchutte.hauteur as ht, dateMiseStock, listchutte.commentaire as cmt,
                         positionEmp,plateau_idPlateau, concat(nomRack,' - ',abreviation) as rack, numPlateau, emplacement_idEmplacement as idEmp
                  FROM DB_Pyrobel.listechutte as listchutte,
                       DB_Pyrobel.emplacement as emp,
                       DB_Pyrobel.rack, DB_Pyrobel.plateau
                  WHERE emplacement_idEmplacement = emp.idEmplacement
                        and rack_idRack = idRack
                        and plateau_idPlateau = idPlateau
  									    and listchutte.deleted != '1'
                        and (listchutte.largeur  >= '$largeur' and listchutte.hauteur >= '$hauteur');";

                  $listChute = $db->query($sql);

                  foreach ($listChute as $row) {

                    $idemp= $row['idEmp'];

                    $sqlnbchutte = "SELECT count(*) as nb
                                    FROM DB_Pyrobel.listechutte
                                    WHERE emplacement_idEmplacement = $idemp and deleted = 0
                                    GROUP BY emplacement_idEmplacement";
                    $nbchutte = $db->query($sqlnbchutte);

                    $idchute=$row['idChutte'];
                    $ht=$row['ht'];
                    $lg=$row['lg'];
                    $cmt='fait';
                    $datefab=date('Y-m-d');
                    $heurefab=date('H:i:s');

                    foreach ($nbchutte as $key) {
                      $nb=$key['nb'];

                      echo "<tr class='lignetab'>
                              <td>".$row['idChutte']."</td>
                              <td>" . $row['ht'] . "</td>
                              <td>" . $row['lg'] . "</td>
                              <td>" . $row['dateMiseStock'] . "</td>
                              <td>" . $row['cmt'] . "</td>
                              <td>";
                              rendementEst($largeur, $row['lg'], $hauteur, $row['ht']);
                      echo " %</td>
                              <td>".$row['rack']."</td>
                              <td>" . $row['positionEmp'] . "/$nb</td>
                              <td> <a href='usevolchute.php?idChutte=$idchute&idVol=$idVol&ht=$ht&lg=$lg&date=$datefab&cmt=$cmt&numcom=$numerocom&lettre=$numlettre&hfab=$heurefab&dfab=$datefab'>Utiliser</a> </td>";
                      }
                    }
        ?>
                  </tbody>
              </table>
            </div>
  		  <div id="listplat" class="tabcontent">
            <table id="tableModifChute" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>idPlateau</th>
                  <th>Num Cadre</th>
                  <th>Num Plateau</th>
                  <th>Largeur</th>
                  <th>Commentaire</th>
                  <th>Date</th>
                  <th>Nom Fournisseur</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php

                $tpe=$_SESSION['VoltypeVerre'];
                $sqlplateau="SELECT idPlateau, numCadre, numPlateau, largeur, hauteur, commentaire, date, nomFournisseur
                             FROM  DB_Pyrobel.plateau
                             WHERE deleted != '1' and type_idType = '$tpe' ";

                    $listplat = $db->query($sqlplateau);

                        foreach ($listplat as $row) {

                                echo "<tr class='lignetab'>
                                        <td>" . $row['idPlateau'] . "</td>
                                        <td>" . $row['numCadre'] . "</td>
                                        <td>" . $row['numPlateau'] . "</td>
                                        <td>" . $row['largeur'] . "</td>
                                        <td>" . $row['commentaire'] . "</td>
                                        <td>" . $row['date'] . "</td>
                                        <td>" . $row['nomFournisseur'] . "</td>
                                        <td><a class='updateloss' href='editlist.php?typem=plateau&numCadre=" . $row['numCadre'] . "&numPlateau=" . $row['numPlateau'] . "&largeur=" . $row['largeur'] . "&comment=" . $row['commentaire'] . "&date=" . $row['date'] . "&nomF=" . $row['nomFournisseur'] . "&idp=".$row['idPlateau']."'><i class='far fa-edit'></i></a>";

                              echo "</td></tr>";
                            }
                ?>
              </tbody>
            </table>
  		  </div>
            <div id="newplat" class="tabcontent"><!-- Form Nouveau Plateau -->
              <form id="newplatUseVol" name='plateau' method="post" action="usevol.php">

                <fieldset class="form_add">
                  <legend>Ajouter Plateau</legend>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label control-label plateau">Num Plateau :</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="text" name="numPlateau" value="" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label control-label">Num Cadre :</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="text" name="numCadre" value="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label control-label">Largeur :</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="number" name="largeur" value="3210">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label control-label">Hauteur :</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="number" name="hauteur" value="2250">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Type de verre :</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="text" name="typeverre" value="<?php echo " ".$typeverre; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label control-label">Commentaire :</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="text" name="cmt" value="">
                    </div>
                  </div>
                  <div>
                    <input type="hidden" name="plateau" value="plateau">
                    <input type="hidden" name="idp" value="">
                    <!-- Ajout de la date automatiquement , aussi specifier dans quel rack on range la nouvelle chute -->
                  </div>
                  <div class="boutonsubmit">
                    <input type="submit" name='plateau' class="btn btn-primary" value="Ajouter">
                  </div>
                </fieldset>
              </form>
            </div>
  		  <div id="fin" class="tabcontent">

  			<?php
  			if(isset($_POST['supprimer'])){
  			unset(	$_SESSION['platChutte']);
  			unset(	$_SESSION['typeChute']);
  			unset(	$_SESSION['numPlateau']);
  			unset(	$_SESSION['codeAGCType']);
  				header('Location: http://localhost/SafetyGlassProject/gestion/listvolume.php');
  			}
  			?>
  			<form name="supprimer" method="post">
  			<div class="boutonsubmit">
                <input type="submit" name='supprimer' class="btn btn-primary" value="FIN">
              </div>
  			</form>

  		  </div>
            <div id="newchute" class="tabcontent"> <!-- Form Nouvelle chute-->
              <form id="formnewloss" action="sql_add.php" method="get">
                  <fieldset>
                      <legend>Ajouter une nouvelle chute</legend>
                      <div class="form-group">
                          <label for="hauteurcChute">Hauteur :</label>
                          <input class="form-control" id="hauteurchute" type="number" name="hauteurChute" min="1" max="3210" step="1" placeholder="Valeur en mm" required>
                      </div>
                      <div class="form-group">
                          <label for="largeurChute">Largeur :</label><input class="form-control" id="largeurchute" type="number" name="largeurChute" min="1" max="2250" step="1" placeholder="Valeur en mm" required>
                      </div>
                      <div class="form-group">
                         <?php elementNewLoss('SoustypeChute'); ?>
                      </div>
                      <div class="form-group">
                          <?php elementNewLoss('rack');  ?>
                      </div>
                      <hr>
                      <div class="form-group">
                          <label>Commentaire :</label>
                          <textarea class="form-control" rows="4" cols="70" id="comment" name="comment" placeholder="Votre commentaire ici..." required></textarea>
                      </div>
                      <!-- dois se faire automatiquement -->
                      <!--<div>
                          <label>Emplacement dans le rack : </label>
                          <input type="number" id="position" name="positionRack" required min="1">
                          aussi specifier dans quel rack on range la nouvelle chute
                      </div>-->
                      <div>
                        <label>Chute provisoire ?</p>
                        <div>
                          <input type="radio" id="yes" name="provisoire" value="Oui"
                                 checked>
                          <label for="huey">Oui</label>
                        </div>
                        <div>
                          <input type="radio" id="no" name="provisoire" value="non">
                          <label for="dewey">Non</label>
                        </div>
                      </div>
                      <div class="boutonsubmit">
                          <button type="submit" class="btn btn-primary">Ajouter</button>
                      </div>
                  </fieldset>
              </form>
            </div>
          </div>
        </div>
