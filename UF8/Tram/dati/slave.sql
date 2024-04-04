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
