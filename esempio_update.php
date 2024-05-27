<?php
	// http://127.0.0.1/IOT/centraline.php?id=1&azione=modifica
	
	$dbcon = new MySQLi("127.0.0.1", "root", "", "IOT");
	if(isset($_POST)){
		// deve aver avuto accesso al form
		$dbcon->query("UPDATE centraline
						SET nome='".$_POST["nomeCentralina"]."', 
							dove='".$_POST["indirizzo"]."'
						WHERE idCentralina=".$_GET["id"].";");
	} else {
		// non ha ancora ricevuto gli strumenti
		$dati = $dbcon->query("SELECT *
								FROM centraline 
								WHERE idCentralina=".$_GET["id"]);
		if($riga = $dati->fetch_assoc()){
			?>
			<form method="POST">
				<input name="nomeCentralina" 
						placeholder="nome della centralina"
						value="<?php echo $riga["nome"]; ?>" />
				<input name="indirizzo"
						placeholder="dove è stata installata?"
						value="<?php echo $riga["dove"]; ?>" />
				<button>invia</button>
			</form>
			<?php
		}
		
	}