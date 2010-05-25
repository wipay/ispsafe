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
		<link href="../css/estilo02.css" rel="stylesheet" type="text/css" />
     <?php verificaNivel(); ?>
     <script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
     <link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
    </head>

	<body>
		<div class="espacoInterno">
		  <!-- ALTERAR A PARTIR DESTE PONTO -->
            <fieldset>
            	<legend>Busca de Clientes</legend>
				<span class="celDescricao" style="width:100%">Foram encontrados <?php echo count($_SESSION['buscaCliente']); ?> cliente com seus crit&eacute;rios de busca.&nbsp;</span><BR/>
				<?php 
					$i = 0;
					while($i < count($_SESSION['buscaCliente'])){
					
						echo "<div id='eqptoExterno'><A HREF='?mod=cli_editar&id=".$_SESSION['buscaCliente'][$i]['id']."'>[".$_SESSION['buscaCliente'][$i]['nome']."]<div id='eqptoInterno'>".$_SESSION['buscaCliente'][$i]['usuario']."</div></A></div>";

						$i++;
					}			
				?>
            </fieldset>	
  			<!-- TERMINAÇÃO DA PARTE EDITÁVEL DA PÁGINA -->
		</div>
</body>
</html>
