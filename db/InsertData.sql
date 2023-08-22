USE `epiz_34305586_solveit` ;

select * from Utente;

INSERT INTO `Utente` ( `email`, `nome`, `username`) VALUES
('admin@blogtw.com', 'Admin Nimda', 'admin'),
('sangio@blogtw.com', 'Gino Pino', 'sangio'),
('leo@blogtw.com', 'Cippa Lippa', 'leo'),
('tizz@blogtw.com', 'Chico Loco', 'tiz');

INSERT INTO `Credenziali` ( `password`, `idUtente`) VALUES
('admin', '1'),
('sangio', '2'),
('leo', '3');


INSERT INTO `Amicizia` (`idSeguace`, `idSeguito`, `timestamp`) VALUES
(1, 2, '2023-07-01 21:19:03'),
(2, 1, '2023-07-03 13:40:53');


INSERT INTO `Settore` (`nomeSettore`) VALUES
('officina');


INSERT INTO `Post` (`idSettore`, `titolo`, `testo`, `timestamp`) VALUES
(1, 'Il mio Post su SolveIt!', 'Se vi capita questo allora fate quest\'altro e via track track tutto funziona!','2023-07-01 21:19:03');


INSERT INTO `Pubblicazione` (`idUtente`, `idPost`) VALUES
(2, 1);


INSERT INTO `Tag` (`nome`) VALUES
('GUI'),
('Back-end');


INSERT INTO `Etichettamento` (`idPost`, `idTag`) VALUES
(1, 2);

INSERT INTO `Commento` (`idPost`, `idUtente`, `testo`, `timestamp`) VALUES
(1, 1, 'bel Post, caspita un botto utile!', '2023-07-01 21:19:03'),
(1, 2, 'Lo sapevamo già', '2023-07-01 21:19:03');

INSERT INTO `MiPiace` (`idPost`, `idUtente`) VALUES
(1, 1),
(1, 2);

select * from Post;
select * from Pubblicazione;
select * from Allegato;
select * from Post;
select * from Settore;
select * from Utente;
select * from Credenziali;
select * from Tag;
select * from Etichettamento;
select * from Commento;
select * from MiPiace;

# idPost --> idPost, autore, testo, Settore, timestamp
SELECT p.idPost, u.nome as autore, p.testo, s.nomeSettore as Settore, p.timestamp
        FROM Post as p, Settore as s, Pubblicazione as pub, Utente as u
        where p.idPost = 1
        and p.idPost = pub.idPost and p.idSettore = s.idSettore and pub.idUtente = u.idUtente;

# idPost --> idTag, Tag
SELECT t.idTag, nome as Tag
		FROM Tag as t, Etichettamento as e
		where e.idPost = 1 and e.idTag = t.idTag;
        
# idPost --> idAllegato, Allegato[bytes], tipo
SELECT a.idAllegato, data as Allegato, tipo
        FROM Allegato as a
        where a.idPost = 1;
        
# idPost --> idUtente, username
SELECT u.idUtente, username
        FROM Utente as u, Pubblicazione as p
        where p.idPost = 1 and p.idUtente = u.idUtente;
        
# prefix ---> idUtente, nome, cognome, username, idSettore
SELECT * 
		FROM Utente
		where username LIKE 'l%';
        
# idUtente --> idUtente, nome, cognome, username, idSettore, inizioAmicizia
SELECT u.idUtente, u.nome, u.cognome, u.username, u.idSettore, a.timestamp as inizioAmicizia
        FROM Utente as u, Amicizia as a
        where u.idUtente = a.idSeguito and a.idSeguace = 1;

#idUtente --> idPubblicazione, idPost, comeCollaboratore
SELECT idPubblicazione, idPost, collaboratore as comeCollaboratore
        FROM Pubblicazione as p
        where idUtente = 2;
        
#username,password --> idUtente, username, nome
SELECT u.idUtente, username, nome 
        FROM Utente as u, Credenziali as c 
        WHERE u.idUtente = c.idUtente and u.username = "sangio" and c.password = "admin";
