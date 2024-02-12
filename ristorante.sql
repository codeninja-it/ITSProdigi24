CREATE TABLE tipi ( 
	idtipo integer primary key autoincrement, 
	tipo text
);

CREATE TABLE camerieri (
	idcameriere integer primary key autoincrement, 
	cameriere text
);

CREATE TABLE piatti (
	idpiatto integer primary key autoincrement,
	idtipo integer,
	piatto text
);

CREATE TABLE locali (
	idlocale integer primary key autoincrement,
	locale text
);

CREATE TABLE tavoli (
	idtavolo integer primary key autoincrement,
	idlocale integer,
	tavolo text
);

CREATE TABLE comande (
	idcomanda integer primary key autoincrement,
	idtavolo integer,
	idpiatto integer,
	idcameriere integer,
	qta integer,
	fatto bool,
	quando datetime
);

CREATE TABLE menu (
	idmenu integer primary key autoincrement,
	idlocale integer,
	menu text
);

CREATE TABLE menuRighe (
	idRiga integer primary key autoincrement,
	idPiatto integer,
	idMenu integer,
	prezzo double
);

CREATE TABLE magazzini (
	idmagazzino integer primary key autoincrement,
	idlocale integer,
	magazzino text
);

CREATE TABLE alimenti (
	idalimento integer primary key autoincrement,
	alimento text
);

CREATE TABLE movimentazioni (
	idmovimentazione integer primary key autoincrement,
	idalimento integer,
	idmagazzino integer,
	qta double,
	quando datetime
);

CREATE TABLE ingredienti (
	idingrediente integer primary key autoincrement,
	idalimento integer,
	qta double,
	idpiatto integer
);

CREATE TABLE pagineWeb (
	idpagina integer primary key autoincrement,
	idlocale integer,
	titolo text,
	corpo text,
	idpadre integer
);