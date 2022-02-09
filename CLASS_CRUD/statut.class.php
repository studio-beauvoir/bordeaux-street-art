<?php
// CRUD STATUT
// ETUD
require_once __DIR__ . '../../CONNECT/database.php';

class STATUT{
	function get_1Statut($idStat){
		global $db;

		// select
		// prepare
		// execute
		return($result->fetch());
	}

	function get_AllStatuts(){
		global $db;

		// select
		$query = 'SELECT * FROM STATUT;'; //J'ecris ma requête SQL et la met en variable
		// prepare
		$result = $db->query($query); //J'envoi la requete au serveur SQL avec query
		// execute
		$allStatuts = $result->fetchAll(); //Je recupere le resultat de ma requete
		return($allStatuts); //Je return ma requete pour plus tard
	}

	function create($libStat){
		global $db;

		try {
			$db->beginTransaction();

			// insert
			
			// prepare
			// execute
			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur insert STATUT : ' . $e->getMessage());
		}
	}

	function update($idStat, $libStat){
		global $db;

		try {
			$db->beginTransaction();

			// update
			// prepare
			// execute
			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur update STATUT : ' . $e->getMessage());
		}
	}

	function delete($idStat){
		global $db;
		
		try {
			$db->beginTransaction();

			// delete
			// prepare
			// execute
			$count = $request->rowCount(); //
			$db->commit();
			$request->closeCursor();
			return($count); //
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur delete STATUT : ' . $e->getMessage());
		}
	}
}	// End of class
