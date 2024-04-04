<div class="btn-group-vertical">
	<?php
		$voci = scandir(__DIR__ . "/../moduli/");
		unset($voci[0]);
		unset($voci[1]);
		foreach($voci as $file){
			$pezzi = explode(".", $file);
			echo "<a class='btn btn-outline-primary' href='".$file."?azione=lista'>gestione ".$pezzi[0]."</a>";
		}
	?>
</div>