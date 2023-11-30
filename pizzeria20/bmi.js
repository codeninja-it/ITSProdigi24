// calcolatrice per il Body Mass Index

// bmi = peso in kg / (statura * statura)
// raccolta dati
var pesoKg = prompt("dammi il peso in Kg");
var staturaMt = prompt("dimmi ora la statura in metri");

// calcolo logico
var bmi = pesoKg / (staturaMt * staturaMt);

// presentazione dei risultati
var spanPeso = document.getElementById("peso");
var spanAltezza = document.getElementById("altezza");
var spanBMI = document.getElementById("bmi");
var spanValutazione = document.getElementById("valutazione");

spanPeso.innerText = pesoKg;
spanAltezza.innerText = staturaMt;
spanBMI.innerText = bmi;

if(bmi < 16.5)
	spanValutazione.innerText = "forte sottopeso";
else if(bmi < 18.4)
	spanValutazione.innerText = "leggero sottopeso";
else if(bmi < 24.9)
	spanValutazione.innerText = "normale";
else
	spanValutazione.innerText = "leggero sovrappeso";
	
