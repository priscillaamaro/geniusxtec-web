<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Genius X Tec - Login</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="main" class="container"> 	
	<form name="loginform" id="loginform" action="autenticar.php" method="post"> 
		<img src="logo.jpg" width="100%"/>
		<label for="usuario">Usuário:</label> 
		<input type="text" name="usuario" id="usuario" class="input" placeholder="Usuário" value="" size="20" />
		<label for="senha">Senha:</label>
		<input type="password" name="senha" id="senha" class="input" placeholder="Senha" value="" size="20" /> 
		<input type="submit" class="botao" value="Entrar"/>
	</form> 
</div>
</body>
</html>
