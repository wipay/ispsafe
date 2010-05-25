<?php
	include_once("includes/funcoes.php");
	include_once("includes/ConexaoMySQL.php");

	$conn = new ConexaoMySQL();
	verifica();

	if($_GET['id']) {
		$sql = "SELECT * FROM tbl_usuario WHERE id = ".intval($_GET['id']);
		$query = $conn->sql($sql);
		$usuario = mysql_fetch_array($query);
	}
	if($_POST){

		$id = $_POST[hidUsuario];
		$login = $_POST[txtUsuario];
		$senha = $_POST[txtSenha];
		$nome = $_POST[txtNome];
		$nivel = $_POST[cmbNivel];
		$acesso = $_POST[txtIp];
		$grupo = $_POST[cmbGrupo];
		$status = $_POST[cmbStatus];


		if($_POST['hidAcao'] == 'SALVA'){
			$sql = "INSERT INTO tbl_usuario (id ,login ,senha ,nome ,nivel ,acesso ,grupo ,status) VALUES (0 , '".$login."', '".$senha."', '".nome."', '".nivel."', '".$acesso."', '".$grupo."', '".$status."')";
		} elseif($_POST['hidAcao'] == 'ATUALIZA'){
			$sql = "UPDATE tbl_usuario SET login = '".$login."', senha = '".$senha."', nome = '".$nome."', nivel = '".$nivel."', acesso = '".$acesso."', grupo = '".$grupo."', status = '".$status."' WHERE id = ".intval($id);
		} else {
			$sql = "REPAIR TABLE tbl_usuario";
		}
		$saida = $conn->sql($sql);
	}

	if($usuario['nivel']=='') {$usuario['nivel'] = 5;}
	if($usuario['grupo']=='') {$usuario['grupo'] = 'read';}
	if($usuario['status']=='') {$usuario['status'] = 'BLOQUEADO';}

echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>ISP-Save v<?php include('VERSION');?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="../css/estilo02.css" rel="stylesheet" type="text/css" />

     <?php verificaNivel(); ?>
</head>

	<body>
		<div class="espacoInterno">
		  <!-- ALTERAR A PARTIR DESTE PONTO -->
			<form action="../executar.php?mod=adm_usuario" method="post" name="frmUsuario" target="_self" id="frmUsuario">
            <input name="hidUsuario" type="hidden" value="<?php echo $usuario['id']; ?>" />
            <fieldset>
            	<legend>Configurações de Usuários</legend>
                <div class="CampoForm"><label>Usuário:</label><input name="txtUsuario" type="text" id="txtUsuario"  value="<?php echo $usuario['login']; ?>"/></div>
                <div class="CampoForm"><label>Senha:</label><input name="txtSenha" type="password" id="txtSenha"  value="<?php echo $usuario['senha']; ?>"/></div>
                <div class="CampoForm"><label>Nome:</label><input name="txtNome" type="text" id="txtNome"  value="<?php echo $usuario['nome']; ?>"/></div>
                <div class="CampoForm"><label>Nível:</label><select name="cmbNivel" id="cmbNivel">
                  <option value="2"<?php if($usuario['nivel'] == 2){ echo " SELECTED "; } else { echo ""; } ?>>ADMINISTRADOR</option>
                  <option value="3"<?php if($usuario['nivel'] == 3){ echo " SELECTED "; } else { echo ""; } ?>>T&Eacute;CNICO</option>
                  <option value="4"<?php if($usuario['nivel'] == 4){ echo " SELECTED "; } else { echo ""; } ?>>CADASTRAMENTO</option>
                  <option value="5"<?php if($usuario['nivel'] == 5){ echo " SELECTED "; } else { echo ""; } ?>>LEITOR</option>
            </select></div>
                <div class="CampoForm"><label>Acesso:</label><input name="txtIp" type="text" id="txtIp"  value="<?php echo $usuario['acesso']; ?>"/></div>
                <div class="CampoForm"><label>Grupo:</label><select name="cmbGrupo" id="cmbGrupo">
                  <option value="full"<?php if($usuario['grupo'] == 'full'){ echo " SELECTED "; } else { echo ""; } ?>>ADMINISTRADOR</option>
                  <option value="read"<?php if($usuario['grupo'] == 'read'){ echo " SELECTED "; } else { echo ""; } ?>>VISUALIZADOR</option>
                </select></div>
                <div class="CampoForm"><label>Status:</label><select name="cmbStatus" id="cmbStatus">
                  <option value="ATIVO" <?php if($usuario['status'] == 'ATIVO'){ echo " SELECTED "; } else { echo ""; } ?>>ATIVO</option>
                  <option value="REMOVIDO" <?php if($usuario['status'] == 'REMOVIDO'){ echo " SELECTED "; } else { echo ""; } ?>>BLOQUEADO</option>
                </select></div>
            </fieldset>
            <div class="CampoForm"><input name="cmdSalvar" type="submit" value="<?php if($usuario['id'] != '') { echo "Atualizar"; } else {echo "Salvar"; } ?>" /></div>
			<input name="hidAcao" type="hidden" value="<?php if($usuario['id'] != '') { echo "ATUALIZA"; } else {echo "SALVA"; } ?>" />
            </form>
            <?php listaUsuarios(); ?>
  			<!-- TERMINAÇÃO DA PARTE EDITÁVEL DA PÁGINA -->
		</div>
	</body>
</html>
