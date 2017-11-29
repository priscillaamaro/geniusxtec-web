<?php
     session_start();
     include 'conexaoSQLServer.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Genius X Tec - Chamados</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="main" class="container"> 	
	<div id="divGeral" style="width:700px"> 
		<img src="logo.jpg" width="30%"/>
		<br/>
		<label>Chamados do cliente <?php echo $_SESSION['nome'] ?></label>
		<table style="width:100%; border: solid 1px">
		  <tr class="cabecalho">
			<th>Id</th>
			<th>Descrição</th> 
			<th>Data criação</th>
			<th>Status</th>
			<th>Cliente</th>
			<th>Prioridade</th>
			<th width="120px">Data fechamento</th>
		  </tr>
		<?php
			$usuario = $_SESSION['login'];
			$nome = $_SESSION['nome'];
			
			$parametros = array($usuario);						
			$consultaInformacoes = sqlsrv_query($sistemaConexao,
			"select c.ID_CHAMADO, c.DESCRICAO cdesc, c.DATA_CRIACAO, s.DESCRICAO sdesc,
					cli.NOME, p.DESCRICAO pdesc, c.DATA_FECHAMENTO
			from chamado c
				join cliente cli on cli.ID_CLIENTE=c.ID_CLIENTE
				join usuario usuarioCli on usuarioCli.LOGIN=cli.LOGIN
				join STATUS_CHAMADO s on c.ID_STATUS_CHAMADO=s.ID_STATUS_CHAMADO
				join PRIORIDADE_CHAMADO p on c.ID_PRIORIDADE_CHAMADO=p.ID_PRIORIDADE_CHAMADO
			where usuarioCli.LOGIN=?",
			$parametros);
			
			 if( $consultaInformacoes === false ){  
				 echo "Busca não executada.\n";  
				 die(print_r(sqlsrv_errors(), true));
				 
			} else {
				while( $linha = sqlsrv_fetch_array( $consultaInformacoes, SQLSRV_FETCH_ASSOC) ) {
					echo '<tr class="resultado">
							<th>'.$linha['ID_CHAMADO'].'</th>
							<th>'.$linha['cdesc'].'</th> 
							<th>'.date_format($linha['DATA_CRIACAO'], 'd/m/Y H:i:s').'</th>
							<th>'.$linha['sdesc'].'</th>
							<th>'.$linha['NOME'].'</th>
							<th>'.$linha['pdesc'].'</th>
							<th>';
							if($linha['DATA_FECHAMENTO'] === null )
								echo '-';
							else
								echo date_format($linha['DATA_FECHAMENTO'], 'd/m/Y H:i:s');
							echo '</th>
						 </tr>';
				}
			}
		?>
		</table>
	</div> 
</div>
</body>
</html>