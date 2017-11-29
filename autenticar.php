<?php
     session_start();
     include 'conexaoSQLServer.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Genius X Tec - Autenticação</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="main" class="container"> 	
	<div id="divGeral"> 
		<img src="logo.jpg" width="100%"/>
		<br/><br/>
		<?php
		$recebeEmail = $_POST['usuario'];
		$filtraEmail = filter_var($recebeEmail, FILTER_SANITIZE_SPECIAL_CHARS);
		$filtraEmail = filter_var($filtraEmail, FILTER_SANITIZE_MAGIC_QUOTES);
		$recebeSenha = $_POST['senha'];
		$filtraSenha = filter_var($recebeSenha, FILTER_SANITIZE_SPECIAL_CHARS);
		$filtraSenha = filter_var($filtraSenha, FILTER_SANITIZE_MAGIC_QUOTES);
		function criptoSenha($criptoSenha){
			 return md5($criptoSenha);
		}
		$criptoSenha = criptoSenha($filtraSenha);
		
		$parametros = array($filtraEmail);						
		$consultaInformacoes = sqlsrv_query($sistemaConexao,
		"SELECT login, CONVERT(VARCHAR(32), HashBytes('MD5', senha), 2), nome
			FROM usuario WHERE login = ? and id_tipo_usuario=1",
		$parametros);
		
		if( $consultaInformacoes === false ){  
			 echo "Busca não executada.\n";  
			 die(print_r(sqlsrv_errors(), true));
			 
		} else { 
			 $linha = sqlsrv_fetch_array( $consultaInformacoes);
			 
			 // Valida senha
			 if($linha[1] === strtoupper($criptoSenha)){
				//echo "Usuario: $linha[0] - Senha: $linha[1] - Nome: $linha[2].";
				$_SESSION['autenticado']=true;
				$_SESSION['login']=$linha[0];
				$_SESSION['nome']=$linha[2];
				header("Location: chamados.php");
			 }else{ // Senha inválida
				echo "<p><b>Usuário</b> e/ou <b>Senha</b> incorretos.</p><br/>
				<p><a href='javascript:history.back();'>Tentar novamente.</a></p>";
			 } 
		}
		?>
	</div> 
</div>
</body>
</html>











