<?php
  /**
   * Created by PhpStorm.
   * User: Grégory
   * Date: 04-09-18
   * Time: 14:58
   */
  session_start();
  include 'secure.php';
  require "../dbConnect.php";
  include_once 'newRequests.php';

  $sqlplateau="SELECT idPlateau, numCadre, numPlateau, largeur, hauteur, commentaire, date, nomFournisseur FROM  DB_Pyrobel.plateau";
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
  <button class="tablinks" onclick="openCity(event, 'listRack')"> Liste Rack </button>
  <button class="tablinks" onclick="openCity(event, 'listPlateau')"> Liste Type Chute </button>
  <button class="tablinks" onclick="openCity(event, 'listTypeChute')"> Liste Plateau </button>
  <button class="tablinks" onclick="openCity(event, 'listUser')"> Liste Opérateurs </button>

</div>

<hr />

<div id="listRack" class="tabcontent">
  <table id="tableModifRack" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        <th>idRack</th>
        <th>Abréviation</th>
        <th>Nom Rack</th>
        <th>Description</th>
        <th>Largeur</th>
        <th>Longueur</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sqlrack="SELECT idRack, abreviation,nomRack, description, largeur, longueur FROM  DB_Pyrobel.rack";

          $listrack = $db->query($sqlrack);

              foreach ($listrack as $row) {

                      echo "<tr class='lignetab'>
                              <td>" . $row['idRack'] . "</td>
                              <td>" . $row['abreviation'] . "</td>
                              <td>" . $row['nomRack'] . "</td>
                              <td>" . $row['description'] . "</td>
                              <td>" . $row['largeur'] . "</td>
                              <td>" . $row['longueur'] . "</td>
                              <td><a class='updateloss' href='editlist.php?typem=rack&idr=" . $row['idRack'] . "&abv=" . $row['abreviation'] . "&nomRack=" . $row['nomRack'] . "&des=" . $row['description'] . "&lg=" . $row['largeur'] . "&lgr=" . $row['longueur'] . "'>";
                              echo "<i class='far fa-edit'></i></a></td></tr>";
                  }
      ?>
    </tbody>
  </table>
</div>
<div id="listTypeChute" class="tabcontent">
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
      $sqlplateau="SELECT idPlateau, numCadre, numPlateau, largeur, hauteur, commentaire, date, nomFournisseur
                   FROM  DB_Pyrobel.plateau
                   WHERE deleted != '1'";

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

                    echo "<a class='deleteloss' href='deletePlat.php?plateau=".$row['idPlateau']."'>
                                      <i class='far fa-trash-alt'></i>
                                    </a></td></tr>";
                  }
      ?>
    </tbody>
  </table>
</div>

<div id="listPlateau" class="tabcontent">
  <table id="tableModifPlateau" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        <th>idType</th>
        <th>epType</th>
        <th>masseType</th>
        <th>codeAGCType</th>
        <th>Description Courte</th>
        <th>Description Complete</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sqlchute="SELECT idType, epType, masseType, codeAGCType, descriptionCourte, descriptionComplete FROM  DB_Pyrobel.type";

      $listchute = $db->query($sqlchute);

              foreach ($listchute as $row) {

                      echo "<tr class='lignetab'>
                              <td>" . $row['idType'] . "</td>
                              <td>" . $row['epType'] . "</td>
                              <td>" . $row['masseType'] . "</td>
                              <td>" . $row['codeAGCType'] . "</td>
                              <td>" . $row['descriptionCourte'] . "</td>
                              <td>" . $row['descriptionComplete'] . "</td>
                              <td><a class='updateloss'  href='editlist.php?typem=chute&idc=" . $row['idType'] . "&eptype=" . $row['epType'] . "&masstype=" . $row['masseType'] . "&codeAGCType=" . $row['codeAGCType'] . "&descourte=" . $row['descriptionCourte'] . "&descomp=" . $row['descriptionComplete']. "'><i class='far fa-edit'></i></a></td>
                              </tr>";
                  }
      ?>
    </tbody>
  </table>
</div>

<div id="listUser" class="tabcontent">
  <table id="tableModifPlateau" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        <th>Nom Opérateur</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sqlUser="SELECT iduser, name
                FROM DB_Pyrobel.user
                where iduser != '1';";

      $listUser = $db->query($sqlUser);

              foreach ($listUser as $row) {

                      echo "<tr class='lignetab'>
                              <td>" . $row['name'] . "</td>

                              <td><a class='deleteloss' href='deleteUser.php?user=".$row['iduser']."'>
                                      <i class='far fa-trash-alt'></i>
                                    </a></td>
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
