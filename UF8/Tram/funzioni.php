<?php
	define("NOMEDB", "../dati/tram.sqlite");
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
			file_put_contents("../dati/slave.sql", $sql."\n", FILE_APPEND);
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
		
		EseguiDB("INSERT INTO ".$tabella." (".$chiavi.") VALUES (".$valori.");", true);
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
	
	function ApriForm($azione = null, $metodo = "post"){
		if($azione == null){
			echo "<form method='".$metodo."'>";
		} else {
			echo "<form action='".$azione."' method='".$metodo."'>";
		}
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
		switch($tipo){
			case "checkbox":
				echo "<p class='form-check form-switch'>
							<label class='form-check-label' for='".$id."'>".$label."</label>
							<input type='checkbox' value='si' id='".$id."' name='".$id."' class='form-check-input' ".($valore ? "checked" : "")." /> 
						</p>";
			break;
			default:
				echo "<p class='form-group'>
							<label for='".$id."'>".$label."</label>
							<input value='".$valore."' type='".$tipo."' id='".$id."' name='".$id."' class='".$classe."' />
						</p>";
			break;
		}
		
	}
	
	function ScriviTendina($id, $label, $chiave, $descrizione, $tabella, $valore = 0){
		$dati = EseguiDB("SELECT ".$chiave.", ".$descrizione." 
							FROM ".$tabella." 
							ORDER BY ".$descrizione.";");
		$opzioni = [];
		while($riga = $dati->fetchArray()){
			if($riga[$chiave] == $valore){
				$opzioni[] = "<option selected value=".$riga[$chiave].">
								".$riga[$descrizione]."
								</option>";
			} else {
				$opzioni[] = "<option value=".$riga[$chiave].">
								".$riga[$descrizione]."
								</option>";
			}
		}
		$opzioni = implode("", $opzioni);
		
		echo "<p class='form-group'>
					<label for='".$id."'>".$label."</label>
					<select class='form-select' id='".$id."' name='".$id."'>
						".$opzioni."
					</select>
				</p>";
	}
	
	function DisegnaTabella($sql, $chiave){
		$dati = EseguiDB($sql);
		$righe = [];

		while($riga = $dati->fetchArray(SQLITE3_ASSOC)){
			$nuova = [];
				$nuova[] = "<tr>";
					foreach($riga as $campo => $valore){
						$nuova[] = "<td align='".(is_numeric($valore) ? "right" : "left")."'>
										".$valore."
									</td>";
					}
					$nuova[] = "<td><a href='?azione=modifica&id=".$riga[$chiave]."' class='btn btn-warning material-symbols-outlined'>edit</a></td>";
					$nuova[] = "<td><a href='?azione=cancella&id=".$riga[$chiave]."' class='btn btn-danger material-symbols-outlined'>delete</a></td>";
				$nuova[] = "</tr>";
			$righe[] = implode("", $nuova);
		}
		$dati->reset();
		$riga = $dati->fetchArray(SQLITE3_ASSOC);
		$colonne = [];
			foreach($riga as $campo => $valore){
				$colonne[] = "<th ".(is_numeric($valore) ? "class='text-end' width='1%'" : "").">
								".$campo."
							</th>";
			}
			$colonne[] = "<th width='1%'><a href='?azione=inserisci' class='btn btn-success material-symbols-outlined'>add</a></th>";
			$colonne[] = "<th width='1%'></th>";
		echo "<table class='table table-hover'>
				<thead><tr>".implode("", $colonne)."</tr></thead>
				<tbody>".implode("", $righe)."</tbody>
			</table>";
	}
	
	function DammiColonne($tabella){
		$dati = EseguiDB("SELECT name, type, dflt_value, pk 
							FROM PRAGMA_TABLE_INFO('".$tabella."');");
		return $dati;
	}