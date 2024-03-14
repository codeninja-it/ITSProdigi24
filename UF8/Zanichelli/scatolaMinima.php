<?php
	$ordine = array(
					"9788808734891" => 1,
					"9788808534729" => 6,
					"9788808184160" => 12,
					"9788808065131" => 2
				);
				
	$catalogo = file_get_contents("dati/libri.json");
	$catalogo = json_decode($catalogo, true);
	
	$volumeTotale = 0;
	$prezzoTotale = 0;
	$pesoTotale = 0;
	
	$i = 0;
	while($i < sizeof($catalogo)){
		$libro = $catalogo[$i];
		if(isset($ordine[$libro["isbn"]])){
			$volumeTotale += $libro["mm3"] * $ordine[ $libro["isbn"] ];
			$prezzoTotale += $libro["prezzo"] * $ordine[ $libro["isbn"] ];
			$pesoTotale += $libro["gr"] * $ordine[ $libro["isbn"] ];
		}
		$i++;
	}
	
	echo "Prezzo : €".$prezzoTotale."<br>";
	echo "Volume : ".ceil($volumeTotale/1000000)."lt<br>";
	echo "Peso : ".ceil($pesoTotale/1000)."kg<br>";