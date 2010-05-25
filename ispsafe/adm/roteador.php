<?php
	include_once("includes/funcoes.php");
	include_once("includes/ConexaoMySQL.php");

	verifica();
	if($_GET['id']){
		$conn = new ConexaoMySQL();
		$sql1 = "SELECT * FROM  tbl_pop WHERE id = ".$_GET['id'];
		$query = $conn->sql($sql1);
		$pop = mysql_fetch_array($query);

		$sql2 = "SELECT * FROM nas WHERE nasname = '".$pop['ip']."'";
		$query = $conn->sql($sql2);
		$radius = mysql_fetch_array($query);
	}
	if($_POST){
		$conn = new ConexaoMySQL();

		$nasname = $_POST['txtNasName'];
		$shortname = $_POST['txtShortName'];
		$secret = $_POST['txtSecret'];
		$description = $_POST['txtDescription'];

		$pop = $shortname;
		$snmp = $_POST['txtSnmp'];
		$dominio = $_POST['txtDominio'];

		if($_POST['hidAcao'] == 'SALVA') {
			$sql_radius = "INSERT INTO nas(id, nasname, shortname, secret, description) VALUES(0, '".$nasname."','".$shortname."','".$secret."','".$description."')";
			$sql_pop = "INSERT INTO tbl_pop(id, dominio, pop, ip, snmp) VALUES(0, '".$dominio."', '".$shortname."', '".$nasname."', '".$snmp."')";
		} else {
			$sql_radius = "UPDATE nas SET nasname = '".$nasname."', shortname = '".$shortname."', secret='".$secret."', description='".$description."' WHERE id = ".$_POST['hidRadius'];
			$sql_pop = "UPDATE tbl_pop SET dominio='".$dominio."', pop='".$shortname."', ip='".$nasname."', snmp = '".$snmp."' WHERE id = ".$_POST['hidPop'];
		}
		$saida = $conn->sql($sql_radius);
		$saida .= $conn->sql($sql_pop);

	}

?><?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
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
			<form action="../executar.php?mod=adm_roteador" method="post" name="frmAdmRoteador" target="_self" id="frmAdmRoteador">
            <input name="hidRadius" type="hidden" value="<?php echo $radius['id']; ?>" />
            <input name="hidPop" type="hidden" value="<?php echo $pop['id']; ?>" />
            <fieldset>
            	<legend>Configurações de Conexão dos Roteadores ao Radius</legend>
                <div class="CampoForm"><label>IP ou Hostname:</label><input name="txtNasName" type="text" id="txtNasName" value="<?php echo $radius['nasname']; ?>"/></div>
                <div class="CampoForm"><label>Identificador:</label><input name="txtShortName" type="text" id="txtShortName"  value="<?php echo $radius['shortname']; ?>"/></div>
                <div class="CampoForm"><label>Secret:</label><input name="txtSecret" type="text" id="txtSecret"  value="<?php echo $radius['secret']; ?>"/></div>
                <div class="CampoForm"><label>Descrição:</label><input name="txtDescription" type="text" id="txtDescription"  value="<?php echo $radius['description']; ?>"/></div>
            </fieldset>
            <fieldset>
            	<legend>Configurações de Perfil de Acesso</legend>
                <div class="CampoForm"><label>Domínio:</label><input name="txtDominio" type="text" id="txtDominio"  value="<?php echo $pop['dominio']; ?>"/></div>
                <div class="CampoForm"><label>SNMP:</label><input name="txtSnmp" type="text" id="txtSnmp"  value="<?php echo $pop['snmp']; ?>"/></div>
            </fieldset>
            <div class="CampoForm"><input name="cmdSalvar" type="submit" value="<?php if($radius['id'] != '') { echo "Atualizar"; } else {echo "Salvar"; } ?>" /></div>
			<input name="hidAcao" type="hidden" value="<?php if($radius['id'] != '') { echo "ATUALIZA"; } else {echo "SALVA"; } ?>" />
            </form>
            <?php listaPop(); ?>
  			<!-- TERMINAÇÃO DA PARTE EDITÁVEL DA PÁGINA -->
		</div>
	</body>
</html>
