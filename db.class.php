<?php 
class DB{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'ecommerce';
    private $db;

    public function __construct($host = null, $username = null, $password = null, $database = null){
        if($host != null){
            $this->host = $host;
            $this->username = $username;
            $this->password = $password;
            $this->database = $database;
        }
        try {
            $this->db = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database, $this->username, $this->password, array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
            ));
        }catch(PDOException $e){
            die('<h1>Impossible de se conecter a la BD</h1>');
        }
    }

    public function query($sql, $data = array()){
        $requete = $this->db->prepare($sql);
        $requete->execute($data);
        return $requete->fetchAll(PDO::FETCH_OBJ);
    }

}
