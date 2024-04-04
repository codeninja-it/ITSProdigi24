<?php
	include("../parti/head.php");
	include("../funzioni.php");
?>
	<h1>Gestione delle strade</h1>
	<p>
		Usa questa pagina per poter creare nuove strade
		o per gestire quelle attuali.
	</p>
	
<?php
		
	switch($_GET["azione"]){
		case "cancella":
			Cancella("strade", "idstrada", $_GET["id"]);
			Messaggio("Cancellazione avvenuta con successo!");
		break;
		
		case "inserisci":
			if(empty($_POST)){
				ApriForm();
					ScriviCampo("strada", "Nome strada");
					ScriviCampo("lunghezza", "Lunghezza", 0, "number");
				ChiudiForm();
			} else {
				InserisciDB("strade", $_POST);
				Messaggio("Inserimento avvenuto!");
			}
		break;
		
		case "modifica":
			if(empty($_POST)){
				$dati = EseguiDB("SELECT * FROM strade WHERE idstrada=".intval($_GET["id"]));
				$riga = $dati->fetchArray();
				ApriForm();
					ScriviCampo("strada", "Nome strada", $riga["strada"]);
					ScriviCampo("lunghezza", "Lunghezza strada", $riga["lunghezza"], "number");
				ChiudiForm();
			} else {
				ModificaDB("strade", $_POST, "idstrada", $_GET["id"]);
				Messaggio("Modifica avvenuta!");
			}
		break;
		
		default:
			DisegnaTabella("SELECT idstrada as id, strada, lunghezza FROM strade", "id");
		break;
	}

	include("../parti/foot.php"); ?>