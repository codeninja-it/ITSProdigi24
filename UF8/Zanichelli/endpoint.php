var <?php echo $_GET["tab"]; ?> = <?php

 echo file_get_contents("dati/" . $_GET["tab"] . ".json"); 
 
 ?> ;