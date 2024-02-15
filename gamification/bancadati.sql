CREATE DATABASE IF NOT EXISTS itsprodigi;
USE itsprodigi;

/* creazione delle utenze */
CREATE TABLE IF NOT EXISTS utenti (
	idutente integer primary key auto_increment,
	email text NOT NULL,
	password text NOT NULL,
	livello int DEFAULT 0, /* 0 front, 1 back */
	idcreatore int NOT NULL,
	datamod datetime NOT NULL
);

DELETE FROM utenti;
INSERT INTO utenti (email, password, livello, idcreatore, datamod) VALUES 
("utente@prova.it", MD5("1234"), 1, 0, Now()),
("giocatore@prova.it", MD5("1234"), 0, 0, Now());

/* creazione delle domande */
CREATE TABLE IF NOT EXISTS domande (
	iddomanda integer primary key auto_increment,
	domanda text NOT NULL DEFAULT "",
	corretta text NOT NULL DEFAULT "",
	errata text NOT NULL DEFAULT "",
	punti int NOT NULL DEFAULT 10,
	idcreatore int NOT NULL,
	datamod datetime NOT NULL DEFAULT Now()
);

DELETE FROM domande;
INSERT INTO domande (domanda, corretta, errata, idcreatore) VALUES
("il cavallo di napoleone", "bianco", "nero", 0),
("chi è meglio", "its prodigi", "altro its", 0),
("questa è una domanda", "corretto", "sbagliato", 0),
("in ITS Prodigi di impara cardiologia", "no", "si", 0);

/* gestione classifica */
CREATE TABLE IF NOT EXISTS classifica (
	idclassifica integer primary key auto_increment,
	punteggio int NOT NULL DEFAULT 0,
	idcreatore int NOT NULL,
	datamod datetime NOT NULL
);

DELETE FROM classifica;
INSERT INTO classifica (idcreatore, punteggio, datamod) VALUES
(0, 100, Now()),
(1, 50, Now());

CREATE TABLE IF NOT EXISTS visite (
	campagna varchar(255) PRIMARY KEY NOT NULL DEFAULT "",
	prima datetime NOT NULL DEFAULT Now(),
	visite int NOT NULL DEFAULT 0,
	ultima datetime NOT NULL
);