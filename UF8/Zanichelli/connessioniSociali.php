<?php
	$libri = json_decode( file_get_contents("dati/libri.json"), true);
	
	$connessioni = [];

	function aggiorna(&$connessioni, $a, $b){
		if($a != $b){	
			$sx = min($a, $b);
			$dx = max($a, $b);
			$trovato = false;
			foreach($connessioni as &$connessione){
				if($connessione["sx"] == $sx && $connessione["dx"] == $dx){
					$connessione["peso"] += .5;
					$trovato = true;
					$break;
				}
			}
			if(!$trovato){
				$connessioni[] = array("sx" => $sx, "dx" => $dx, "peso" => .5);
			}
		}
	}
	
	foreach($libri as $libro){
		foreach($libro["idAutori"] as $a){
			foreach($libro["idAutori"] as $b){
				aggiorna($connessioni, $a, $b);
			}
		}
	}
	
	file_put_contents("dati/connessioni.json", json_encode($connessioni, JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT));