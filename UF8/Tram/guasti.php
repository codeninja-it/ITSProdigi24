<?php
	include("parti/head.php");
	include("funzioni.php");
?>
	<h1>Gestione delle segnalazioni di guasto</h1>
	<p>
		Usa questa pagina per poter segnalare un nuovo guasto
		o per gestire quelli già inseriti.
	</p>
	
<?php
		
	switch($_GET["azione"]){
		case "cancella":
			Cancella("guasti", "idguasto", $_GET["id"]);
			Messaggio("Cancellazione avvenuta con successo!");
		break;
		
		case "inserisci":
			if(empty($_POST)){
				ApriForm();
					ScriviCampo("tipo", "Tipo di guasto");
					ScriviTendina("idmezzo", "Quale mezzo si è rotto?", "idmezzo", "mezzo", "mezzi");
					scriviCampo("quando", "Quando è successo?", "", "date");
					scriviCampo("risolto", "Ora è risolto?", false, "checkbox");
				ChiudiForm();
			} else {
				InserisciDB("guasti", $_POST);
				Messaggio("Inserimento avvenuto!");
			}
		break;
		
		case "modifica":
			if(empty($_POST)){
				$dati = EseguiDB("SELECT * FROM guasti WHERE idguasto=".intval($_GET["id"]));
				$riga = $dati->fetchArray();
				ApriForm();
					ScriviCampo("tipo", "Tipo di guasto", $riga["tipo"]);
					ScriviTendina("idmezzo", "Quale mezzo si è rotto?", "idmezzo", "mezzo", "mezzi", $riga["idmezzo"]);
					scriviCampo("quando", "Quando è successo?", $riga["quando"], "date");
					scriviCampo("risolto", "Ora è risolto?", $riga["risolto"], "checkbox");
				ChiudiForm();
			} else {
				ModificaDB("guasti", $_POST, "idguasto", $_GET["id"]);
				Messaggio("Modifica avvenuta!");
			}
		break;
		
		default:
			DisegnaTabella("SELECT guasti.idguasto AS id,
							guasti.tipo,
							mezzi.mezzo,
							IIF(guasti.risolto, 'si', 'no') AS risolto,
							guasti.quando
							FROM guasti
							LEFT JOIN mezzi ON guasti.idmezzo=mezzi.idmezzo
							ORDER BY quando DESC", "id");
		break;
	}

	include("parti/foot.php"); ?>