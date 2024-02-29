class Riga {
	
	ToString(campi, evidenza){ // ["id", "codice", "prezzo"], "return x.categoria=='videogame'"
		var fxEvidenza = new Function("x", evidenza);
		if(fxEvidenza(this)){
			var buffer = "<tr class='evidenza'>";
		} else {
			var buffer = "<tr>";
		}
		var attributi = Object.keys(this);
		var valori = Object.values(this);
		for(var i=0; i < attributi.length; i++){
			var attributo = attributi[i];
			var valore = valori[i];
			if(campi == null || campi.indexOf(attributo) > -1){
				buffer += "<td>" + valore + "</td>";
			}
		}
		
		return buffer + "</tr>";
	}
	
}