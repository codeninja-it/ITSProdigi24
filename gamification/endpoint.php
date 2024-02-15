<?php
	$db = new mysqli("127.0.0.1", "root", "", "itsprodigi");
	if($db->connect_errno){
		echo $db->connect_errno;
	} else {
		$dati = $db->query("SELECT domanda, corretta, errata, punti
							FROM domande
							ORDER BY Rand();");
		$buffer = [];
		while($riga = $dati->fetch_assoc()){
			$buffer[] = array(
				"domanda" => mb_convert_encoding($riga["domanda"],"ASCII"),
				"corretta" => mb_convert_encoding($riga["corretta"],"ASCII"),
				"errata" => mb_convert_encoding($riga["errata"],"ASCII"),
				"punti" => $riga["punti"]
			);
		}
		echo "var domande = ";
		echo json_encode($buffer, JSON_PRETTY_PRINT | JSON_NUMERIC_CHECK );
		echo ";";
	}