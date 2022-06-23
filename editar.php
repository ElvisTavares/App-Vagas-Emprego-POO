<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Vaga;

define('TITLE', 'Editar Vaga');
//validaçao do id(listar ao editar)
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location index.php?status=error');
    exit;
}

$obVaga = Vaga::getVaga($_GET['id']);

//validaçao da vaga
if(! $obVaga instanceof Vaga){
    header('location: index.php?status=error');
   
    exit;
}



if (isset($_POST['titulo'], $_POST['descricao'], $_POST['ativo'])) {
  
    $obVaga->titulo = $_POST['titulo'];
    $obVaga->descricao = $_POST['descricao'];
    $obVaga->ativo = $_POST['ativo'];
    $obVaga->atualizar();

    header('location: index.php?status=success');
    // echo "<pre>";
    // print_r($obVaga);
    // echo "</pre>";
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';