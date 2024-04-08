<?php
	session_start();
	include("parti/head.php"); 
	
	$utente = null;
	
	if(!empty($_POST)){
		$dbcon = new SQLite3("dati/tram.sqlite");
		$dbrec = $dbcon->query("SELECT * 
								FROM utenti 
								WHERE email='".htmlspecialchars($_POST["user"])."' and 
								pass='".htmlspecialchars($_POST["pwd"])."'
								LIMIT 1;");
		if($riga = $dbrec->fetchArray()){
			// mostrare all'utente che lo abbiamo riconosciuto
			$utente = $riga;
			$_SESSION["utente"] = $utente;
			?>
			<h3>Bentornato <?php echo $utente["nome"]; ?></h3>
			<p><a href="moduli/linee.php?azione=lista">clicca qui</a> per passare alla gestione delle linee!</p>
			<?php
		} else {
			// avvertire l'utente che ha sbagliato
			?>
				<p class="alert alert-danger">Attenzione: password o indirizzo email errati!</p>
			<?php
		}
	} else {
		?>
			<h3>Benvenuto</h3>
			<p>Per poter accedere alla gestione dei dati,
				usa pure il form qui sotto!</p>
			<form method="post">
				<p class="form-group">
					<label for="utente">nome utente</label>
					<input id="utente" name="user" class="form-control">
				</p>
				<p class="form-group">
					<label for="pass">password</label>
					<input type="password" id="pass" name="pwd" class="form-control">
				</p>
				<button type="submit" class="btn btn-primary">accedi</button>
			</form>
		<?php
	}
?>
					
				</div>
				<div class="col-md-4">
					Non hai ancora un account?
					Problemacci tuoi...
				</div>
			</div>
		</div>
	</body>
</html>