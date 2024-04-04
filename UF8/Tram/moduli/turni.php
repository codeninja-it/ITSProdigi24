<?php
	include("../parti/head.php");
	include("../funzioni.php");
?>
	<h1>Gestione dei turni</h1>
	<p>
		Usa questa pagina per poter creare nuovi turni di lavoro
		o per gestire quelli già assegnati.
	</p>
	
<?php
		
	switch($_GET["azione"]){
		case "cancella":
			Cancella("turni", "idturno", $_GET["id"]);
			Messaggio("Cancellazione avvenuta con successo!");
		break;
		
		case "inserisci":
			if(empty($_POST)){
				ApriForm();
					ScriviCampo("giorno", "giorno di lavoro", "", "date");
					ScriviTendina("idautista", "Chi è l'autista?", "idautista", "nomeCompleto", "listaAutisti");
					ScriviTendina("idlinea", "Su quale linea?", "idlinea", "linea", "linee");
					ScriviTendina("idmezzo", "Con quale mezzo?", "idmezzo", "mezzo", "mezzi");
				ChiudiForm();
			} else {
				InserisciDB("turni", $_POST);
				Messaggio("Inserimento avvenuto!");
			}
		break;
		
		case "modifica":
			if(empty($_POST)){
				$dati = EseguiDB("SELECT * FROM turni WHERE idturno=".intval($_GET["id"]));
				$riga = $dati->fetchArray();
				ApriForm();
					ScriviCampo("giorno", "giorno di lavoro", $riga["giorno"], "date");
					ScriviTendina("idautista", "Chi è l'autista?", "idautista", "nomeCompleto", "listaAutisti", $riga["idautista"]);
					ScriviTendina("idlinea", "Su quale linea?", "idlinea", "linea", "linee", $riga["idlinea"]);
					ScriviTendina("idmezzo", "Con quale mezzo?", "idmezzo", "mezzo", "mezzi", $riga["idmezzo"]);
				ChiudiForm();
			} else {
				ModificaDB("turni", $_POST, "idturno", $_GET["id"]);
				Messaggio("Modifica avvenuta!");
			}
		break;
		
		default:
			DisegnaTabella("SELECT turni.idturno AS id,
							turni.giorno, listaAutisti.nomeCompleto AS chi, 
							linee.linea, mezzi.mezzo
							FROM turni
							LEFT JOIN linee ON turni.idlinea=linee.idlinea
							LEFT JOIN mezzi ON turni.idmezzo=mezzi.idmezzo
							LEFT JOIN listaAutisti ON turni.idautista=listaAutisti.idautista
							ORDER BY giorno DESC;", "id");
		break;
	}

	include("../parti/foot.php"); ?>