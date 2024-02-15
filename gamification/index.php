<?php 
	session_start();
	if(!empty($_POST)){
		$db = new mysqli("127.0.0.1", "root", "", "itsprodigi");
		// si è presentato
		$dati = $db->query("SELECT idutente, livello 
							FROM utenti
							WHERE email = '".addslashes($_POST["email"])."' AND
							password = MD5('".addslashes($_POST["pass"])."') AND
							livello = 1
							LIMIT 1;");
		if($riga = $dati->fetch_array()){
			$_SESSION["idutente"] = $riga["idutente"];
			$_SESSION["livello"] = $riga["livello"];
			header("Location: domande-crud.php");
		}
		$db->close();
	}
 ?>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Domande</title>
		<link rel="stylesheet" href="asset/stile.css" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	</head>
	<body>
		<h1>Benvenuto</h1>
		<p>Usa questo form per accedere al sistema.</p>
		<form method="post">
			<p>
				<label for="email">eMail</label>
				<input id="email" name="email" />
			</p>
			<p>
				<label for="pass">Password</label>
				<input type="password" id="pass" name="pass" />
			</p>
			<button>login</button>
		</form>
				
	</body>
</html>