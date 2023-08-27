USE `epiz_34305586_solveit` ;

select * from Utente;


INSERT INTO `Settore` (`nomeSettore`) VALUES
('officina'),
('ufficio tecnico'),
('ufficio amministrazione');

INSERT INTO `Utente` ( `email`, `nome`, `username`, `idSettore`, `bio`) VALUES
('admin@blogtw.com', 'Admin Nimda', 'admin',1, 'Ingenere informatico senior'),
('sangio@blogtw.com', 'Gino Pino', 'sangio',2, 'Ingegnere informatico junior'),
('leo@blogtw.com', 'Cippa Lippa', 'leo',2, 'Full-stack developer'),
('tizz@blogtw.com', 'Chico Loco', 'tiz',3, 'Front-end soldier');

INSERT INTO `Credenziali` ( `password`, `idUtente`) VALUES
('admin', '1'),
('sangio', '2'),
('leo', '3');

INSERT INTO `Amicizia` (`idSeguace`, `idSeguito`, `timestamp`) VALUES
(1, 2, '2023-07-01 21:19:03'),
(2, 1, '2023-07-03 13:40:53');



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

INSERT INTO `Notifica` (`idNotificatore`, `idNotificato`, `idPost`, `tipo`, `letta`, `timestamp`) VALUES
(2, 1, 1, 0, 0, '2023-07-01 21:19:03'),
(3, 1, 1, 1, 0, '2023-07-01 21:19:03'),
(2, 1, 1, 2, 0, '2023-07-01 21:19:03'),
(3, 1, 1, 3, 0, '2023-07-01 21:19:03'),
(2, 1, 1, 4, 0, '2023-07-01 21:19:03');

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
select * from Notifica;
select * from Amicizia;


SELECT idNotifica as notificationId, idNotificatore as notifacatorId, letta as isRead, tipo as type, idPost as postId, timestamp
        FROM Notifica
        where idNotificato = 1 and letta = 0;

SELECT p.idPost as postId, u.idUtente as authorId, u.username as authorName, p.titolo as title, p.testo as text, s.nomeSettore as sector, p.timestamp as timestamp
        FROM Post as p, Settore as s, Pubblicazione as pub, Utente as u
        where p.idPost = 1
        and p.idPost = pub.idPost and p.idSettore = s.idSettore and pub.idUtente = u.idUtente and pub.collaboratore = 0;
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
