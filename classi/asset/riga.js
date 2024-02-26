class Riga {
	
	ToString(campi){ // ["id", "codice", "prezzo"]
		var buffer = "<tr>";
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