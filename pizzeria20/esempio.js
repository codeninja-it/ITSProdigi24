// questo è un codice di esempio in JSON

// non conosce data-type, o meglio
// lo identifica in automatico, in base all'uso
// costruiamo una variabile
var baseOperazione = 2;
var valore = 4;

var risultato = 1675;
// modifichiamo il contenuto di una variabile
risultato = baseOperazione * valore;
// lo trasmettiamo all'utente
// alert(risultato);
// alert(baseOperazione * valore); moltiplicazione
// alert(baseOperazione / valore); divisione
// alert(baseOperazione + valore); addizione
// alert(baseOperazione - valore); sottrazione
// alert(baseOperazione % valore); modulo
// alert(baseOperazione = valore); assegnazione
// alert(baseOperazione == valore); uguaglianza
// alert(baseOperazione != valore); not uguaglianza
// alert(baseOperazione > valore); maggiore
// alert(baseOperazione < valore); minore
// alert(baseOperazione >= valore); maggiore uguale
// alert(baseOperazione <= valore); minore uguale
// alert(true && true); AND logico
// alert(true || false); OR logico

var baseOperazione = prompt("che base vuoi?");

var resto = baseOperazione % 2;

var pari = resto == 0;

if(pari){
	alert("il tuo numero è pari!");
} else {
	alert("il tuo numero è dispari!");
}