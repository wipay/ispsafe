<?php
	include_once("includes/funcoes.php");
	include_once("includes/ConexaoMySQL.php");
	verifica();
	
	if($_POST){
		$conn = new ConexaoMySQL();
		$sql = "SELECT eqpto_mac FROM tbl_equipamento WHERE eqpto_id = ".intval($_POST['hidEqptoId']);
		$query = $conn->sql($sql);
		$dados = mysql_fetch_array($query);
		$equipamento = getEqpto($dados['eqpto_mac']);


	    $mac = $_POST['txtMac'];
    	$usuario = $_POST['txtUsuario'];
    	$senha = $_POST['txtSenha'];
    	$wpa = $_POST['txtWpa'];
    	$portaHttp = $_POST['txtPortaHttp'];
    	$portaSsh = $_POST['txtPortaSsh'];
    	$situacao = $_POST['cmbSituacao'];
    	$status = $_POST['cmbStatus'];
    	$observacoes = $_POST['txtObservacoes']; 
		
		$sql_update = "UPDATE tbl_equipamento SET 
				eqpto_mac = '".$mac."', 
				eqpto_usuario = '".$usuario."',
				eqpto_senha = '".$senha."',
				eqpto_wpa = '".$wpa."',
				eqpto_ssh = ".$portaSsh.",
				eqpto_http = ".$portaHttp.",
				eqpto_situacao = '".$situacao."', 
				eqpto_status = '".$status."',
				eqpto_observacoes = '".$observacoes."'
				WHERE eqpto_id = ".intval($_POST['hidEqptoId']);
		$query = $conn->sql($sql_update);
		
		if($query == 1){
			$msgCod = 6;
		} else {
			$msgCod = 7;
		}
		$equipamento = getEqpto($mac);	
		
			
	 
	} else {
		if($_GET['id']){
			$conn = new ConexaoMySQL();
			$sql = "SELECT eqpto_mac FROM tbl_equipamento WHERE eqpto_id = ".intval($_GET['id']);
			$query = $conn->sql($sql);
			$dados = mysql_fetch_array($query);
			$equipamento = getEqpto($dados['eqpto_mac']);
		}
	}

echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>ISP-Save v<?php include('VERSION');?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="../css/estilo02.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="../js/funcoes.js"></script>

     <?php verificaNivel(); ?>

	</head>
	<body>
		<div class="espacoInterno">
		  <!-- ALTERAR A PARTIR DESTE PONTO -->
			<form action="../executar.php?mod=eqpto_editar" method="POST" name="frmEqptoEditar" target="_self" id="frmEqptoEditar">
            <input type="hidden" name="hidEqptoId" value="<?php echo $equipamento['eqpto_id']; ?>"/>
            <fieldset>
            	<legend>Controle de Equipamentos de Clientes</legend>
                <div class="CampoForm"><label>MAC:</label><input name="txtMac" type="text" id="txtMac" onKeyDown="Mascara(this,mac);" maxlength="17" value="<?php echo $equipamento['eqpto_mac']; ?>"/></div>
                <div class="CampoForm"><label>Usu�rio:</label><input name="txtUsuario" type="text" id="txtUsuario" value="admin"/></div>
                <div class="CampoForm"><label>Senha:</label><input name="txtSenha" type="text" id="txtSenha" value="<?php echo $equipamento['eqpto_senha']; ?>" readonly="readonly"/></div>
                <div class="CampoForm"><label>WPA:</label><input name="txtWpa" type="text" id="txtWpa" value="<?php echo $equipamento['eqpto_wpa']; ?>" readonly="readonly"/></div>
                <div class="CampoForm"><label>Porta HTTP:</label><input name="txtPortaHttp" type="text" id="txtPortaHttp" value="<?php echo $equipamento['eqpto_http']; ?>" onKeyDown="Mascara(this,Integer);"/></div>
				<div class="CampoForm"><label>Porta SSH:</label><input name="txtPortaSsh" type="text" id="txtPortaSsh" value="<?php echo $equipamento['eqpto_ssh']; ?>" onKeyDown="Mascara(this,Integer);"/></div>
                <div class="CampoForm"><label>Situa��o:</label><select name="cmbSituacao" id="cmbSituacao">
                  <option value="COMODATO" <?php if($equipamento['eqpto_situacao']=='COMODATO') { echo "selected";} ?>>COMODATO</option>
                  <option value="PROVEDOR" <?php if($equipamento['eqpto_situacao']=='PROVEDOR') { echo "selected";} ?>>PROVEDOR</option>
                  <option value="CLIENTE" <?php if($equipamento['eqpto_situacao']=='CLIENTE') { echo "selected";} ?>>CLIENTE</option>
                </select></div>
                <div class="CampoForm"><label>Status:</label><select name="cmbStatus" id="cmbStatus">
                  <option value="USO" <?php if($equipamento['eqpto_status']=='USO') { echo "selected";} ?>>EM USO</option>
                  <option value="ESTOQUE"  <?php if($equipamento['eqpto_status']=='ESTOQUE') { echo "selected";} ?>>ESTOQUE</option>
                  <option value="MANUTENCAO" <?php if($equipamento['eqpto_status']=='MANUTENCAO') { echo "selected";} ?>>MANUTEN��O</option>
                  <option value="INUTILIZADO" <?php if($equipamento['eqpto_status']=='INUTILIZADO') { echo "selected";} ?>>INUTILIZADO</option>
                </select></div>
                <div class="CampoForm"><label>Observa��es:</label><textarea name="txtObservacoes" cols="" rows="" id="txtObservacoes"><?php echo $equipamento['eqpto_observacoes'];  ?></textarea></div>
            <div class="CampoForm"><input name="cmdSalvar" type="submit" value="Salvar" style="z-index:999"/></div>
            </fieldset>
            </form>
            <?php echo msgErro($msgCod); ?>
  			<!-- TERMINA��O DA PARTE EDIT�VEL DA P�GINA -->
		</div>
	</body>
</html>
