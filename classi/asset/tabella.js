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
	
	ToString(campi){
		var buffer = "";
		for(var i=0; i<this.righe.length; i++){
			var riga = this.righe[i];
			if(this.filtro == null || this.filtro(riga) == true){
				buffer += riga.ToString(campi);
			}
		}
		return buffer;
	}
	
}