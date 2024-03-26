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
			$dati = $dbcon->query($sql);
		// chiudere il db
		// $dbcon->close();
		return $dati;
	}
	
	function Cancella($tabella, $chiave, $valore){
		EseguiDB("DELETE FROM ".$tabella." WHERE ".$chiave." = ".$valore);
	}
	
	// Messaggio("Inserimento riuscito!");
	// Messaggio("Inserimento riuscito!", "?azione=lista");
	function Messaggio($testo, $destinazione = null, $tipo = "success"){
		echo "<div class='alert alert-".$tipo."'>";
			echo $testo;
			if($destinazione != null){
				echo "<a href='".$destinazione."'>clicca qui</a> per continuare.";
			}
		echo "</div>";
	}
	
	// INSERT INTO tabella (a, b, c ... n) VALUES (1, 2, 3 ... x);
	//							4						4
	//				campi["a"] = 1;
	//				campi["b"] = 2;
	//				campi["c"] = 3;
	//				campi["sconosciuto"] = 3;
	function Inserisci($tabella, $campi){
		// quali sono le chiavi?
		
		// quali sono i valori?
		
		// implodo le chiavi incollandole per ","
	}