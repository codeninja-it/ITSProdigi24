UPDATE utenti SET nome = 'Piergiorgio', amministratore = true, email = 'piero@gestionetram.it', pass = 3456 WHERE pass=3456 LIMIT 1;
UPDATE utenti SET nome = 'Piergiorgio', amministratore = true, email = 'piero@gestionetram.it', pass = 3456 WHERE idutente=2
UPDATE utenti SET nome = 'Piergiorgio', email = 'piero@gestionetram.it', pass = 3456, amministratore = false WHERE idutente=2
UPDATE utenti SET nome = 'Piergiorgio d'avola', email = 'piero@gestionetram.it', pass = 3456, amministratore = false WHERE idutente=2
UPDATE utenti SET nome = 'Piergiorgio d''avola', email = 'piero@gestionetram.it', pass = 3456, amministratore = false WHERE idutente=2
UPDATE utenti SET nome = 'Piergiorgio d&#039;avola', email = 'piero@gestionetram.it', pass = 3456, amministratore = false WHERE idutente=2
UPDATE utenti SET nome = 'Filippo', email = 'filippo@gestionetram.it', pass = 1234, amministratore = false WHERE idutente=1
UPDATE utenti SET nome = 'Filippo', amministratore = true, email = 'filippo@gestionetram.it', pass = 1234 WHERE idutente=1
UPDATE guasti SET tipo = 'motore', idmezzo = 2, quando = '2024-04-01', risolto = 'si' WHERE idguasto=1
UPDATE guasti SET tipo = 'motore', idmezzo = 2, quando = '2024-04-01' WHERE idguasto=1
UPDATE guasti SET tipo = 'motore', idmezzo = 2, quando = '2024-04-01', risolto = 'si' WHERE idguasto=1
UPDATE guasti SET tipo = 'motore', idmezzo = 2, quando = '2024-04-01' WHERE idguasto=1
UPDATE guasti SET tipo = 'motore', idmezzo = 2, quando = '2024-04-01' WHERE idguasto=1
UPDATE guasti SET tipo = 'motore', idmezzo = 2, quando = '2024-04-01' WHERE idguasto=1
UPDATE modelli SET modello = 'Fiat Ducato' WHERE idmodello=1
INSERT INTO modelli (Array) VALUES ('Iveco Daily');
INSERT INTO modelli (modello) VALUES ('Iveco Daily');
UPDATE turni SET giorno = '2024-04-21', idautista = 1, idlinea = 1, idmezzo = 1 WHERE idturno=1
INSERT INTO turni (giorno, idautista, idlinea, idmezzo) VALUES ('2024-04-05', 2, 3, 2);
UPDATE turni SET giorno = '2024-04-21', idautista = 1, idlinea = 1, idmezzo = 1 WHERE idturno=1
