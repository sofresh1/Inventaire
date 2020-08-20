
<?php 
require_once("lib/core.php");

if(isset($_POST["new_artiste"]) and $_POST["new_artiste"] == "update"){
	 $artiste = new artiste();
    $artiste->table = " artiste";
     $artiste->db = $bdd;
      $result =  $artiste->update(array("nom" => $_POST["nom"],"prenom" => $_POST["prenom"],"nationalite" => $_POST["nationalite"],"datenaissance" => $_POST["date_naiss"],"datedeces" => $_POST["date_deces"],"descp" => $_POST["description"],"idcourant" => $_POST["courant"]),"idArtiste = ".$_POST["idArtiste"]);
    session_start();
		if($result){
			$_SESSION["notif"] = "L'artiste a été modifié avet succés";
			$_SESSION["success"] = true;
		}else
			$_SESSION["notif"] = "L'artiste n'a pas été modifié ?!!";

		header("Location: artiste.php");
}elseif(isset($_POST["new_artiste"])){
	 $artiste = new artiste();
    $artiste->table = " artiste";
     $artiste->db = $bdd;
    $result =  $artiste->insert(array("nom" => $_POST["nom"],"prenom" => $_POST["prenom"],"nationalite" => $_POST["nationalite"],"date_naiss" => $_POST["date_naiss"],"date_deces" => $_POST["date_deces"],"description" => $_POST["description"],"idcourant" => $_POST["courant"]));
    session_start();
		if($result){
			$_SESSION["notif"] = "L'artiste a été ajouté avet succés";
			$_SESSION["success"] = true;
		}else
			$_SESSION["notif"] = "L'artiste n'a pas été ajouté ?!!";

		header("Location: artiste.php");
}

if(isset($_POST["type"]) and  $_POST["type"] == 'update_artiste'){
		$artiste = new artiste();
	    $artiste->table = " artiste";
	  	$artiste->db = $bdd;
	    $result =  current($artiste->search(array("conditions"=>" idArtiste = ?"),array($_POST["id"])));
    	
    	echo  json_encode( $result);
	}elseif(isset($_POST["type"]) and  $_POST["type"] == 'info'){
		$artiste = new artiste();
	    $artiste->table = " artiste,courantartistique";
	  	$artiste->db = $bdd;
	    $result =  current($artiste->search(array("fields" => "artiste.* , courantartistique.nom as nom_art", "conditions" => "  courantartistique.idcourant = artiste.idcourant"),array()));

    	echo  json_encode( $result);
	}

	if(isset($_POST["delete_artiste"])){
		$artiste = new artiste();
    $artiste->table = " artiste";
     $artiste->db = $bdd;
    $result =  $artiste->delete(" idArtiste = ".$_POST["idArtiste_d"]);
    session_start();
		if($result){
			$_SESSION["notif"] = "L'artiste a été supprimé avec succés";
			$_SESSION["success"] = true;
		}else
			$_SESSION["notif"] = "L'artiste n'a pas été supprimé ?!!";

		header("Location: artiste.php");
	}