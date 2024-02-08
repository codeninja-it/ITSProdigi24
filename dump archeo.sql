drop table if exists gruppi;

create table gruppi (
    idGruppo integer primary key autoincrement,
    gruppo text
);

insert into gruppi (gruppo)
select Gruppo
from punti
group by Gruppo
order by Gruppo;

drop table if exists tipi;

create table tipi (
    idTipo integer primary key autoincrement,
    tipo text,
    idGruppo int
);

insert into tipi (tipo, idGruppo)
select punti.Tipo, gruppi.idGruppo
from punti
left join gruppi on punti.Gruppo=gruppi.gruppo
group by punti.Tipo
order by punti.Tipo;

alter table reperti 
    add column idTipo int;
    
update reperti set idTipo = 10 where idReperto=1;

select reperti.*, (select tipi.idtipo
        from punti
        left join tipi on punti.Tipo=tipi.tipo
        where punti.descrizione = reperti.descrizione
        limit 1) as idtipo
from reperti;

update reperti set idTipo=(
    select tipi.idtipo
    from punti
    left join tipi on punti.Tipo=tipi.tipo
    where punti.descrizione = reperti.descrizione
    limit 1
);


select origini.origine, count(reperti.idReperto) as quanti 
from origini
left join reperti on origini.idOrigine=reperti.idOrigine
left join tipi on reperti.idTipo=tipi.idTipo
left join gruppi on tipi.idGruppo=gruppi.idGruppo
where gruppo = "difesa"
group by origini.idorigine
order by count(reperti.idReperto) desc;


create table regioni (
    idRegione integer primary key autoincrement,
    regione text
);

insert into regioni (regione)
select Regione
from punti
group by regione
order by regione;

create table province (
    idProvincia integer primary key autoincrement,
    provincia text,
    idRegione int
);

insert into province (provincia, idRegione)
    select provincia, (select idregione from regioni where regioni.regione=punti.Regione)
    from punti
    group by provincia
    order by provincia;
    
create table comuni (
    idComune integer primary key autoincrement,
    comune text,
    idProvincia int
);

insert into comuni (comune, idProvincia)
    select citta, (select idprovincia from province where province.provincia=punti.provincia)
    from punti
    group by citta
    order by citta;
    
drop table if exists reperti;

create table reperti (
    idReperto integer primary key autoincrement,
    descrizione text,
    idOrigine int,
    idSito int,
    idTipo int,
    idComune int,
    x real,
    y real
);

insert into reperti (descrizione, idOrigine, idSito, idTipo, idComune, x, y)
select punti.Descrizione, origini.idOrigine, siti.idSito, tipi.idTipo, comuni.idComune, replace(punti.x, ",", "."), replace(punti.y, ",", ".")
from punti
left join comuni on punti.Citta=comuni.comune
left join siti on punti.sito=siti.sito
left join origini on punti.Origine=origini.origine
left join tipi on punti.Tipo=tipi.tipo;

select count(reperti.idreperto) as quanti, provincia, min(x) as l, max(x) as r, min(y) as b, max(y) as t
from reperti
left join comuni on reperti.idcomune=comuni.idcomune
left join province on comuni.idprovincia=province.idprovincia
group by province.idProvincia
order by count(reperti.idreperto) desc