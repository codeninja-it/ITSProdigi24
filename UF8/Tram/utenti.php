<?php include("parti/head.php"); ?>
	<h1>Gestione degli utenti</h1>
	<p>
		Usa questa pagina per poter creare nuovi utenti
		o per gestire gli attuali.
	</p>
	
	<?php
		
		$daInserire = array(
						"nome"				=> "Giovanni",
						"amministratore" 	=> true,
						"email"				=> "giovanni@gestionetram.it",
						"pass"				=> "456456456"
						);
						
		//file_put_contents("utente.json", json_encode($daInserire));		
		//$daInserire = json_decode( file_get_contents("utente.json"), true );
					
		$campi = array_keys($daInserire);
		$valori = array();
		
		foreach($campi as $campo){
			$valore = $daInserire[$campo];
			if(!is_numeric($valore)){
				if(is_bool($valore)){
					$valore = $valore ? "true" : "false";
				} else {
					$valore = "'".$valore."'";
				}
			}
			$valori[] = $valore;
		}
		
		$campi = implode(", ", $campi);
		$valori = implode(", ", $valori);
	
		$tabella = "utenti";
		
		$sql = "INSERT INTO ".$tabella." (".$campi.") VALUES (".$valori.");";
		
		echo $sql;
		//EseguiDB($sql);
	?>

<?php include("parti/foot.php"); ?>