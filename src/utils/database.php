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

    // idPost --> idPost, autore, testo, settore, timestamp
    public function getPostById($idPost){
        $stmt = $this->db->prepare("SELECT p.idPost, a.nome as autore, post.testo, s.nomeSettore as settore, p.timestamp
        FROM post as p, settore as s, pubblicazione as pub, utente as u
        where p.idPost = ? 
        and p.idPost = pub.idPost and p.idSettore = s.idSettore and pub.idUtente = u.idUtente");
        $stmt->bind_param('i',$idPost);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // idPost --> idTag, tag
    public function getTagByPost($idPost){
        $stmt = $this->db->prepare("SELECT t.idTag, nome as tag
        FROM tag as t, etichettamento as e
        where e.idPost = ? and e.idTag = t.idTag");

        $stmt->bind_param('i',$idPost);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    // idPost --> idAllegato, allegato[bytes], tipo
    public function getAttachmentByPost($idPost){
        $stmt = $this->db->prepare("SELECT a.idAllegato, data as allegato, tipo
        FROM allegato as a
        where a.idPost = ?");

        $stmt->bind_param('i',$idPost);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // idPost --> idUtente, username
    public function getContributorsByPost($idPost){
        $stmt = $this->db->prepare("SELECT u.idUtente, username
        FROM utente as u, pubblicazione as p
        where p.idPost = ? and p.idUtente = u.idUtente");

        $stmt->bind_param('i',$idPost);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    ///USER-RELATED QUERIES -----------------------------------------

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

    // // Post <- idUtenti[], collaboratori[] : bool[idUtenti.size], testo, idSettore, 
    // public function insertArticle($titoloarticolo, $testoarticolo, $anteprimaarticolo, $dataarticolo, $imgarticolo, $autore){
    //     $query = "INSERT INTO articolo (titoloarticolo, testoarticolo, anteprimaarticolo, dataarticolo, imgarticolo, autore) VALUES (?, ?, ?, ?, ?, ?)";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->bind_param('sssssi',$titoloarticolo, $testoarticolo, $anteprimaarticolo, $dataarticolo, $imgarticolo, $autore);
    //     $stmt->execute();
        
    //     return $stmt->insert_id;
    // }

    // public function updateArticleOfAuthor($idarticolo, $titoloarticolo, $testoarticolo, $anteprimaarticolo, $imgarticolo, $autore){
    //     $query = "UPDATE articolo SET titoloarticolo = ?, testoarticolo = ?, anteprimaarticolo = ?, imgarticolo = ? WHERE idarticolo = ? AND autore = ?";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->bind_param('ssssii',$titoloarticolo, $testoarticolo, $anteprimaarticolo, $imgarticolo, $idarticolo, $autore);
        
    //     return $stmt->execute();
    // }

    // public function deleteArticleOfAuthor($idarticolo, $autore){
    //     $query = "DELETE FROM articolo WHERE idarticolo = ? AND autore = ?";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->bind_param('ii',$idarticolo, $autore);
    //     $stmt->execute();
    //     var_dump($stmt->error);
    //     return true;
    // }

    // public function insertCategoryOfArticle($articolo, $categoria){
    //     $query = "INSERT INTO articolo_ha_categoria (articolo, categoria) VALUES (?, ?)";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->bind_param('ii',$articolo, $categoria);
    //     return $stmt->execute();
    // }

    // public function deleteCategoryOfArticle($articolo, $categoria){
    //     $query = "DELETE FROM articolo_ha_categoria WHERE articolo = ? AND categoria = ?";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->bind_param('ii',$articolo, $categoria);
    //     return $stmt->execute();
    // }

    // public function deleteCategoriesOfArticle($articolo){
    //     $query = "DELETE FROM articolo_ha_categoria WHERE articolo = ?";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->bind_param('i',$articolo);
    //     return $stmt->execute();
    // }

    // public function getAuthors(){
    //     $query = "SELECT username, nome, GROUP_CONCAT(DISTINCT nomecategoria) as argomenti FROM categoria, articolo, autore, articolo_ha_categoria WHERE idarticolo=articolo AND categoria=idcategoria AND autore=idautore AND attivo=1 GROUP BY username, nome";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     return $result->fetch_all(MYSQLI_ASSOC);
    // }

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

}
?>