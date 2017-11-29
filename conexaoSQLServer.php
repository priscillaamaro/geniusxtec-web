<?php
$nomeServidor = 'localhost';
$informacoesConexao = array("Database"=>"geniusxtec", "UID"=>"admin", "PWD"=>"admin", "CharacterSet"=>"UTF-8");
$sistemaConexao = sqlsrv_connect($nomeServidor, $informacoesConexao);

if($sistemaConexao === false){
	echo "A Conexão falhou!";
	die(print_r(sqlsrv_errors(), true));
}
?>