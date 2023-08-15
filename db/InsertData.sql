USE `epiz_34305586_solveit` ;

select * from utente;

INSERT INTO `utente` ( `email`, `nome`, `username`) VALUES
('admin@blogtw.com', 'Admin Nimda', 'admin'),
('sangio@blogtw.com', 'Gino Pino', 'sangio'),
('leo@blogtw.com', 'Cippa Lippa', 'leo'),
('tizz@blogtw.com', 'Chico Loco', 'tiz');

INSERT INTO `credenziali` ( `password`, `idUtente`) VALUES
('admin', '1');


INSERT INTO `amicizia` (`idSeguace`, `idSeguito`, `timestamp`) VALUES
(1, 2, '2023-07-01 21:19:03'),
(2, 1, '2023-07-03 13:40:53');


INSERT INTO `settore` (`nomeSettore`) VALUES
('officina');


INSERT INTO `post` (`idsettore`, `testo`, `timestamp`) VALUES
(1, 'okokso','2023-07-01 21:19:03');


INSERT INTO `pubblicazione` (`idutente`, `idpost`) VALUES
(2, 1);


INSERT INTO `tag` (`nome`) VALUES
('GUI'),
('Back-end');


INSERT INTO `etichettamento` (`idpost`, `idtag`) VALUES
(1, 2);



select * from post;
select * from pubblicazione;
select * from allegato;
select * from post;
select * from settore;
select * from utente;
select * from credenziali;
select * from tag;
select * from etichettamento;

# idPost --> idPost, autore, testo, settore, timestamp
SELECT p.idPost, u.nome as autore, p.testo, s.nomeSettore as settore, p.timestamp
        FROM post as p, settore as s, pubblicazione as pub, utente as u
        where p.idPost = 1
        and p.idPost = pub.idPost and p.idSettore = s.idSettore and pub.idUtente = u.idUtente;

# idPost --> idTag, tag
SELECT t.idTag, nome as tag
		FROM tag as t, etichettamento as e
		where e.idPost = 1 and e.idTag = t.idTag;
        
# idPost --> idAllegato, allegato[bytes], tipo
SELECT a.idAllegato, data as allegato, tipo
        FROM allegato as a
        where a.idPost = 1;
        
# idPost --> idUtente, username
SELECT u.idUtente, username
        FROM utente as u, pubblicazione as p
        where p.idPost = 1 and p.idUtente = u.idUtente;
        
# prefix ---> idUtente, nome, cognome, username, idSettore
SELECT * 
		FROM utente
		where username LIKE 'l%';
        
# idUtente --> idUtente, nome, cognome, username, idSettore, inizioAmicizia
SELECT u.idUtente, u.nome, u.cognome, u.username, u.idSettore, a.timestamp as inizioAmicizia
        FROM utente as u, amicizia as a
        where u.idUtente = a.idSeguito and a.idSeguace = 1;

#idUtente --> idPubblicazione, idPost, comeCollaboratore
SELECT idPubblicazione, idPost, collaboratore as comeCollaboratore
        FROM pubblicazione as p
        where idUtente = 2;
        
#username,password --> idUtente, username, nome
SELECT u.idUtente, username, nome 
        FROM utente as u, credenziali as c 
        WHERE u.idUtente = c.idUtente and u.username = "sangio" and c.password = "admin";
