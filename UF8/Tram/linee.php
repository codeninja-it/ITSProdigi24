<html>
	<head>
		<title>Gestione Tram</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="asset/stile.css" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<h1>Gestione Linee</h1>
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
				$dati = $dbcon->query("SELECT linee.idlinea, linee.linea,
										count(fermate.idlinea) as fermate,
										min(fermate.orario) as dalle,
										max(fermate.orario) as alle
										FROM linee
										LEFT JOIN fermate on linee.idlinea=fermate.idlinea
										GROUP BY linee.idlinea");
				
				echo "<ul>";
					// estraggo una riga
					while($riga = $dati->fetchArray()){
						echo "<li>";
							echo "<a href='?del=".$riga["idlinea"]."'>&#10062;</a>";
							echo "<p>";
								echo $riga["linea"]."<br>";
								echo $riga["fermate"]." fermate<br>";							
								echo $riga["dalle"]." &raquo; ".$riga["alle"];
							echo "</p>";
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