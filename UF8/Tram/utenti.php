<?php
	include("parti/head.php");
	include("funzioni.php");
?>
	<h1>Gestione degli utenti</h1>
	<p>
		Usa questa pagina per poter creare nuovi utenti
		o per gestire gli attuali.
	</p>
	
<?php
		
	switch($_GET["azione"]){
		case "cancella":
			Cancella("utenti", "idutente", $_GET["id"]);
			Messaggio("Cancellazione avvenuta con successo!");
		break;
		
		case "inserisci":
			if(empty($_POST)){
				ApriForm();
					ScriviCampo("nome", "Nome utente");
					ScriviCampo("amministratore", "Admin", false, "checkbox");
					ScriviCampo("email", "Indirizzo email", "", "email");
					ScriviCampo("pass", "Password dell'utente", "", "password");
				ChiudiForm();
			} else {
				$_POST["amministratore"] = isset($_POST["amministratore"]);
				InserisciDB("utenti", $_POST);
				Messaggio("Inserimento avvenuto!");
			}
		break;
		
		case "modifica":
			if(empty($_POST)){
				$dati = EseguiDB("SELECT * FROM utenti WHERE idutente=".intval($_GET["id"]));
				$riga = $dati->fetchArray();
				ApriForm();
					ScriviCampo("nome", "Nome utente", $riga["nome"]);
					ScriviCampo("amministratore", "Admin", $riga["amministratore"], "checkbox");
					ScriviCampo("email", "Indirizzo email dell'utente", $riga["email"], "email");
					ScriviCampo("pass", "Password dell'utente", $riga["pass"], "password");
				ChiudiForm();
			} else {
				$_POST["amministratore"] = isset($_POST["amministratore"]);
				
				ModificaDB("utenti", $_POST, "idutente", $_GET["id"]);
				Messaggio("Modifica avvenuta!");
			}
		break;
		
		default:
			DisegnaTabella("SELECT idutente as id, nome, email, iif(amministratore, 'si', 'no') as admin FROM utenti", "id");
		break;
	}

	include("parti/foot.php"); ?>