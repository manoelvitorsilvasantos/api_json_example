<?php

	require_once __DIR__.'./config.php';

	class API{
		
		function getSelectTable(){
			$matricula = $_GET['matricula'];
			$db = new Connect;
			$users = array();
			$data = $db->prepare("
				SELECT * FROM aluno WHERE matricula = $matricula"
			);
			$data ->execute();
			while($saida = $data->fetch(PDO::FETCH_ASSOC))
			{
				$users[$saida['id']] = array(
					'id'=>$saida['id'],
					'cpf'=>$saida['cpf'],
					'dtNascimento'=>$saida['dtNascimento'],
					'estadoCivil'=>$saida['estadoCivil'],
					'matricula' =>$saida['matricula'],
					'nome'=>$saida['nome'],
					'sexo'=>$saida['sexo']
				);
			}
			return json_encode($users);	
		}
	}
	$api = new API;
	header('Content-Type:application/json');
	echo $api->getSelectTable();
?>