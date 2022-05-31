<?php

namespace App\db;
use \PDO;
use PDOException;

class Database{

    /**
     * Host de conexão com o banco de dados
     * @var string
     */
    const HOST = '127.0.0.1';

    /**
     * Nome do banco de dados
     * @var string
     */
    const NAME = 'vagas';

    /**
     * Usuário do Banco
     * @var string
     */
    const USER = 'root';

    /**
     * Senha do banco de dados
     * @var string
     */
    const PASS = '101010';

    /**
     * Nome da tabela
     * @var string
     */
    private $table;

    /**
     * Instancia do bd
     * @var PDO
     */
    private $connection;

    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }

    private function setConnection()
    {
        try {
            
            $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::USER,self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            
            die('ERROR: '.$e->getMessage());//nunca deixar isso em prod
        }
    }
}