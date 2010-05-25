<?php
	include_once("includes/funcoes.php");
	include_once("includes/ConexaoMySQL.php");

	$conn = new ConexaoMySQL();
	verifica();

	if($_GET['id']) {
		$sql = "SELECT * FROM tbl_banda WHERE band_id = ".intval($_GET['id']);
		$query = $conn->sql($sql);
		$banda = mysql_fetch_array($query);
	}
	if($_POST){
		$plano = $_POST['txtPlano'];
		$configuracao = $_POST['txtConfig'];
		$observacoes = $_POST['txtObservacoes'];

		if($_POST['hidAcao'] == 'SALVA'){
			$sql = "INSERT INTO tbl_banda(band_id, band_plano, band_configuracao , band_observacoes) VALUES(0,'".$plano."', '".$configuracao."', '".$observacoes."')";
		} elseif($_POST['hidAcao'] == 'ATUALIZA'){
			$sql = "UPDATE tbl_banda SET band_plano = '".$plano."', band_configuracao  = '".$configuracao."', band_observacoes = '".$observacoes."' WHERE band_id = ".intval($_POST['hidBanda']);
		} else {
			$sql = "REPAIR TABLE tbl_banda";
		}
		$saida = $conn->sql($sql);
	}
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
			<form action="../executar.php?mod=adm_banda" method="post" name="frmBanda" target="_self" id="frmBanda">
            <input name="hidBanda" type="hidden" value="<?php echo $banda['band_id']; ?>" />
            <fieldset>
            	<legend>Configurações de Planos de Controle de Banda</legend>
                <div class="CampoForm"><label>Plano:</label><input name="txtPlano" type="text" id="txtPlano"  value="<?php echo $banda['band_plano']; ?>"/></div>
                <div class="CampoForm"><label>Configuração:</label><input name="txtConfig" type="text" id="txtConfig"  value="<?php echo $banda['band_configuracao']; ?>"/></div>
                <div class="CampoForm"><label>Observações:</label><input name="txtObservacoes" type="text" id="txtObservacoes"  value="<?php echo $banda['band_observacoes']; ?>"/></div>
            </fieldset>
            <div class="CampoForm"><input name="cmdSalvar" type="submit" value="<?php if($banda['band_id'] != '') { echo "Atualizar"; } else {echo "Salvar"; } ?>" /></div>
			<input name="hidAcao" type="hidden" value="<?php if($banda['band_id'] != '') { echo "ATUALIZA"; } else {echo "SALVA"; } ?>" />
            </form>
            <?php listaBanda(); ?>
  			<!-- TERMINAÇÃO DA PARTE EDITÁVEL DA PÁGINA -->
		</div>
	</body>
</html>
