<?php
class DB{
private $host;
private $db;
private $user;
private $password;
private $charset;

    public function __construct(){
    
        $this->host = 'localhost';
        $this->db = 'finalp';
        $this->user = 'root';
        $this->password = '';
        $this->charset  = 'utf8mb4';

       /* $this->host = 'localhost';
        $this->db = 'u721481282_pruebarecupera';
        $this->user = 'u721481282_recuperar';
        $this->password = '123456aA';
        $this->charset  = 'utf8mb4';
        */
    }
    function connect(){
        try{
            
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $pdo = new PDO($connection, $this->user, $this->password, $options);

            
            return $pdo;

        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
        }
    }
}
?>