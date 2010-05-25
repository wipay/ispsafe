<?php
	include_once("includes/funcoes.php");
	include_once("includes/ConexaoMySQL.php");

	$conn = new ConexaoMySQL();
	verifica();

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
        <fieldset>
           	<legend>Clientes</legend>
			<div class="paginasIntrodutorias">

		    </div>
        </fieldset>

  			<!-- TERMINAÇÃO DA PARTE EDITÁVEL DA PÁGINA -->
</div>
</body>
</html>
