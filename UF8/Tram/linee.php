<?php include("parti/head.php"); ?>
	<h1>Gestione Linee</h1>
	<p>Usa questa pagina per gestire le linee cittadine 
		cliccando sulla linea che ti interessa o utilizzando 
		i pulsanti in pagina</p>

	<?php
			include("funzioni.php");
			
			// mi connetto alla banca dati
			$dbcon = new SQLite3("dati/tram.sqlite");
			
			switch($_GET["azione"]){
				case "cancella":
						// ?azione=cancella&id=10000
						Cancella("linee", "idlinea", $_GET["id"]);
						echo "<div class='alert alert-success'>
									Linea cancellata con successo!
								</div>";
				break;
					
				case "inserisci":
					if(empty($_POST)){
						// istante 1: l'utente vuole inserire ma non mi ha detto cosa
						?>
						<form method="post">
							<p class="form-group">
								<label for="linea">Nome della linea</label>
								<input id="linea" name="nome" class="form-control" />
							</p>
							<button class="btn btn-primary">salva</button>
						</form>
						<?php
					} else {
						// istante 2: so cosa vuole inserire e lo inserisco
						EseguiDB("INSERT INTO linee (linea) 
									VALUES ('".addslashes($_POST["nome"])."')");
						echo "<div class='alert alert-success'>
									Linea inserita con successo!
								</div>";
					}
				break;
				
				case "modifica":
					break;
				
				default:
					// recupero ciò che mi serve
					$dati = $dbcon->query("SELECT linee.idlinea, linee.linea,
											count(fermate.idlinea) as fermate,
											min(fermate.orario) as dalle,
											max(fermate.orario) as alle
											FROM linee
											LEFT JOIN fermate on linee.idlinea=fermate.idlinea
											GROUP BY linee.idlinea");
					
					echo "<table class='table table-hover'>";
						echo "<thead>";
							echo "<tr>";
								echo "<th>Linea</th>";
								echo "<th>Inizio</th>";
								echo "<th>Fine</th>";
								echo "<th>
											<a href='?azione=inserisci' class='btn btn-success'>
												<span class='material-symbols-outlined'>add</span>
											</a>
										</th>";
							echo "</tr>";
						echo "</thead>";
						echo "<tbody>";
							// estraggo una riga
							while($riga = $dati->fetchArray()){
								echo "<tr>";
									echo "<td>".$riga["linea"]."</td>";
									echo "<td>".$riga["dalle"]."</td>";
									echo "<td>".$riga["alle"]."</td>";
									echo "<td>
											<a href='?azione=cancella&id=".$riga["idlinea"]."' class='btn btn-danger'>
												<span class='material-symbols-outlined'>delete</span>
											</a>
										</td>";
								echo "</tr>";
							}
						echo "</tbody>";
					echo "</table>";
				
					// chiudo la mia connessione
					$dbcon->close();
				break;
			}
			
			
	?>
		
<?php include("parti/foot.php"); ?>