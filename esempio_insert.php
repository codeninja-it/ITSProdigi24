<?php
	// http://127.0.0.1/IOT/centraline.php
	
	if(isset($_POST)){
		// deve aver avuto accesso al form
		$dbcon = new MySQLi("127.0.0.1", "root", "", "IOT");
		$dbcon->query("INSERT INTO centraline (nome, dove)
						VALUES (
								'".$_POST["nomeCentralina"]."', 
								'".$_POST["indirizzo"]."'
								);");
	} else {
		// non ha ancora ricevuto gli strumenti
		?>
		<form method="POST">
			<input name="nomeCentralina" 
					placeholder="nome della centralina" />
			<input name="indirizzo"
					placeholder="dove è stata installata?" />
			<button>invia</button>
		</form>
		<?php
	}