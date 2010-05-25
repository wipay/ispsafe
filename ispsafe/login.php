<?php

	if($_POST){
		
		include_once("includes/ConexaoMySQL.php");
		include_once("includes/funcoes.php");

		$usuario = valida($_POST['txtLogin'],0);
		$senha = valida($_POST['txtSenha'],1);	
		$ip = $_SERVER['REMOTE_ADDR'];
		$conn = new ConexaoMySQL();
	
		$sql = "SELECT * FROM tbl_usuario WHERE login = '".$usuario."'";
		$resultado = $conn->sql($sql);
		$dados = mysql_fetch_array($resultado);
			if(md5($dados['senha']) == $senha && $dados['status']=='ATIVO') {
				session_start();
				$_SESSION['usuario_id'] = intval($dados['id']);
				$_SESSION['usuario'] = $usuario;
				$_SESSION['senha'] = $senha;
				$_SESSION['nivel'] = intval($dados['nivel']);
				$redirect = "<meta http-equiv=\"refresh\" content=\"0;URL=interno.php\" />";
			} else {
				if($dados['status']=='REMOVIDO') { 
					$redirect = "<meta http-equiv=\"refresh\" content=\"0;URL=inicial.php?msg=9\" />"; 
				} else {
					$redirect = "<meta http-equiv=\"refresh\" content=\"0;URL=inicial.php?msg=1\" />";
				}
			}
	}

echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>ISP-Safe v<?php include('VERSION'); ?> - >Autenticação de Usuários</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<style type="text/css">
			<!--
			@import url("css/estilo.css");
			-->
		</style>
	<?php echo $redirect; ?>
	</head>
	<body>
	&nbsp;
	</body>
</html>