create table autisti (
    idautista integer primary key autoincrement,
    nome text,
    cognome text
);

delete from autisti;
insert into autisti (nome, cognome) values
("Filippo", "Rossi"),
("Tommaso", "Verdi");

create table strade (
    idstrada integer primary key autoincrement,
    strada text
);

delete from strade;
insert into strade (strada) values
("tagenziale nord"),
("via garibaldi"),
("via mazzini"),
("corso italia"),
("via verdi"),
("via rossi"),
("tangenziale sud"),
("tangenziale ovest"),
("via napoleone"),
("via libertà"),
("viale dei caduti"),
("corso indipendenza"),
("tangenziale est");

create table pensiline (
    idpensilina integer primary key autoincrement,
    idstrada integer,
    pensilina text
);

delete from pensiline;
insert into pensiline (idstrada) values
(1),
(2),
(3),
(4), (4), (4), (4), (4),
(5),
(6),
(7),
(8), (8),
(9), (9),
(10), (10),
(11), (11),
(12), (12),
(13), (13);
update pensiline set pensilina = (select strada from strade where strade.idstrada=pensiline.idstrada) || pensiline.idpensilina;

create table linee (
    idlinea integer primary key autoincrement,
    linea text
);

delete from linee;
insert into linee(linea) values
("rossa"),
("verde"),
("gialla"),
("viola");

create table fermate (
    idfermata integer primary key autoincrement,
    idlinea integer,
    idpensilina integer,
    orario time
);

delete from fermate;
insert into fermate (idlinea, idpensilina, orario) values
(1, 1, "09:00"),
(1, 22, "11:00"),
(1, 2, "13:00"),
(1, 11, "15:00"),
(1, 13, "16:00"),
(1, 12, "18:00"),
(2, 2, "09:00"),
(2, 20, "11:00"),
(2, 21, "13:00"),
(2, 10, "15:00"),
(2, 15, "16:00"),
(2, 14, "18:00"),
(3, 3, "09:00"),
(3, 18, "11:00"),
(3, 19, "13:00"),
(3, 9, "15:00"),
(3, 17, "16:00"),
(3, 18, "18:00"),
(4, 4, "09:00"),
(4, 5, "11:00"),
(4, 6, "13:00"),
(4, 7, "16:00"),
(4, 8, "18:00")
;


create table mezzi (
    idmezzo integer primary key autoincrement,
    mezzo text,
    targa text,
    modello text,
    passeggeri int
);

delete from mezzi;
insert into mezzi (mezzo, targa, modello, passeggeri) values 
("pullman", "AA123AA", "Mercedes", 80),
("Ducato", "AA124AA", "Fiat", 8);

create table guasti (
    idguasto integer primary key autoincrement,
    idmezzo integer,
    tipo text,
    quando datetime,
    risolto boolean
);

delete from guasti;
insert into guasti (idmezzo, tipo, quando, risolto) values
(2, "motore", "2024-01-01", false),
(2, "motore", "2024-01-01", true);

create table turni (
    idturno integer primary key autoincrement,
    idautista integer,
    idlinea integer,
    idmezzo integer,
    giorno date
);

delete from turni;
insert into turni (idautista, idlinea, idmezzo, giorno) values
(1, 1, 1, "2024-03-21"),
(2, 3, 2, "2024-03-21");