<?php

include "../dbConnect.php";

$row;
//session_start();



//fonction deplacement fichiers apres importation
function move(){
	$delete;
	// Get array of all source files
	$files = scandir("CSV/");
	if( sizeof($files) == 2){
		$_SESSION['comment']="Dossier vide - pas de fichiers à importer.<br>";
		//echo $_SESSION['comment'];
	}	// Identify directories
	else{
		//$_SESSION['comment']="";
		$source = "CSV/";
		$destination = "importationbackup/";
	// Cycle through all source files
	foreach ($files as $file) {
	  if (in_array($file, array(".",".."))) continue;
	  // If we copied this successfully, mark it for deletion
	  if (copy($source.$file, $destination.$file)) {
		$delete[] = $source.$file;
	  }
	}
	// Delete all successfully-copied files
	foreach ($delete as $file) {
	  unlink($file);
	}

	}
}


	//fonction importation des fichiers csv
	if ($handle = opendir('CSV/')) { //si le fichier existe

		while (false !== ($entry = readdir($handle))) { //tant que c'est le bon dossier on procede à l importation

			if ($entry != "." && $entry != "..") {

				echo "$entry<br>"; //affichage du nom du fichier

				$file = fopen("CSV/".$entry, "r"); //ouverture du fichier
				for ($i = 0; $row = fgetcsv($file ); ++$i) { //ajout des entrees csv dans un array row

				  /*echo "<pre>";
				  print_r($row);
				  echo "</pre>";
				  echo '<br>';*/

					try{
					  //ajout de guillements et virgule pour chaque valeur
					  $values  = "'".implode("','", $row)."'";

					  $sql = "INSERT INTO DB_Pyrobel.listevolume(`numCom`,`lettre`,`x`,`nnn`,`datelivraison`,`typeverre`,`largeur`,`hauteur`,`faconnage`,`commentaire`,`chutesug`,`deleted`)
												   VALUES ($values)";
					  //print_r($sql); echo '<br>';

					  $insertdata = $db->query($sql); //insertion sql
					  echo "<h6>Ligne ajouté à la base de donnée ! </h6><br>";
            $_SESSION['comment']="Importation réussie !<br>";
					}catch (PDOException $e){ //si erreur affichage du message
						echo "! ERROR !";
						echo $sql. "<br>". $e->getMessage();
					}
				}
				fclose($file); //fermeture du fichier
			}
		}
		closedir($handle); //fermeture du dossier
		move(); //appel de la fonction deplacement des fichiers
	}
