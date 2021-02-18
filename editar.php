<?php

require __DIR__ .'/vendor/autoload.php';

define('TITLE', 'Editar vaga');

use \App\Entity\Vaga;
use \App\Session\Login;

// obriga o usuario a estar logado
Login::requireLogin();

// VALIDAÇÃO DO ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
	header('Location: index.php?status=error');
	exit;
}

//consulta vaga
$obVaga = Vaga::getVaga($_GET['id']);

// Validação da vaga
if(!$obVaga instanceof Vaga){
	header('Location: index.php?status=error');
	exit;
}

// validar se os dados chegaram corretamente /  VALIDAÇÃO DO POST
if(isset($_POST['titulo'],$_POST['descricao'],$_POST['ativo'])){

	$obVaga->titulo 	= $_POST['titulo'];
	$obVaga->descricao  = $_POST['descricao'];
	$obVaga->ativo 		= $_POST['ativo'];
	$obVaga->atualizar();

	header('location: index.php?status=success');
	exit;


}

include __DIR__ .'/includes/header.php';
include __DIR__ .'/includes/formulario.php';
include __DIR__ .'/includes/footer.php';
