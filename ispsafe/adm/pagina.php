<?php
	include_once("includes/funcoes.php");
	include_once("includes/ConexaoMySQL.php");
	$conn = new ConexaoMySQL();

	verifica();
	
	if($_GET['pagina']) {
		$sql = "SELECT * FROM tbl_paginas WHERE id = ".intval($_GET['pagina']);
		$query = $conn->sql($sql);
		$pagina = mysql_fetch_array($query);
	}
	if($_POST){
		$sql = "UPDATE tbl_paginas SET nivel = ".intval($_POST['cmbNivel'])." WHERE id = ".intval($_POST['cmbPagina']);
		$saida = $conn->sql($sql);
	}

?><?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>ISP-Save v<?php include('VERSION');?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<style type="text/css">
			<!--
			@import url("../css/estilo02.css");
			-->
		</style>
		<script type="text/javascript" src="../js/funcoes.js"></script>
 <?php verificaNivel(); ?>
</head>

	<body>
		<div class="espacoInterno">
		  <!-- ALTERAR A PARTIR DESTE PONTO -->
			<form action="../executar.php?mod=adm_pagina" method="post" name="frmPagina" target="_self" id="frmPagina">
            <fieldset>
            	<legend>Configurações de Permissões nas Páginas</legend>
            <div class="CampoForm"><label>Página:</label>
            	<?php
					$dados = array("tabela" => "tbl_paginas", "value" => "id", "view" => "pagina", "adicional" => "onchange = \"javascript: document.location.href= document.location.href + '&pagina=' + this.value\"", "linhasBranco" => "1");
					echo preencheCombo("cmbPagina", "cmbPagina", $dados, intval($_GET['pagina']));
				?>
            </div>
                <div class="CampoForm"><label>Nível de Acesso:</label>
                <select name="cmbNivel" id="cmbNivel">
                	<option></option>
                	<option value="2"<?php if($pagina['nivel'] == 2){ echo " SELECTED "; } else { echo ""; } ?>>ADMINISTRADOR</option>
                  	<option value="3"<?php if($pagina['nivel'] == 3){ echo " SELECTED "; } else { echo ""; } ?>>T&Eacute;CNICO</option>
                  	<option value="4"<?php if($pagina['nivel'] == 4){ echo " SELECTED "; } else { echo ""; } ?>>CADASTRAMENTO</option>
                  	<option value="5"<?php if($pagina['nivel'] == 5){ echo " SELECTED "; } else { echo ""; } ?>>LEITOR</option>
                </select></div>
            </fieldset>
            <div class="CampoForm">
            <input name="cmdSalvar" type="submit" value="Salvar" /></div>
			<input name="hidAcao" type="hidden" value="<?php if($banda['band_id'] != '') { echo "ATUALIZA"; } else {echo "SALVA"; } ?>" />
            </form>
           	<center>
		  		<div style="width:300px; height:200px" align="center" >
				<?php if($saida == 1) {
					echo msgErro(6);
				}
				?>
        	    </div>
			</center>
   		<!-- TERMINAÇÃO DA PARTE EDITÁVEL DA PÁGINA -->
		</div>
	</body>
</html>
