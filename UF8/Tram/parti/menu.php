<div class="btn-group-vertical">
	<?php
		$voci = array(
					"Gestione degli autisti" => "autisti.php",
					"Gestione linee Tram" => "linee.php",
					"Gestione utenti" => "utenti.php", 
					"Gestione delle strade" => "strade.php");
		foreach($voci as $label => $link){
			echo "<a class='btn btn-outline-primary' href='".$link."?azione=lista'>".$label."</a>";
		}
	?>
</div>