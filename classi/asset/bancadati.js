class Prodotto {

	constructor(id, codice, prezzo){
		this.id = id;
		this.codice = codice;
		this.prezzo = prezzo;
	}
	
	ToString(){
		return "<tr><td>" + this.id + "</td><td>" + this.codice + "</td><td>€ " + this.prezzo + "</td></tr>";
	}

}

class CategoriaProdotto {
	constructor(id, categoria){
		this.id = id;
		this.categoria = categoria;
	}
	
	ToString(){
		return "<tr><td>" + this.categoria + "</td></tr>";
	}
}

class Tabella { // Create Read Update Delete
	
	constructor(nome){
		this.nome = nome; // "utenti"
		this.righe = []; // []
		this.ultimoId = 0; // 
		this.filtro = null;
	}
	
	// deve aggiungere una riga alle righe di tabella
	Add(riga){
		this.righe.push(riga);
		return this;
	}
	
	Remove(){
	}
	
	Update(){
	}
	
	Filtro(condizione){
		this.filtro = condizione;
	}
	
	Where(condizione){
		this.filtro = condizione;
		var nuova = new Tabella(this.nome);
		for(var i=0; i < this.righe.length; i++){
			var riga = this.righe[i];
			if(this.filtro(riga) == true){
				nuova.Add(riga);
			}
		}
		return nuova;
	}
	
	ToString(){
		var buffer = "";
		for(var i=0; i<this.righe.length; i++){
			var riga = this.righe[i];
			if(this.filtro == null || this.filtro(riga) == true){
				buffer += riga.ToString();
			}
		}
		return buffer;
	}
	
}

var categorie = new Tabella("categorie");
categorie.Add(new CategoriaProdotto(1, "Videogiochi"))
			.Add(new CategoriaProdotto(2, "Casa"));

var tabella = new Tabella("Prodotti");
tabella.Add(new Prodotto(1, "XBOX", 300))
		.Add(new Prodotto(2, "Switch", 255))
		.Add(new Prodotto(3, "Play Station 5", 500))
		.Add(new Prodotto(4, "Tostapane", 25));

// stampa tutti i prodotti
//tabella.Filtro(function(riga){ return riga.prezzo < 300; });
console.log( 
				tabella.ToString()
			);
			
console.log( tabella.Where(function(riga){ return riga.prezzo <= 300;}).ToString() );
console.log( tabella.Where(function(riga){ return riga.prezzo == 500;}).ToString() );
console.log( tabella.Where(function(riga){ return riga.codice.indexOf("a") > -1;}).ToString() );

// stampa tutte le categorie
console.log( categorie.ToString() );

//console.log( tabella.length );

//var target = document.createElement("TABLE");

//for(var i=0; i < tabella.length; i++){
//	var riga = tabella[i];
//	target.innerHTML += "<tr><td>" + riga.nome + "</td><td>€" + riga.prezzo + "</td></tr>";
//}

//setTimeout(
//		function() {
//			document.body.appendChild(target);
//		}, 
//		1000
//	);