<?php
	include("parti/head.php");
	include("funzioni.php");
?>
	<h1>Gestione delle stazioni</h1>
	<p>
		Usa questa pagina per poter creare nuove stazioni
		o per gestire quelle attuali.
	</p>
	
<?php
		
	switch($_GET["azione"]){
		case "cancella":
			Cancella("pensiline", "idpensilina", $_GET["id"]);
			Messaggio("Cancellazione avvenuta con successo!");
		break;
		
		case "inserisci":
			if(empty($_POST)){
				ApriForm();
					ScriviCampo("pensilina", "Nome della pensilina");
					ScriviTendina("idstrada", "Stada di passaggio", "idstrada", "strada", "strade");
				ChiudiForm();
			} else {
				InserisciDB("pensiline", $_POST);
				Messaggio("Inserimento avvenuto!");
			}
		break;
		
		case "modifica":
			if(empty($_POST)){
				$dati = EseguiDB("SELECT pensilina, idstrada FROM pensiline WHERE idpensilina=".intval($_GET["id"]));
				$riga = $dati->fetchArray();
				ApriForm();
					ScriviCampo("pensilina", "Nome della pensilina", $riga["pensilina"]);
					ScriviTendina("idstrada", "Stada di passaggio", "idstrada", "strada", "strade", $riga["idstrada"]);
				ChiudiForm();
			} else {
				ModificaDB("pensiline", $_POST, "idpensilina", $_GET["id"]);
				Messaggio("Modifica avvenuta!");
			}
		break;
		
		default:
			DisegnaTabella("SELECT pensiline.idpensilina AS id, 
							pensiline.pensilina AS nome,
							strade.strada AS dove
							FROM pensiline
							LEFT JOIN strade ON pensiline.idstrada=strade.idstrada
							ORDER BY pensilina", "id");
		break;
	}

	include("parti/foot.php"); ?>