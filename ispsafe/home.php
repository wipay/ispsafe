<?php
	include_once("includes/funcoes.php");
	include_once("includes/ConexaoMySQL.php");

	verifica();

?><?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>ISP-Save v<?php include('VERSION');?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<style type="text/css">
			<!--
			@import url("css/estilo02.css");
			-->
		</style>
	</head>

	<body>
		<div class="espacoInterno">
		  <!-- ALTERAR A PARTIR DESTE PONTO -->
		  
  <table width="100%" id="tblInicio">
    <tr> 
      <td colspan="2" class="celTitulo1">ISP-Safe v <?php include('VERSION'); ?>
        [<?php echo $_SERVER['SERVER_NAME']; ?>]</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td width="30%" class="celDescricao">Clientes Cadastrados:</td>
      <td width="70%" class="celValor1"><?php echo nClientes('CADASTRADOS'); ?></td>
    </tr>
    <tr> 
      <td class="celDescricao">Clientes Ativos:</td>
      <td class="celValor1"><?php echo nClientes('ATIVOS'); ?></td>
    </tr>
    <tr> 
      <td class="celDescricao">Clientes Bloqueados:</td>
      <td class="celValor1"><?php echo nClientes('BLOQUEADOS'); ?></td>
    </tr>
    <tr> 
      <td class="celDescricao">Ativa&ccedil;&otilde;es Pendentes:</td>
      <td class="celValor1"><?php echo nClientes('ATIVAR'); ?></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td class="celDescricao">Dom&iacute;nios:</td>
      <td class="celValor1"><?php echo nSistema('DOMINIOS'); ?></td>
    </tr>
    <tr> 
      <td class="celDescricao">Access-Points:</td>
      <td class="celValor1"><?php echo nSistema('ACCESSPOINT'); ?></td>
    </tr>
  </table>
  	<center>
  		<div style="width:400px; height:200px" align="center" >
 			<?php echo msgErro($_GET['msg']); ?>
 		</div>
	</center>
  			<!-- TERMINAÇÃO DA PARTE EDITÁVEL DA PÁGINA -->
		</div>
	</body>
</html>
