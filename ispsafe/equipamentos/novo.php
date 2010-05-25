<?php
	include_once("includes/funcoes.php");
	include_once("includes/ConexaoMySQL.php");
	verifica();
	
	if($_POST){
		$conn = new ConexaoMySQL();

	    $mac = $_POST['txtMac'];
    	$usuario = $_POST['txtUsuario'];
    	$senha = $_POST['txtSenha'];
    	$wpa = $_POST['txtWpa'];
    	$portaHttp = $_POST['txtPortaHttp'];
    	$portaSsh = $_POST['txtPortaSsh'];
    	$situacao = $_POST['cmbSituacao'];
    	$status = $_POST['cmbStatus'];
    	$observacoes = $_POST['txtObservacoes']; 
		
		
		$sql_procura = "SELECT * FROM tbl_equipamento WHERE eqpto_mac = '".$mac."'";
		$query_procura = $conn->sql($sql_procura);
		
		$encontrou = mysql_num_rows($query_procura);
		
		if($encontrou < 1){
			$sql = "INSERT INTO tbl_equipamento(eqpto_id, eqpto_mac, eqpto_usuario, eqpto_senha, eqpto_wpa, eqpto_http, eqpto_ssh, eqpto_situacao, eqpto_status, eqpto_observacoes) VALUES(0, '".$mac."', '".$usuario."', '".$senha."', '".$wpa."', ".$portaHttp.", ".$portaSsh.", '".$situacao."', '".$status."', '".$observacoes."')";
			$salva = $conn->sql($sql);
			if($salva == 1) {
				$msgCod = 4;
			} else {
				$msgCod = 5;
			}
		} else {
			$msgCod = 11;
		}		
	}	

?><?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
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
			<form action="../executar.php?mod=eqpto_novo" method="POST" name="frmEqptoNovo" target="_self" id="frmEqptoNovo">
            <fieldset>
            	<legend>Controle de Equipamentos de Clientes</legend>
                <div class="CampoForm"><label>MAC:</label><input name="txtMac" type="text" id="txtMac" onKeyDown="Mascara(this,mac);" maxlength="17"/></div>
                <div class="CampoForm"><label>Usuário:</label><input name="txtUsuario" type="text" id="txtUsuario" value="admin"/></div>
                <div class="CampoForm"><label>Senha:</label><input name="txtSenha" type="text" id="txtSenha" value="<?php echo gerarEqpto(); ?>" readonly="readonly"/></div>
                <div class="CampoForm"><label>WPA:</label><input name="txtWpa" type="text" id="txtWpa" value="<?php echo gerarWPA(); ?>" readonly="readonly"/></div>
                <div class="CampoForm"><label>Porta HTTP:</label><input name="txtPortaHttp" type="text" id="txtPortaHttp" value="80" onKeyDown="Mascara(this,Integer);"/></div>
				<div class="CampoForm"><label>Porta SSH:</label><input name="txtPortaSsh" type="text" id="txtPortaSsh" value="22" onKeyDown="Mascara(this,Integer);"/></div>
                <div class="CampoForm"><label>Situação:</label><select name="cmbSituacao" id="cmbSituacao">
                  <option value="COMODATO">COMODATO</option>
                  <option value="PROVEDOR">PROVEDOR</option>
                  <option value="CLIENTE">CLIENTE</option>
                </select></div>
                <div class="CampoForm"><label>Status:</label><select name="cmbStatus" id="cmbStatus">
                  <option value="USO">EM USO</option>
                  <option value="ESTOQUE" SELECTED>ESTOQUE</option>
                  <option value="MANUTENCAO">MANUTENÇÃO</option>
                  <option value="INUTILIZADO">INUTILIZADO</option>
                </select></div>
                <div class="CampoForm"><label>Observações:</label><textarea name="txtObservacoes" cols="" rows="" id="txtObservacoes"></textarea></div>
            <div class="CampoForm"><input name="cmdSalvar" type="submit" value="Salvar" style="z-index:999"/></div>
            </fieldset>
            </form>
            <?php echo msgErro($msgCod); ?>
  			<!-- TERMINAÇÃO DA PARTE EDITÁVEL DA PÁGINA -->
		</div>
	</body>
</html>
