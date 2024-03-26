<?php include("parti/head.php"); ?>
	<h1>Login</h1>
	<p>Per accedere al sistema ricordati di inserire le tue credenziali!</p>
	<?php
		
		include("funzioni.php");
		
		if(!empty($_POST)){
			$sql = "SELECT * 
						FROM utenti 
						WHERE email='".addslashes($_POST["email"])."' AND
						pass='".addslashes($_POST["password"])."';";
						
			echo "<p>".$sql."</p>";
						
			$dati = EseguiDB($sql);
			if($riga = $dati->fetchArray()){
				echo "Benvenuto ".$riga["nome"]."!";
			}
		} else {
			?>
				<form method="post">
					<p class="form-group">
						<label for="email">email</label>
						<input type="email" name="email" id="email" class="form-control">
					</p>
					<p class="form-group">
						<label for="password">password</label>
						<input type="password" name="password" id="password" class="form-control">
					</p>
					<button class="btn btn-primary">accedi</button>
				</form>
			<?php
		}
	
	?>
	
<?php include("parti/foot.php"); ?>