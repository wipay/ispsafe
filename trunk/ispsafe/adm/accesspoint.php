<?php
	include_once("includes/funcoes.php");
	include_once("includes/ConexaoMySQL.php");

	$conn = new ConexaoMySQL();
	verifica();

	if($_GET['id']) {
		$sql = "SELECT * FROM tbl_ap WHERE id = ".intval($_GET['id']);
		$query = $conn->sql($sql);
		$accesspoint = mysql_fetch_array($query);
	}
	if($_POST){
		$pop = $_POST['cmbPop'];
		$estacao = exibeEstacao(intval($pop));
		$accesspoint = $_POST['txtAccessPoint'];
		$ip = $_POST['txtIp'];
		$snmp = $_POST['txtSnmp'];

		if($_POST['hidAcao'] == 'SALVA'){
			$sql = "INSERT INTO tbl_ap(id, accesspoint, estacao , pop, ip, snmp ) VALUES(0,'".$accesspoint."', '".$estacao."', '".$pop."', '".$ip."','".$snmp."')";
		} elseif($_POST['hidAcao'] == 'ATUALIZA'){
			$sql = "UPDATE tbl_ap SET accesspoint = '".$accesspoint."', estacao  = '".$estacao."', pop = '".$pop."',  ip = '".$ip."', snmp = '".$snmp."' WHERE id = ".intval($_POST['hidAccessPoint']);
		} else {
			$sql = "REPAIR TABLE tbl_ap";
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
			<form action="../executar.php?mod=adm_accesspoint" method="post" name="frmBanda" target="_self" id="frmBanda">
            <input name="hidAccessPoint" type="hidden" value="<?php echo $accesspoint['id']; ?>" />
            <fieldset>
            	<legend>Configurações de Access-Points</legend>
                <div class="CampoForm"><label>Ponto de Presença:</label>
				<?php
					$dados = array("tabela" => "tbl_pop", "value" => "id", "view" => "pop");
					echo preencheCombo("cmbPop", "cmbPop", $dados, $accesspoint['pop']);
				?>
                </div>
                <div class="CampoForm"><label>SSID:</label><input name="txtAccessPoint" type="text" id="txtAccessPoint"  value="<?php echo $accesspoint['accesspoint']; ?>"/></div>
                <div class="CampoForm"><label>IP:</label><input name="txtIp" type="text" id="txtIp"  value="<?php echo $accesspoint['ip']; ?>"/></div>
                <div class="CampoForm"><label>SNMP:</label><input name="txtSnmp" type="text" id="txtSnmp"  value="<?php echo $accesspoint['snmp']; ?>"/></div>
            </fieldset>
            <div class="CampoForm"><input name="cmdSalvar" type="submit" value="<?php if($accesspoint['id'] != '') { echo "Atualizar"; } else {echo "Salvar"; } ?>" /></div>
			<input name="hidAcao" type="hidden" value="<?php if($accesspoint['id'] != '') { echo "ATUALIZA"; } else {echo "SALVA"; } ?>" />
            </form>
            <?php listaAccessPoints(); ?>
  			<!-- TERMINAÇÃO DA PARTE EDITÁVEL DA PÁGINA -->
		</div>
	</body>
</html>
