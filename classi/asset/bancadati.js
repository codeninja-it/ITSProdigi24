var categorie = new Tabella("categorie");
categorie.Add(new Categoria(1, "Videogiochi"))
			.Add(new Categoria(2, "Casa"));

var tabella = new Tabella("Prodotti");
tabella.Add(new Prodotto(1, "XBOX", 300))
		.Add(new Prodotto(2, "Switch", 255))
		.Add(new Prodotto(3, "Play Station 5", 500))
		.Add(new Prodotto(4, "Tostapane", 25));

// stampa tutti i prodotti
//tabella.Filtro(function(riga){ return riga.prezzo < 300; });
console.log( 
				tabella.ToString(["id", "codice"])
			);
			
console.log( tabella.Where(function(riga){ return riga.prezzo <= 300;}).ToString(["codice"]) );
console.log( tabella.Where(function(riga){ return riga.prezzo == 500;}).ToString(["codice"]) );
console.log( tabella.Where(function(riga){ return riga.codice.indexOf("a") > -1;}).ToString(["codice", "prezzo"]) );