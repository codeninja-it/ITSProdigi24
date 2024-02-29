class Tabella { // Create Read Update Delete
	
	constructor(nome){
		this.nome = nome; // "utenti"
		this.righe = []; // []
		this.ultimoId = 0; // 
		this.filtro = null;
	}
	
	Join(altraTabella, condizioneOn){
		var nuova = new Tabella(this.nome + "_" + altraTabella.nome);
		var filtro = new Function("sx", "dx", condizioneOn); // return sx.idCategoria==dx.idCategoria;
		for(var i=0; i < this.righe.length; i++){
			for(var j=0; j < altraTabella.righe.length; j++){
				var sx = this.righe[i];
				var dx = altraTabella.righe[j];
				if(filtro(sx, dx)){
					//allora le fondo e le aggiungo
					var attributiDX = Object.keys(dx);
					for(var x=0; x < attributiDX.length; x++){
						var attributo = attributiDX[x];
						var valore = dx[attributo];
						sx[attributo] = valore;
					}
					nuova.Add(sx);
				}
			}
		}
		return nuova;
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
		var filtro = new Function("x", condizione);
		var nuova = new Tabella(this.nome);
		for(var i=0; i < this.righe.length; i++){
			var riga = this.righe[i];
			if(filtro(riga) == true){
				nuova.Add(riga);
			}
		}
		return nuova;
	}
	
	ToString(campi, FxEvidenza){
		var buffer = "<h2>" + this.nome + "</h2><table>";
		for(var i=0; i<this.righe.length; i++){
			var riga = this.righe[i];
			if(this.filtro == null || this.filtro(riga) == true){
				buffer += riga.ToString(campi, FxEvidenza);
			}
		}
		return buffer + "</table>";
	}
	
}