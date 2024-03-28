<?php
	define("NOMEDB", "dati/tram.sqlite");
	define("DEBUG", true);
	
	if(!DEBUG){
		ini_set("display_errors", "off");
	}
	
	function Val2SQL($valore){
		if(!is_numeric($valore)){
			if(is_bool($valore)){
				$valore = $valore ? "true" : "false";
			} else {
				//$valore = addslashes($valore);
				$valore = htmlspecialchars($valore);
				//$valore = str_replace("'", "''", $valore);
				$valore = "'".$valore."'";
			}
		}
		return $valore;
	}
	
	function EseguiDB($sql, $salva = false){
		// sistema master-slave
		if($salva){
			file_put_contents("dati/slave.sql", $sql."\n", FILE_APPEND);
		}
		
		// connettersi al db
		$dbcon = new SQLite3(NOMEDB);
			// eseguire l'SQL
			$dati = $dbcon->query($sql);
		// restituisce i dati estratti		
		return $dati;
	}
	
	function Cancella($tabella, $chiave, $valore){
		EseguiDB("DELETE FROM ".$tabella." WHERE ".$chiave." = ".$valore, true);
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
	
	// INSERT INTO tabella (a, b, c ... n) VALUES (1, true, "ciao" ... "2024-03-08");
	//							4						4
	//				campi["a"] = 1;
	//				campi["b"] = 2;
	//				campi["c"] = 3;
	//				campi["sconosciuto"] = 3;
	function InserisciDB($tabella, $campi){
		// quali sono le chiavi?
		$chiavi = array_keys($campi);
		$chiavi = implode(", ", $chiavi);
		
		// quali sono i valori?
		$valori = array_values($campi);
		for($i = 0; $i < sizeof($valori); $i++){
			$valori[$i] = Val2SQL( $valori[$i] );
		}
		$valori = implode(", ", $valori);
		
		EseguiDB("INSERT INTO ".$tabella." (".$campi.") VALUES (".$valori.");", true);
	}
	
	function ModificaDB($tabella, $campi, $chiavePrimaria, $id){
		
		// campo=valore, campo2='valore2'
		
		$condizioni = [];
		foreach($campi as $chiave => $valore){
			$valore = Val2SQL( $valore );
			$condizioni[] = $chiave." = ".$valore;
		}
		$condizioni = implode(", ", $condizioni);
		
		EseguiDB("UPDATE ".$tabella." SET ".$condizioni." WHERE ".$chiavePrimaria."=".$id, true);
	}
	
	function ApriForm($metodo = "post", $azione = '?'){
		echo "<form method='".$metodo."' action='".$azione."'>";
	}
	
	function ChiudiForm($salva = "Salva", $annulla = "Annulla"){
		echo "
			<button class='btn btn-primary'>".$salva."</button>
			<button type='reset' class='btn btn-secondary'>".$annulla."</button>
			</form>";
	}
	
	// ScriviCampo("nome", "Nome utente");
	// ScriviCampo("nome", "Nome utente", $riga["nome"]);
	function ScriviCampo($id, $label, $valore = "", $tipo = "text", $classe = "form-control"){
		echo "
			<p class='form-group'>
				<label for='".$id."'>".$label."</label>
				<input value='".$valore."' type='".$tipo."' id='".$id."' name='".$id."' class='".$classe."' />
			</p>";
	}