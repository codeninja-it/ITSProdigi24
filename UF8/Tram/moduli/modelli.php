<?php
	include("../parti/head.php");
	include("../funzioni.php");
?>
	<h1>Gestione dei modelli</h1>
	<p>
		Usa questa pagina per poter creare nuovi modelli di veicoli
		o per gestire quelli già presenti.
	</p>
	
<?php
		
	switch($_GET["azione"]){
		case "cancella":
			Cancella("modelli", "idmodello", $_GET["id"]);
			Messaggio("Cancellazione avvenuta con successo!");
		break;
		
		case "inserisci":
			if(empty($_POST)){
				ApriForm();
					ScriviCampo("modello", "Nome modello");
				ChiudiForm();
			} else {
				InserisciDB("modelli", $_POST);
				Messaggio("Inserimento avvenuto!");
			}
		break;
		
		case "modifica":
			if(empty($_POST)){
				$dati = EseguiDB("SELECT * FROM modelli WHERE idmodello=".intval($_GET["id"]));
				$riga = $dati->fetchArray();
				ApriForm();
					ScriviCampo("modello", "Nome modello", $riga["modello"]);
				ChiudiForm();
			} else {
				ModificaDB("modelli", $_POST, "idmodello", $_GET["id"]);
				Messaggio("Modifica avvenuta!");
			}
		break;
		
		default:
			DisegnaTabella("SELECT modelli.idmodello as id, modello, Count(mezzi.idmezzo) AS mezzi
							FROM modelli
							LEFT JOIN  mezzi ON modelli.idmodello=mezzi.idmodello
							GROUP BY modelli.idmodello", "id");
		break;
	}

	include("../parti/foot.php"); ?>