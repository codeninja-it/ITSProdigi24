<?php include("parti/head.php"); ?>
	<h1>Gestione degli utenti</h1>
	<p>
		Usa questa pagina per poter creare nuovi utenti
		o per gestire gli attuali.
	</p>
	
	<?php
		include("funzioni.php");
		switch($_GET["azione"]){
			case "cancella":
				Cancella("utenti", "idutente", $_GET["id"]);
				Messaggio("Cancellazione avvenuta con successo!");
			break;
			
			case "inserisci":
				if(empty($_POST)){
					?>
						<form method="post">
							<p class="form-group">
								<label for="nome">Nome utente</label>
								<input id="nome" name="nome" required class="form-control" />
							</p>
							<p class="form-group">
								<label for="amministratore">Admin</label>
								<input type="checkbox" value="true" id="amministratore" name="amministratore" class="form-check" />
							</p>
							<p class="form-group">
								<label for="email">Email</label>
								<input type="email" id="email" name="email" class="form-control" />
							</p>
							<p class="form-group">
								<label for="pass">Password</label>
								<input type="password" id="pass" name="pass" class="form-control" />
							</p>
							
						</form>
					<?php
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
					?>
						<form method="post">
							<p class="form-group">
								<label for="nome">Nome utente</label>
								<input value="<?php echo $riga["nome"]; ?>" id="nome" name="nome" required class="form-control" />
							</p>
							<p class="form-group">
								<label for="amministratore">Admin</label>
								<input <?php echo ($riga["amministratore"] ? "checked" : "") ; ?> type="checkbox" value="true" id="amministratore" name="amministratore" class="form-check" />
							</p>
							<p class="form-group">
								<label for="email">Email</label>
								<input value="<?php echo $riga["email"]; ?>" type="email" id="email" name="email" class="form-control" />
							</p>
							<p class="form-group">
								<label for="pass">Password</label>
								<input type="password" value="<?php echo $riga["pass"]; ?>" id="pass" name="pass" class="form-control" />
							</p>
							<button class="btn btn-primary">Salva</button>
							<button type="reset" class="btn btn-secondary">Annulla</button>
						</form>
					<?php
				} else {
					$_POST["amministratore"] = isset($_POST["amministratore"]);
					
					ModificaDB("utenti", $_POST, "idutente", $_GET["id"]);
					Messaggio("Modifica avvenuta!");
				}
			break;
		}
	?>

<?php include("parti/foot.php"); ?>