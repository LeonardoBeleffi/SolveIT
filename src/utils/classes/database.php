<?php
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }        
    }

    ///POST-RELATED QUERIES -----------------------------------------
    // n --> idPost
    public function getRandomIdPostsByLimit($n){
        $stmt = $this->db->prepare("SELECT idPost FROM post ORDER BY RAND() LIMIT ?");
        $stmt->bind_param('i',$n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // idPost --> postId, authorId, authorName, title, text, sector, timestamp
    public function getPostById($idPost){
        $stmt = $this->db->prepare("SELECT p.idPost as postId, u.idUtente as authorId, u.username as authorName, p.titolo as title, p.testo as text, s.nomeSettore as sector, p.timestamp as timestamp
        FROM post as p, settore as s, pubblicazione as pub, utente as u
        where p.idPost = ? 
        and p.idPost = pub.idPost and p.idSettore = s.idSettore and pub.idUtente = u.idUtente");
        $stmt->bind_param('i',$idPost);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // idComment --> postId
    public function getPostByCommentId($commentId){
        $stmt = $this->db->prepare("SELECT p.idPost as postId
        FROM post as p, commento as c
        where c.idCommento = ? and p.idPost = c.idPost");
        $stmt->bind_param('i',$commentId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // idPost --> tagId, tagName
    public function getTagByPost($idPost){
        $stmt = $this->db->prepare("SELECT t.idTag as tagId, nome as tagName
        FROM tag as t, etichettamento as e
        where e.idPost = ? and e.idTag = t.idTag");

        $stmt->bind_param('i',$idPost);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    // idPost --> idAttachment, name, data[bytes], type
    public function getAttachmentByPost($idPost){
        $stmt = $this->db->prepare("SELECT a.idAllegato as idAttachment, nome as name, data, tipo as type
        FROM allegato as a
        where a.idPost = ?");

        $stmt->bind_param('i',$idPost);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // idPost --> contributorId, contributorName
    public function getContributorsByPost($idPost){
        $stmt = $this->db->prepare("SELECT u.idUtente as contributorId, username as contributorName
        FROM utente as u, pubblicazione as p
        where p.idPost = ? and p.idUtente = u.idUtente");

        $stmt->bind_param('i',$idPost);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // idPost --> commentId, text, commentAuthorId, commentAuthorName, parentId, timestamp
    public function getCommentsByPost($idPost){
        $stmt = $this->db->prepare("SELECT c.idCommento as commentId, c.testo as text, u.idUtente as commentAuthorId, u.username as commentAuthorName, c.idCommentoPadre as parentId, c.timestamp as timestamp
        FROM utente as u, post as p, commento as c
        where p.idPost = ? and c.idUtente = u.idUtente and c.idPost = p.idPost");

        $stmt->bind_param('i',$idPost);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // idPost --> userId, username 
    public function getLikesByPost($idPost){
        $stmt = $this->db->prepare("SELECT u.idUtente as userId, username
        FROM utente as u, post as p, MiPiace as m
        where p.idPost = ? and m.idPost = p.idPost and m.idUtente = u.idUtente");

        $stmt->bind_param('i',$idPost);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    ///USER-RELATED QUERIES -----------------------------------------

    public function checkLogin($username, $password){
        $query = "SELECT u.idUtente as idUtente, username, nome 
        FROM utente as u, credenziali as c 
        WHERE u.idUtente = c.idUtente and u.username = ? and c.password = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss',$username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }    

    // prefix --> idUtente, nome, cognome, username, idSettore
    public function getUsersByPrefix($prefix){
        $stmt = $this->db->prepare("SELECT idUtente, nome, cognome, username, idSettore
        FROM utente
        where username LIKE '?%'");
        
        $stmt->bind_param('s',$prefix);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // idUtente --> idUtente, nome, cognome, username, idSettore, inizioAmicizia
    public function getFollowersByUser($idUtente){
        $stmt = $this->db->prepare("SELECT u.idUtente, u.nome, u.cognome, u.username, u.idSettore, a.timestamp as inizioAmicizia
        FROM utente as u, amicizia as a
        where u.idUtente = a.idSeguace and a.idSeguito = ?");
        
        $stmt->bind_param('i',$idUtente);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    // idUtente --> idUtente, nome, cognome, username, idSettore, inizioAmicizia
    public function getFollowingsByUser($idUtente){
        $stmt = $this->db->prepare("SELECT u.idUtente, u.nome, u.cognome, u.username, u.idSettore, a.timestamp as inizioAmicizia
        FROM utente as u, amicizia as a
        where u.idUtente = a.idSeguito and a.idSeguace = ?");
        
        $stmt->bind_param('i',$idUtente);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // idPost --> idUtente, nome, cognome, username, idSettore
    public function getUserById($idUtente){
        $stmt = $this->db->prepare("SELECT idUtente, nome, cognome, username, idSettore
        FROM utente
        where idUtente = ?");
        
        $stmt->bind_param('i',$idUtente);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // username --> idUtente, nome, cognome, username, idSettore
    public function getUserByUsername($username){
        $stmt = $this->db->prepare("SELECT idUtente, nome, cognome, username, idSettore
        FROM utente
        where username = ?");
        
        $stmt->bind_param('i',$username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // username --> idUtente, nome, cognome, email, username, dataNascita, telefono, idSettore, idImpostazione
    public function getUserInfoByUsername($username){
        $stmt = $this->db->prepare("SELECT *
        FROM utente
        where username = ?");
        
        $stmt->bind_param('s',$username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // idUtente --> idPubblicazione, idPost, comeCollaboratore
    public function getPublicationsByUser($idUtente) {
        $stmt = $this->db->prepare("SELECT idPubblicazione, idPost, collaboratore as comeCollaboratore
        FROM pubblicazione as p
        where idUtente = ?");
        
        $stmt->bind_param('i',$idUtente);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    ///TAG-RELATED QUERIES -----------------------------------------
    // nomeTag --> idEtichettamento, idPost, idTag
    public function getEtichettamentoByTagName($nomeTag) {
        $stmt = $this->db->prepare("SELECT *
        FROM etichettamento as e, tag as t
        where t.nome = ? and e.idTag = t.idTag");
        
        $stmt->bind_param('s',$nomeTag);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }


    /// INSERTSSS-----------
    // Nome, cognome, email, dataNascita, telefono, username -> idUtente
    public function insertUtente($nome, $cognome, $email, $dataNascita, $telefono, $username){
        try {
            $query = "INSERT INTO utente (nome, cognome, email, dataNascita, telefono, username) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ssssss',$nome, $cognome, $email, $dataNascita, $telefono, $username);
            $stmt->execute();
            
            return $stmt->insert_id;
        } catch(Exception $e) {
            return false;
        }
    }

    // idUtente, password -> idCredenziali
    public function insertCredenziali($idUtente, $password){
        try {
            $query = "INSERT INTO credenziali (idUtente, password) VALUES (?, ?)";
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
            $query = "INSERT INTO commento (idpost, idutente, testo, timestamp, idCommentoPadre) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('iissi',$idPost, $userId, $text, $timestamp, $parentCommentId);
            $stmt->execute();
            return $stmt->insert_id;
        // } catch(Exception $e) {
        //     return false;
        // }
    }

    // file, tipo, idPost -> idAllegato
    public function insertAllegato($file, $nome, $tipo, $idPost){
        // try {
            $this->db->query("SET GLOBAL max_allowed_packet=1073741824;");
            $query = "INSERT INTO allegato (data, nome, tipo, idPost) VALUES (?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $null = NULL;
            $stmt->bind_param('bssi', $null, $nome, $tipo, $idPost);
            // send file piece by piece
            $fp = fopen($file, "r");
            while (!feof($fp)) {
                $data = fread($fp, 50);
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
            $query = "INSERT INTO pubblicazione (idUtente, idPost, collaboratore) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('iii',$idUtente, $idPost, $collaboratore);
            $stmt->execute();
            return $stmt->insert_id;
        } catch(Exception $e) {
            return false;
        }
    }

    // titolo, testo, timestamp -> idPost
    public function insertPost($titolo, $testo, $timestamp, $idSettore){
        try {
            $this->db->query("SET GLOBAL max_allowed_packet=1073741824;");
            $query = "INSERT INTO post (titolo, testo, timestamp, idSettore) VALUES (?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sssi',$titolo, $testo, $timestamp, $idSettore);
            $stmt->execute();
            return $stmt->insert_id;
        } catch(Exception $e) {
            return false;
        }
    }


    // titolo, testo, timestamp, idSettore, allegati, tipoAllegati, collaboratori, autore -> idPost
    public function uploadPost($titolo, $testo, $timestamp, $idSettore, $allegati, $nomeAllegati, $tipoAllegati, $collaboratori, $autore) {
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
        // insert attachments 
        for($i = 0; $i < count($allegati); $i++) {
            $this->insertAllegato($allegati[$i], $nomeAllegati[$i], $tipoAllegati[$i], $idPost);
        }
        return $idPost;
    }


    
    /// DELETEs-----------
    // public function deleteCategoriesOfArticle($articolo){
    //     $query = "DELETE FROM articolo_ha_categoria WHERE articolo = ?";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->bind_param('i',$articolo);
    //     return $stmt->execute();
    // }

}
?>