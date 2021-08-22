 <div id="nav-test">
    <div id="nav-container">
        <ul>
            <li class="nav-li active-nav"><a href='acceuil.php'>Acceuil</a></li>
            <li class="nav-li"><a href='newloss.php'>Ajouter une nouvelle chute</a></li>
            <li class="nav-li"><a href='deplacement.php'>Liste des chutes</a></li>
            <li class="nav-li"><a href='listvolume.php'>Volume à couper</a></li>
            <!-- <li class="nav-li"><a href='production.php'>Production</a></li> -->
            <?php
                if($_SESSION['droit'] >= "7"){
                  echo "<li class='nav-li'><a href='addpage.php'>Ajouter</a></li>";
                  echo "<li class='nav-li'><a href='modification.php'>Modification</a></li>";
				  //echo "<li class='nav-li'><a href='importation.php'>Importation</a></li>";
                }
            ?>
            <li class="nav-li"><a href='logout.php' >Déconnexion</a></li>
        </ul>
        <div id="line"></div>
    </div>
</div>
