
<?php 
require_once("lib/core.php");

if(isset($_POST["new_courant_artistique"])){
	 $courant_artistique = new courant_artistique();
    $courant_artistique->table = " courantartistique";
     $courant_artistique->db = $bdd;
    $result =  $artiste->insert(array("nom" => $_POST["nom"],"date debut" => $_POST["date debut"],"date fin" => $_POST["date fin"],"date_naiss" => $_POST["date_naiss"],"date_deces" => $_POST["date_deces"],"description" => $_POST["description"],"idcourant" => $_POST["courant"]));
    session_start();
		if($result){
			$_SESSION["notif"] = "L'artiste a été ajouté avet succés";
			$_SESSION["success"] = true;
		}else
			$_SESSION["notif"] = "L'artiste n'a pas été ajouté ?!!";

		header("Location: artiste.php");