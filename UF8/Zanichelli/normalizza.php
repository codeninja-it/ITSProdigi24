<?php
	$zanichelli = file_get_contents("asset/CatalogoZanichelli.csv");
	$zanichelli = mb_convert_encoding($zanichelli, "ASCII");
	
	$libri = [];
	$autori = [];
	
	$re = '/(?<isbn>\d{13})\t(?<autori>[^\t]*)?\t(?<titolo>[^\t]*)?\t(?<sottotitolo>[^\t]*)?\t(?<edizione>[^\t]*)?\t(?<descrizione>[^\t]*)?\t(?<prezzo>\d*)?\t(?<pagine>\d*)?\t"(?<note>.*)(?<base>\d{3})x(?<altezza>\d{3}), (?<anno>\d*)"/m';

	preg_match_all($re, $zanichelli, $trovati, PREG_SET_ORDER, 0);

	for($i = 0; $i < sizeof($trovati); $i++){
		$trovato = $trovati[$i];
		
		$libro = [];
			$libro["isbn"] = intval($trovato["isbn"]);
			$libro["titolo"] = str_replace("\"", "", $trovato["titolo"]);
			$libro["sottotitolo"] = str_replace("\"", "", $trovato["sottotitolo"]);
			$libro["prezzo"] = intval($trovato["prezzo"]) / 100;
			$libro["pagine"] = intval($trovato["pagine"]);
			$libro["base"] = intval($trovato["base"]);
			$libro["altezza"] = intval($trovato["altezza"]);
			$libro["anno"] = intval($trovato["anno"]);
			$libro["idAutori"] = [];
		
		$scrittori = explode("-", $trovato["autori"]);
		for($j=0; $j < sizeof($scrittori); $j++){
			$autore = strtoupper(trim(str_replace("\"", "", $scrittori[$j])));
			if(!isset($autori[$autore])){
				$autori[$autore] = sizeof($autori) + 1;
			}
			$libro["idAutori"][] = $autori[$autore];
		}
		
		$libri[] = $libro;
	}
	
	file_put_contents("dati/libri.json", json_encode($libri, JSON_PRETTY_PRINT) );
	file_put_contents("dati/autori.json", json_encode($autori, JSON_PRETTY_PRINT) );