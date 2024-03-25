<?php
	define("NOMEDB", "dati/tram.sqlite");
	define("DEBUG", true);
	
	if(!DEBUG){
		ini_set("display_errors", "off");
	}
	
	function EseguiDB($sql){
		// connettersi al db
		$dbcon = new SQLite3(NOMEDB);
			// eseguire l'SQL
			$dbcon->query($sql);
		// chiudere il db
		$dbcon->close();
	}
	
	function Cancella($tabella, $chiave, $valore){
		EseguiDB("DELETE FROM ".$tabella." WHERE ".$chiave." = ".$valore);
	}