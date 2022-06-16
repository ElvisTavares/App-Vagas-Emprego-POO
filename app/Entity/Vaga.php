<?php

namespace App\Entity;
use \App\db\Database;
use \PDO;

class Vaga {
    /**
     * indentificador unico
     * @var integer
     */
    public $id;
/**
 * Titulo da vaga
 * @var string
 */
    public $titulo;

    /**
     * Descrição da vaga
     * @var string
     */
    public $descricao;

    /**
     * Define se a vaga esta ativa
     * @var string(s/n)
     */
    public $ativo;

    /**
     * data de criação
     * @var string
     */
    public $data;

    /**
     * metdodo responsavel por cadastar uma vaga no banco
     * @return boolean
     */
    public function cadastrar()
    {
        
        //definir a data
        $this->data = date('Y-m-d H-i-s');
        //inserir a vaga no banco
        $obDatabase = new Database('vagas');
        $this->id = $obDatabase->insert([
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'ativo' => $this->ativo,
            'data' => $this->data
        ]);
        
        return true;

        //retornar sucesso
    }

    public static function getVagas($where = null, $order = null, $limit= null)
    {
        return (new Database('vagas'))->select($where, $order, $limit)
                                        ->fetchAll(PDO::FETCH_CLASS, self::class)
        ;
    }
}