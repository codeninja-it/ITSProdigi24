<?php
	$zanichelli = file_get_contents("asset/CatalogoZanichelli.csv");
	$zanichelli = mb_convert_encoding($zanichelli, "ASCII");
	
	$libri = [];
	
	$re = '/(?<isbn>\d{13})\t(?<autori>[^\t]*)?\t(?<titolo>[^\t]*)?\t(?<sottotitolo>[^\t]*)?\t(?<edizione>[^\t]*)?\t(?<descrizione>[^\t]*)?\t(?<prezzo>\d*)?\t(?<pagine>\d*)?\t"(?<note>.*)(?<base>\d{3})x(?<altezza>\d{3}), (?<anno>\d*)"/m';

	preg_match_all($re, $zanichelli, $trovati, PREG_SET_ORDER, 0);

	for($i = 0; $i < sizeof($trovi); $i++){
		$trovato = $trovati[$i];
		
		$libro = [];
			$libro["isbn"] = $trovato["isbn"];
			$libro["titolo"] = $trovato["titolo"];
			$libro["sottotitolo"] = $trovato["sottotitolo"];
			$libro["prezzo"] = $trovato["prezzo"] / 100;
			$libro["pagine"] = $trovato["pagine"];
			$libro["base"] = $trovato["base"];
			$libro["altezza"] = $trovato["altezza"];
			
		$libri[] = $libro;
	}
	
	file_put_contents("dati/libri.json", json_encode($libri, JSON_PRETTY_PRINT) );