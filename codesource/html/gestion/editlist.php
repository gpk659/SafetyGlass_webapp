<?php
  /**
   * Created by PhpStorm.
   * User: Grégory
   */
  session_start();
  include 'secure.php';
  require "../dbConnect.php";
  include_once 'newRequests.php';

  //echo print_r($_GET);


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


<?php

if($_GET['typem'] == "rack"){
  echo "<button type='button' class='backUseVol'> < Retour </button>
        Modification Rack : <br />";
  ?>
  <div>
    <form id="editRack" name='rack' method="get" action="editlistracksql.php">
      <div class="form-group row">
        <label class="col-sm-2 col-form-label control-label">Abreviation :</label>
        <div class="col-sm-10">
          <input class="form-control" type="text" name="abv" value=<?php echo $_GET['abv']; ?>>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label control-label">Rack :</label>
        <div class="col-sm-10">
          <input class="form-control" type="text" name="rackname" value=<?php echo $_GET['nomRack']; ?>>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label control-label">Description :</label>
        <div class="col-sm-10">
          <input class="form-control" type="text" name="des" value=<?php echo $_GET['des']; ?>>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label control-label">Largeur :</label>
        <div class="col-sm-10">
          <input class="form-control" type="number" name="largeur" value="<?php echo $_GET['lg']; ?>">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label control-label">Longueur :</label>
        <div class="col-sm-10">
          <input class="form-control" type="number" name="longueur" value="<?php echo $_GET['lgr']; ?>">
        </div>
      </div>
      <div>
        <input type="hidden" name="rack" value="rack">
        <input type="hidden" name="idr" value="<?php echo $_GET['idr']; ?>">
      </div>
      <div class="boutonsubmit">
        <input type="submit" name="rack" class="btn btn-primary" value="Modifier">
      </div>
    </form>
  </div>
  <?php

}else if($_GET['typem'] == "plateau"){
    echo "<button type='button' class='backUseVol'> < Retour </button>
          Modification Plateau<br />"; ?>
  <div>
    <form id="editPlat" name='plateau' method="get" action="editlist_sql.php">
    <div class="form-group row">
      <label class="col-sm-2 col-form-label control-label">Num Cadre :</label>
      <div class="col-sm-10">
        <input class="form-control" type="text" name="numCadre" value="<?php echo $_GET['numCadre']; ?>">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label control-label">Num Plateau :</label>
      <div class="col-sm-10">
        <input class="form-control" type="text" name="numPlateau" value="<?php echo $_GET['numPlateau']; ?>">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label control-label">Largeur :</label>
      <div class="col-sm-10">
        <input class="form-control" type="number" name="largeur" value="<?php echo $_GET['largeur']; ?>">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label control-label">Commentaire :</label>
      <div class="col-sm-10">
        <input class="form-control" type="text" name="cmt" value=<?php echo $_GET['comment']; ?>>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label control-label">Date :</label>
      <div class="col-sm-10">
        <input class="form-control" type="date" name="date" value="<?php echo $_GET['date']; ?>">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label control-label">Nom F :</label>
      <div class="col-sm-10">
        <input class="form-control" type="text" name="nomF" value="<?php echo $_GET['nomF']; ?>">
      </div>
    </div>
    <div>
      <input type="hidden" name="plateau" value="plateau">
      <input type="hidden" name="idp" value="<?php echo $_GET['idp']; ?>">
    </div>
    <div class="boutonsubmit">
      <input type="submit" name='plateau' class="btn btn-primary" value="Modifier">
    </div>
  </form>
  </div>
  <?php


}else if($_GET['typem'] == "chute"){
  echo "<button type='button' class='backUseVol'> < Retour </button>
        Modification Chute<br />";
  ?>
  <div>
    <form id="editChute" name='chute' method="get" action="editlist_sql.php">
    <div class="form-group row">
      <label class="col-sm-2 col-form-label control-label">ep Type :</label>
      <div class="col-sm-10">
        <input class="form-control" type="number" name="epType" value="<?php echo $_GET['eptype']; ?>">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label control-label">Masse Type :</label>
      <div class="col-sm-10">
        <input class="form-control" type="number" name="masseType" value="<?php echo $_GET['masstype']; ?>">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label control-label">Code AGC Type :</label>
      <div class="col-sm-10">
        <input class="form-control" type="text" name="codeAGC" value="<?php echo $_GET['codeAGCType']; ?>">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label control-label">Description Courte :</label>
      <div class="col-sm-10">
        <input class="form-control" type="text" name="desCourte" value=<?php echo $_GET['descourte']; ?>>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label control-label">Description Complete :</label>
      <div class="col-sm-10">
        <input class="form-control" type="text" name="desComplete" value=<?php echo $_GET['descomp']; ?>>
      </div>
    </div>

      <input type="hidden" name="chute" value="chute">
      <input type="hidden" name="idc" value="<?php echo $_GET['idc']; ?>">

    <div class="boutonsubmit">
      <input type="submit" name="chute" class="btn btn-primary" value="Modifier">
    </div>
  </form>
  </div>
  <?php
}else{
  echo "Error";
}

 ?>

<footer>
    <span class="credit">v. 0.1 - © P. G.</span>
</footer>
</body>
</html>
