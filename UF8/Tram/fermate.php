<?php
	include("parti/head.php");
	include("funzioni.php");
?>
	<h1>Gestione delle fermate</h1>
	<p>
		Usa questa pagina per poter creare nuove fermate
		o per gestire quelle attuali.
	</p>
	
<?php
		
	switch($_GET["azione"]){
		case "cancella":
			Cancella("fermate", "idfermata", $_GET["id"]);
			Messaggio("Cancellazione avvenuta con successo!");
		break;
		
		case "inserisci":
			if(empty($_POST)){
				ApriForm();
					ScriviCampo("orario", "Orario di fermata", "", "time");
					ScriviTendina("idpensilina", "Su quale pensilina?", "idpensilina", "pensilina", "pensiline");
					ScriviTendina("idlinea", "Per quale linea?", "idlinea", "linea", "linee");
				ChiudiForm();
			} else {
				InserisciDB("fermate", $_POST);
				Messaggio("Inserimento avvenuto!");
			}
		break;
		
		case "modifica":
			if(empty($_POST)){
				$dati = EseguiDB("SELECT * FROM fermate WHERE idfermata=".intval($_GET["id"]));
				$riga = $dati->fetchArray();
				ApriForm();
					ScriviCampo("orario", "Orario di fermata", $riga["orario"], "time");
					ScriviTendina("idpensilina", "Su quale pensilina?", "idpensilina", "pensilina", "pensiline", $riga["idpensilina"]);
					ScriviTendina("idlinea", "Per quale linea?", "idlinea", "linea", "linee", $riga["idlinea"]);
				ChiudiForm();
			} else {
				ModificaDB("fermate", $_POST, "idfermata", $_GET["id"]);
				Messaggio("Modifica avvenuta!");
			}
		break;
		
		default:
			DisegnaTabella("SELECT fermate.idfermata AS id,
							fermate.orario,
							linee.linea,
							strade.strada
							FROM fermate
							LEFT JOIN linee ON fermate.idlinea=linee.idlinea
							LEFT JOIN pensiline ON fermate.idpensilina=pensiline.idpensilina
							LEFT JOIN strade ON pensiline.idstrada=strade.idstrada
							ORDER BY orario", "id");
		break;
	}

	include("parti/foot.php"); ?>