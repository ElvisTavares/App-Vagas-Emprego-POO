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
    const PASS = '';

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

    public function execute($query, $params = [])
    {
        try {
            //code...
            $statement = $this->connection->prepare($query);
            $statement->execute($params);

            return $statement;

        } catch (PDOExeception $e) {
            die('ERROR: '.$e->getMessage());
        }
    }

    public function insert($values)
    {
        //dados da query
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');
        // echo "<pre>"; print_r($binds); echo "</pre>"; exit;

        //monta a query
        $query = 'INSERT INTO ' .$this->table. ' ('.implode(',', $fields).') VALUES ('.implode(',',$binds).')';

        $this->execute($query, array_values($values));

        return $this->connection->lastInsertId();
        // echo $query;
        // exit();
    }

    public function select($where = null, $order = null, $limit = null, $fields = '*')
    {
        //dados da query
        $where = strlen($where) ? 'WHERE ' .$where : '';
        $order = strlen($order) ? 'ORDER BY '. $order : '';
        $limit = strlen($limit) ? 'LIMIT '. $limit : '';

        //monta a query

        $query = 'SELECT '.$fields. ' FROM '.$this->table. ' ' .$where. ' ' .$order.' ' .$limit;

        return $this->execute($query);
    }

    public function update($where, $values)
    {
        $fields = array_keys($values);
        $query = 'UPDATE '.$this->table. ' SET '.implode('=?,',$fields).'=? WHERE '.$where;
        $this->execute($query, array_values($values));
    }

    public function delete($where)
    {
        $query = 'DELETE FROM '.$this->table.' WHERE '. $where;
        $this->execute($query);
        return true;
    }
}