<html>
	<head>
		<title>Gestione Tram</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="asset/stile.css" />
	</head>
	<body>
		<h1>Gestione Tram</h1>
		<p>Usa questa pagina per gestire le linee cittadine 
			cliccando sulla linea che ti interessa o utilizzando 
			i pulsanti in pagina</p>
		
		
		<?php
			// mi connetto alla banca dati
			$dbcon = new SQLite3("dati/tram.sqlite");
			
				// se mi hanno chiesto di cancellare un record, lo falcio
				if( isset($_GET["del"]) ){
					$daEliminare = intval($_GET["del"]);
					$dbcon->query("DELETE FROM linee WHERE idlinea=".$daEliminare);
				}
				
				// se invece mi chiedono di inserirne uno nuovo, lo carico
				if( isset($_POST["nuova"]) ){
					$daCreare = addslashes($_POST["nuova"]);
					$dbcon->query("INSERT INTO linee (linea) VALUES ('".$daCreare."');");
				}
				
			
				// recupero ciò che mi serve
				$dati = $dbcon->query("SELECT * FROM linee");
				
				echo "<ul>";
					// estraggo una riga
					while($riga = $dati->fetchArray()){
						echo "<li>";
							echo $riga["linea"];
							echo " <a href='?del=".$riga["idlinea"]."'>[cancella]</a>";
						echo "</li>";
					}
				echo "</ul>";
			
			// chiudo la mia connessione
			$dbcon->close();
		?>
		
		<form method="post">
			<p>
				<label for="linea">Nuova linea</label>
				<input id="linea" name="nuova" />
			</p>
			<button>inserisci</button>
		</form>
		
	</body>
</html>