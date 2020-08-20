<?php 

try{
	$bdd = new PDO('mysql:host=localhost;dbname=mini_projet;charset=utf8', 'root', '');
}catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
