<?php
	include("parti/head.php");
	include("funzioni.php");
?>
	<h1>Gestione dei tram</h1>
	<p>
		Usa questa pagina per poter creare nuovi tram
		o per gestire quelli attuali.
	</p>
	
<?php
		
	switch($_GET["azione"]){
		case "cancella":
			Cancella("mezzi", "idmezzo", $_GET["id"]);
			Messaggio("Cancellazione avvenuta con successo!");
		break;
		
		case "inserisci":
			if(empty($_POST)){
				ApriForm();
					ScriviCampo("mezzo", "Nome del tram");
					ScriviCampo("targa", "Targa");
					ScriviCampo("modello", "Modello");
					ScriviCampo("passeggeri", "Passeggeri", 0, "number");
				ChiudiForm();
			} else {
				InserisciDB("mezzi", $_POST);
				Messaggio("Inserimento avvenuto!");
			}
		break;
		
		case "modifica":
			if(empty($_POST)){
				$dati = EseguiDB("SELECT * FROM mezzi WHERE idmezzo=".intval($_GET["id"]));
				$riga = $dati->fetchArray();
				ApriForm();
					ScriviCampo("mezzo", "Nome del tram", $riga["mezzo"]);
					ScriviCampo("targa", "Targa", $riga["targa"]);
					ScriviCampo("modello", "Modello", $riga["modello"]);
					ScriviCampo("passeggeri", "Passeggeri", $riga["passeggeri"], "number");
				ChiudiForm();
			} else {
				ModificaDB("mezzi", $_POST, "idmezzo", $_GET["id"]);
				Messaggio("Modifica avvenuta!");
			}
		break;
		
		default:
			DisegnaTabella("SELECT idmezzo as id, mezzo, passeggeri FROM mezzi", "id");
		break;
	}

	include("parti/foot.php"); ?>