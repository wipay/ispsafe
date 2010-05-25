<?php
	include_once("includes/funcoes.php");
	include_once("includes/ConexaoMySQL.php");

	verifica();
	
	
	if($_POST){
		$conn = new ConexaoMySQL();
		
    	$valor = $_POST['txtValor']; 
    	$condicao = $_POST['cmbBusca'];

		$sql = "SELECT * FROM tbl_TecClientes WHERE ";
		
		switch($condicao){
			case 'MAC':
				$sql .= "mac LIKE '%".$valor."%'";
				break;
			case 'IP':
				$sql .= "ip LIKE '%".$valor."%'";
				break;
			case 'NOME':
				$sql .= "nome LIKE '%".$valor."%'";
				break;
			case 'USUARIO':
				$sql .= "usuario LIKE '%".$valor."%'";
				break;
			case 'DOMINIO':
				$sql .= "dominio LIKE '%".$valor."%'";
				break;
			case 'ACCESSPOINT':
				$sql .= "ap = '%".mostraAp($valor)."%'";
				break;
			default:
				$sql .= "1 = 1";
		}
		
		$query = $conn->sql($sql);
		$num = mysql_num_rows($query);
		
		$i = 0;
		while($dados = mysql_fetch_array($query)){
			$clientes[$i] = $dados;
			$i++;
		}
		$_SESSION['buscaCliente'] = $clientes;
	}
?><?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>ISP-Save v<?php include('VERSION');?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="../css/estilo02.css" rel="stylesheet" type="text/css" />
     <?php verificaNivel(); ?>
     	<?php if($_POST) { echo "<meta http-equiv=\"refresh\" content=\"0;URL=../executar.php?mod=cli_buscaOk\" />"; }?>
</head>

	<body>
		<div class="espacoInterno">
		  <!-- ALTERAR A PARTIR DESTE PONTO -->
          	<form action="../executar.php?mod=cli_buscar" method="post" name="frmBuscaCli" target="_self" id="frmBuscaCli">
            <fieldset>
            	<legend>Buscar Ex-Clientes (Clientes Exclu&iacute;dos)</legend>
                <div class="CampoForm"><label>Valor:</label><input name="txtValor" type="text" id="txtValor"/></div>
                <div class="CampoForm"><label>Buscar por:</label><select name="cmbBusca" id="cmbBusca">
                  <option value="MAC">MAC</option>
                  <option value="IP">IP</option>
                  <option value="NOME">Nome</option>
                  <option value="USUARIO" selected="selected">Usu&aacute;rio</option>
                  <option value="DOMINIO">Dom&iacute;nio</option>
                  <option value="ACCESSPOINT">Access-Point</option>
            </select></div>
            </fieldset>
            <div class="CampoForm"><input name="cmdBuscar" type="submit" value="Buscar" /></div>
            </form>

  			<!-- TERMINAÇÃO DA PARTE EDITÁVEL DA PÁGINA -->
		</div>
	</body>
</html>
