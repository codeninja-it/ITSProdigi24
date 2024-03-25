<?php include("parti/head.php"); ?>
	<h1>Gestione Autisti</h1>
	<p>Usa questa pagina per gestire gli autisti 
		cliccando sulla linea che ti interessa o utilizzando 
		i pulsanti in pagina</p>
	
	
	<?php
		// mi connetto alla banca dati
		$dbcon = new SQLite3("dati/tram.sqlite");
		
			// se mi hanno chiesto di cancellare un record, lo falcio
			if( isset($_GET["del"]) ){
				$daEliminare = intval($_GET["del"]);
				$dbcon->query("DELETE 
								FROM autisti 
								WHERE idautista=".$daEliminare."
								LIMIT 1");
			}
			
			// se invece mi chiedono di inserirne uno nuovo, lo carico
			if( !empty($_POST["nome"]) && !empty($_POST["cognome"]) ){
				$nome = addslashes($_POST["nome"]);
				$cognome = addslashes($_POST["cognome"]);
				$dbcon->query("INSERT INTO autisti (nome, cognome) VALUES
									('".$nome."', '".$cognome."');");
			}
			
		
			// recupero ciò che mi serve
			$dati = $dbcon->query("SELECT * 
									FROM autisti");
			
			echo "<ul>";
				// estraggo una riga
				while($riga = $dati->fetchArray()){
					echo "<li>";
						echo "<a href='?del=".$riga["idautista"]."'>&#10062;</a>";
						echo "<p>";
							echo $riga["nome"]." ".$riga["cognome"];
						echo "</p>";
					echo "</li>";
				}
			echo "</ul>";
		
		// chiudo la mia connessione
		$dbcon->close();
	?>
	
	<form method="post">
		<p>
			<label for="nome">Nome autista</label>
			<input id="nome" name="nome" />
		</p>
		<p>
			<label for="cgnome">Cognome autista</label>
			<input id="cognome" name="cognome" />
		</p>
		<button>inserisci</button>
	</form>
		
<?php include("parti/foot.php"); ?>