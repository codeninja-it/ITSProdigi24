<?php
	session_start();
	if(empty($_SESSION["idutente"])){
		header("Location: index.php");
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
		<h1>Domande</h1>
		<p>Usa questa pagina per gestire le domande in banca dati, ricorda che per vederle puoi usare <a href='endpoint.php'>questo link</a>.</p>
		<?php
			$db = new mysqli("127.0.0.1", "root", "", "itsprodigi");
			if(!empty($_GET["act"])){
				switch($_GET["act"]){
					case "del":
						$db->query("DELETE FROM domande WHERE iddomanda=".intval($_GET["id"])." LIMIT 1;");
					break;
					
					case "new":
						$db->query("INSERT INTO domande (domanda, corretta, errata, punti, idcreatore)
									VALUES ('".addslashes($_POST["domanda"])."', '".addslashes($_POST["corretta"])."', '".addslashes($_POST["errata"])."', ".intval($_POST["punti"]).", ".$_SESSION["idutente"].");");
					break;
				}
			}
			$dati = $db->query("SELECT * FROM domande;");
			echo "<form method='post' action='?act=new'>
					<table>
						<thead>
							<tr>
							<th>domanda</th>
							<th>corretta</th>
							<th>errata</th>
							<th style='width:1%;'>punti</th>
							<th style='width:1%;'></th>
							</tr>
						</thead>
						<tbody>";
							while($riga = $dati->fetch_assoc()){
								echo "<tr>
										<td>".htmlentities($riga["domanda"])."</td>
										<td>".$riga["corretta"]."</td>
										<td>".$riga["errata"]."</td>
										<td align='right'>".$riga["punti"]."</td>
										<td align='right'><a href='?act=del&id=".$riga["iddomanda"]."' title='cancella domanda'>&#10062;</a></td>
									</tr>";
							}
				echo "</tbody>
					<tfoot>
						<tr>
							<td><input type'text' name='domanda' placeholder='domanda...' /></td>
							<td><input type'text' name='corretta' placeholder='corretta...' /></td>
							<td><input type'text' name='errata' placeholder='errata...' /></td>
							<td align='right'><input type'number' name='punti' placeholder='punti...' /></td>
							<td align='right'><button title='inserisci domanda'>&#128232;</button></td>
						</tr>
					</tfoot>
				</table>
			</form>";
			$db->close();
		?>
	</body>
</html>