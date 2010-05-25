<?php
	include_once("includes/funcoes.php");
	include_once("includes/ConexaoMySQL.php");

	verifica();
	
	$usuario = getAtivacao($_GET['id']);
	

?><?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>ISP-Save v<?php include('VERSION');?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="../css/estilo02.css" rel="stylesheet" type="text/css" />
     <?php verificaNivel(); ?>
     <script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
     <link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
    </head>

	<body>
		<div class="espacoInterno">
		  <!-- ALTERAR A PARTIR DESTE PONTO -->
			<form action="../executar.php?mod=cli_ativacao" method="post" name="frmClienteAtivar" target="_self" id="frmClienteAtivar">
            <input name="hidCliente" type="hidden" value="<?php echo $usuario['id']; ?>" />
            <fieldset>
            	<legend>Ativações de Clientes Pendentes</legend>
	            <div class="CampoForm">Usuário:<input name="txtUsuario" type="text" id="txtUsuario" value="<?php echo $usuario['usuario']; ?>" disabled="disabled"/></div>
	            <div class="CampoForm">Nome:<input name="txtNome" type="text" id="txtNome" value="<?php echo $usuario['nome']; ?>" disabled="disabled"/></div>
                 <div class="CampoForm"><label>Roteador:</label>
				<?php
					$dados = array("tabela" => "tbl_pop", "value" => "id", "view" => "pop", "linhasBranco" => "0");
					echo preencheCombo("cmbPop", "cmbPop", $dados, $usuario['pop']);
					?>
                </div>
                <div class="CampoForm"><label>Access-Point:</label>
                <?php
					$dados = array("tabela" => "tbl_ap", "value" => "id", "view" => "accesspoint", "linhasBranco" => "0");
					echo preencheCombo("cmbAccessPoint", "cmbAccessPoint", $dados, $usuario['ap']);
				?>
				</div>
            <div class="CampoForm"><label>MAC:</label>
                <?php
					$dados = array("tabela" => "tbl_equipamento", "value" => "eqpto_mac", "view" => "eqpto_mac", "linhasBranco" => "0", "condicao" => "eqpto_status = 'ESTOQUE'");
					echo preencheCombo("cmbMac", "cmbMac", $dados, $usuario['ap']);
				?>
			</div>
	            <div class="CampoForm">IP:<span id="sprytextfield1">
                <input name="txtIp" type="text" id="txtIp" value="" /><BR/>
                <span class="textfieldRequiredMsg">Campo obrigatório</span><span class="textfieldInvalidFormatMsg">Formato Inv&aacute;lido</span></span></div>
            </fieldset>
            <div class="CampoForm"><input name="cmdAtivar" type="submit" value="Ativar" <?php if(!$_GET['id']) { echo " disabled=\"disabled\" "; } ?>/></div>
            </form>
			<?php listaAtivacoesPendentes(); ?>
  			<!-- TERMINAÇÃO DA PARTE EDITÁVEL DA PÁGINA -->
		</div>
	    <script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "ip");
//-->
        </script>
</body>
</html>
