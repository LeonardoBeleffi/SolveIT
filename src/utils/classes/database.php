<?php
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
        $this->db->set_charset("utf8");
    }

    ///POST-RELATED QUERIES -----------------------------------------
    // n --> idPost
    public function getRandomIdPostsByLimit($n){
        $stmt = $this->db->prepare("SELECT idPost FROM Post ORDER BY RAND() LIMIT ?");
        $stmt->bind_param('i',$n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // idPost --> postId, authorId, authorName, title, text, sector, timestamp
    public function getPostById($idPost){
        $stmt = $this->db->prepare("SELECT p.idPost as postId, u.idUtente as authorId, u.username as authorName, p.titolo as title, p.testo as text, s.nomeSettore as sector, p.timestamp as timestamp
        FROM Post as p, Settore as s, Pubblicazione as pub, Utente as u
        where p.idPost = ? 
        and p.idPost = pub.idPost and p.idSettore = s.idSettore and pub.idUtente = u.idUtente and pub.collaboratore = 0");
        $stmt->bind_param('i',$idPost);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // prefix --> postId
    public function getPostByTitlePrefix($prefix){
        $stmt = $this->db->prepare("SELECT idPost as postId
        FROM Post
        where titolo LIKE '?%'");
        
        $stmt->bind_param('s',$prefix);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // idPost --> tagId, tagName
    public function getTagByPost($idPost){
        $stmt = $this->db->prepare("SELECT t.idTag as tagId, nome as tagName
        FROM Tag as t, Etichettamento as e
        where e.idPost = ? and e.idTag = t.idTag");

        $stmt->bind_param('i',$idPost);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    // idPost --> idAttachment, name, data[bytes], type
    public function getAttachmentByPost($idPost){
        $stmt = $this->db->prepare("SELECT a.idAllegato as idAttachment, nome as name, data, tipo as type
        FROM Allegato as a
        where a.idPost = ?");

        $stmt->bind_param('i',$idPost);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // idPost --> contributorId, contributorName
    public function getContributorsByPost($idPost){
        $stmt = $this->db->prepare("SELECT u.idUtente as contributorId, username as contributorName
        FROM Utente as u, Pubblicazione as p
        where p.idPost = ? and p.idUtente = u.idUtente and p.collaboratore = 1");

        $stmt->bind_param('i',$idPost);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // idPost --> commentId, text, commentAuthorId, commentAuthorName, parentId, timestamp
    public function getCommentsByPost($idPost){
        $stmt = $this->db->prepare("SELECT c.idCommento as commentId, c.testo as text, u.idUtente as commentAuthorId, u.username as commentAuthorName, c.idCommentoPadre as parentId, c.timestamp as timestamp
        FROM Utente as u, Post as p, Commento as c
        where p.idPost = ? and c.idUtente = u.idUtente and c.idPost = p.idPost");

        $stmt->bind_param('i',$idPost);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // idPost --> userId, username 
    public function getLikesByPost($idPost){
        $stmt = $this->db->prepare("SELECT u.idUtente as userId, username
        FROM Utente as u, Post as p, MiPiace as m
        where p.idPost = ? and m.idPost = p.idPost and m.idUtente = u.idUtente");

        $stmt->bind_param('i',$idPost);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    ///USER-RELATED QUERIES -----------------------------------------

    // username, password --> userId, username, name, sectorId
    public function checkLogin($username, $password){
        $query = "SELECT u.idUtente as userId, username, nome as name, u.idSettore as sectorId 
        FROM Utente as u, Credenziali as c 
        WHERE u.idUtente = c.idUtente and u.username = ? and c.password = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss',$username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }    

    // idPost --> userId, name, surname, username, sectorId
    public function getUserById($idUtente){
        $stmt = $this->db->prepare("SELECT u.idUtente as userId, u.nome as name, u.cognome as surname, u.username, u.idSettore as sectorId
        FROM Utente as u
        where u.idUtente = ?");
        
        $stmt->bind_param('i',$idUtente);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // username --> userId, name, surname, email, username, birthDate, phoneNumber, sectorId, settingsId
    public function getUserInfoByUsername($username){
        $stmt = $this->db->prepare("SELECT idUtente as userId, nome as name, cognome as surname, email, username, dataNascita as birthDate, telefono as phoneNumber, idSettore as sectorId, idImpostazione as settingsId
        FROM Utente
        where username = ?");
        
        $stmt->bind_param('s',$username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // prefix --> userId, username
    public function getUsersByPrefix($prefix){
        $stmt = $this->db->prepare("SELECT idUtente as userId, username
        FROM Utente
        where username LIKE ?");
        
        $prefix = $prefix."%";
        $stmt->bind_param('s',$prefix);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // userId --> followerId, friendshipStart
    public function getFollowersByUser($idUtente){
        $stmt = $this->db->prepare("SELECT u.idUtente as followerId, a.timestamp as friendshipStart
        FROM Utente as u, Amicizia as a
        where u.idUtente = a.idSeguace and a.idSeguito = ?");
        
        $stmt->bind_param('i',$idUtente);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    // userId --> followingId, friendshipStart
    public function getFollowingsByUser($idUtente){
        $stmt = $this->db->prepare("SELECT u.idUtente as followingId, a.timestamp as friendshipStart
        FROM Utente as u, Amicizia as a
        where u.idUtente = a.idSeguito and a.idSeguace = ?");
        
        $stmt->bind_param('i',$idUtente);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // username --> userId
    public function getUserByUsername($username){
        $stmt = $this->db->prepare("SELECT idUtente as userId
        FROM Utente
        where username = ?");
        
        $stmt->bind_param('i',$username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // idUtente --> publicationId, postId, isCollaborator
    public function getPublicationsByUser($idUtente) {
        $stmt = $this->db->prepare("SELECT idPubblicazione as publicationId, idPost as postId, collaboratore as isCollaborator
        FROM Pubblicazione as p
        where idUtente = ?");
        
        $stmt->bind_param('i',$idUtente);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // commentId --> userId, username
    public function getUserByComment($commentId){
        $stmt = $this->db->prepare("SELECT u.idUtente as userId, u.username as username
        FROM Commento as c, Utente as u
        where c.idUtente = u.idUtente and c.idCommento = ?");
        
        $stmt->bind_param('i',$commentId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // postId --> userId, username
    public function getAuthorByPost($postId){
        $stmt = $this->db->prepare("SELECT u.idUtente as userId, u.username as username
        FROM Pubblicazione as p, Utente as u
        where p.idUtente = u.idUtente and p.idPost = ? and p.collaboratore = 0");
        
        $stmt->bind_param('i',$postId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }


    ///TAG-RELATED QUERIES -----------------------------------------

    // nomeTag --> idEtichettamento, idPost, idTag
    public function getEtichettamentoByTagName($nomeTag) {
        $stmt = $this->db->prepare("SELECT *
        FROM Etichettamento as e, Tag as t
        where t.nome = ? and e.idTag = t.idTag");
        
        $stmt->bind_param('s',$nomeTag);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // prefix --> tagId, name
    public function getTagsByPrefix($prefix){
        $stmt = $this->db->prepare("SELECT idTag as tagId, nome as name
        FROM Tag
        where nome LIKE ?");
        
        $prefix = $prefix."%";
        $stmt->bind_param('s',$prefix);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    // tagName --> tagId, name
    public function getTagByName($tagName){
        $stmt = $this->db->prepare("SELECT idTag as tagId, nome as name
        FROM Tag
        where nome = ?");
        
        $stmt->bind_param('s',$tagName);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    ///SECTOR-RELATED QUERIES -----------------------------------------

    // prefix --> sectorId, sectorName
    public function getSectorsByPrefix($prefix){
        $stmt = $this->db->prepare("SELECT idSettore as sectorId, nomeSettore as sectorName
        FROM Settore
        where nomeSettore LIKE ?");
        
        $prefix = $prefix."%";
        $stmt->bind_param('s',$prefix);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // prefix --> sectorId, sectorName
    public function getSectorByName($name){
        $stmt = $this->db->prepare("SELECT idSettore as sectorId, nomeSettore as sectorName
        FROM Settore
        where nomeSettore = ?");
        
        $stmt->bind_param('s',$name);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }


    ///NOTIFICATION-RELATED QUERIES -----------------------------------------
    // userId --> notificationId, notificatorId, isRead, type, postId, timestamp
    public function getNotifications($userId){
        $stmt = $this->db->prepare("SELECT idNotifica as notificationId, idNotificatore as notificatorId, letta as isRead, tipo as type, idPost as postId, timestamp
        FROM Notifica
        where idNotificato = ? and letta = 0");
        
        $stmt->bind_param('i',$userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // userId --> notificationId, notificatorId, isRead, type, postId, timestamp
    public function getAllNotifications($userId){
        $stmt = $this->db->prepare("SELECT idNotifica as notificationId, idNotificatore as notificatorId, letta as isRead, tipo as type, idPost as postId, timestamp
        FROM Notifica as n
        where idNotificato = ?");
        
        $stmt->bind_param('i',$userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /// INSERTSSS-----------
    // Nome, cognome, email, dataNascita, telefono, username -> idUtente
    public function insertUtente($nome, $cognome, $email, $dataNascita, $telefono, $username, $idSettore){
        try {
            $query = "INSERT INTO Utente (nome, cognome, email, dataNascita, telefono, username, idSettore) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ssssssi',$nome, $cognome, $email, $dataNascita, $telefono, $username, $idSettore);
            $stmt->execute();
            
            return $stmt->insert_id;
        } catch(Exception $e) {
            return false;
        }
    }

    // idUtente, password -> idCredenziali
    public function insertCredenziali($idUtente, $password){
        try {
            $query = "INSERT INTO Credenziali (idUtente, password) VALUES (?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('is',$idUtente, $password);
            $stmt->execute();
            return $stmt->insert_id;
        } catch(Exception $e) {
            return false;
        }
    }

    // idPost, userId, text, timestamp, parentCommentId -> commentId
    public function insertCommento($idPost, $userId, $text, $timestamp, $parentCommentId){
        // try {
            $query = "INSERT INTO Commento (idPost, idUtente, testo, timestamp, idCommentoPadre) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('iissi',$idPost, $userId, $text, $timestamp, $parentCommentId);
            $stmt->execute();
            return $stmt->insert_id;
        // } catch(Exception $e) {
        //     return false;
        // }
    }

    // idPost, userId -> 
    public function insertLike($idPost, $userId){
        try {
            $query = "INSERT INTO MiPiace (idPost, idUtente) VALUES (?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ii',$idPost, $userId);
            $stmt->execute();
            return $stmt->insert_id;
        } catch(Exception $e) {
            return false;
        }
    }

    // file, tipo, idPost -> idAllegato
    public function insertAllegato($file, $nome, $tipo, $idPost){
        // try {
            $this->db->query("SET GLOBAL max_allowed_packet=1073741824;");
            $query = "INSERT INTO Allegato (data, nome, tipo, idPost) VALUES (?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $null = NULL;
            $stmt->bind_param('bssi', $null, $nome, $tipo, $idPost);
            // send file piece by piece
            $fp = fopen($file, "r");
            while (!feof($fp)) {
                $data = fread($fp, 1000000);
                $stmt->send_long_data(0, $data);   
            }
            fclose($fp);
            $stmt->execute();
            return $stmt->insert_id;
        // } catch(Exception $e) {
        //     return false;
        // }
    }

    // idUtente, idPost, collaboratore -> idPubblicazione
    public function insertPubblicazione($idUtente, $idPost, $collaboratore){
        try {
            $this->db->query("SET GLOBAL max_allowed_packet=1073741824;");
            $query = "INSERT INTO Pubblicazione (idUtente, idPost, collaboratore) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('iii',$idUtente, $idPost, $collaboratore);
            $stmt->execute();
            return $stmt->insert_id;
        } catch(Exception $e) {
            return false;
        }
    }

    // nomeTag -> idTag
    public function insertTag($nomeTag){
        try {
            $query = "INSERT INTO Tag (nome) VALUES (?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('s',$nomeTag);
            $stmt->execute();
            return $stmt->insert_id;
        } catch(Exception $e) {
            return false;
        }
    }

    // idPost, idTag -> idEtichettamento
    public function insertEtichettamento($idPost, $idTag){
        // try {
            $query = "INSERT INTO Etichettamento (idPost, idTag) VALUES (?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ii',$idPost, $idTag);
            $stmt->execute();
            return $stmt->insert_id;
        // } catch(Exception $e) {
        //     return false;
        // }
    }


    // notifierId, notifiedId, postId type, read, timestamp -> notificationId
    public function insertNotifica($notifierId, $notifiedId, $postId, $type, $read, $timestamp){
        // try {
            $this->db->query("SET GLOBAL max_allowed_packet=1073741824;");
            $query = "INSERT INTO Notifica (idNotificatore, idNotificato, idPost, tipo, letta, timestamp) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('iiiiis',$notifierId, $notifiedId, $postId, $type, $read, $timestamp);
            $stmt->execute();
            return $stmt->insert_id;
        // } catch(Exception $e) {
        //     return false;
        // }
    }


    // titolo, testo, timestamp -> idPost
    public function insertPost($titolo, $testo, $timestamp, $idSettore){
        try {
            $this->db->query("SET GLOBAL max_allowed_packet=1073741824;");
            $query = "INSERT INTO Post (titolo, testo, timestamp, idSettore) VALUES (?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sssi',$titolo, $testo, $timestamp, $idSettore);
            $stmt->execute();
            return $stmt->insert_id;
        } catch(Exception $e) {
            return false;
        }
    }


    // titolo, testo, timestamp, idSettore, allegati, tipoAllegati, collaboratori, autore -> idPost
    public function uploadPost($titolo, $testo, $timestamp, $idSettore, $allegati, $nomeAllegati, $tipoAllegati, $collaboratori, $tags, $autore) {
        // insert post
        $idPost = $this->insertPost($titolo, $testo, $timestamp, $idSettore);
        if($idPost === false) {
            return false;
        }
        // insert autor
        $idPubblicazione = $this->insertPubblicazione($autore, $idPost, 0);
        // insert collabs
        foreach ($collaboratori as $collaboratore) {
            $this->insertPubblicazione($collaboratore, $idPost, 1);
        }
        // insert tags
        foreach ($tags as $tag) {
            $this->insertTag($collaboratore, $idPost, 1);
            $tagId = $this->getTagByName($tag)[0]["tagId"];
            $this->insertEtichettamento($idPost, $tagId);
        }
        // insert attachments 
        for($i = 0; $i < count($allegati); $i++) {
            $this->insertAllegato($allegati[$i], $nomeAllegati[$i], $tipoAllegati[$i], $idPost);
        }
        return $idPost;
    }


    /// UPDATEs-----------

    // notificationId, isRead -> \
    public function updateNotifica($notificationId, $isRead) {
        $query = "UPDATE Notifica SET letta = ?
                WHERE idNotifica = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$isRead, $notificationId);
        
        return $stmt->execute();
    }    
    
    /// DELETEs-----------
    // public function deleteCategoriesOfArticle($articolo){
    //     $query = "DELETE FROM articolo_ha_categoria WHERE articolo = ?";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->bind_param('i',$articolo);
    //     return $stmt->execute();
    // }

    // idPost, userId -> \
    public function deleteLike($idPost, $userId){
        $query = "DELETE FROM MiPiace 
                    WHERE idUtente = ? and idPost = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$userId, $idPost);
        return $stmt->execute();
    }

}
?>
