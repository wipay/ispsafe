<?php
	include_once("includes/funcoes.php");
	include_once("includes/ConexaoMySQL.php");
	verifica();
	
	if($_POST){
		$conn = new ConexaoMySQL();

	    $mac = $_POST['txtMac'];
    	$situacao = $_POST['cmbSituacao'];
    	$status = $_POST['cmbStatus'];

		$sql_procura = "SELECT * FROM tbl_equipamento WHERE ";
		if($mac != '') { $sql_procura .= "eqpto_mac LIKE '%".$mac."%' AND "; }
		$sql_procura .= "eqpto_situacao = '".$situacao."' AND eqpto_status = '".$status."'";
		
		$query_procura = $conn->sql($sql_procura);
		
		$encontrou = mysql_num_rows($query_procura);
		
		
		if($encontrou > 0){
			$i = 0;
			while($dados = mysql_fetch_array($query_procura)){
				$eqpto[$i] = $dados['eqpto_id'];
				$i++;
			}
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
			<form action="../executar.php?mod=eqpto_buscar" method="POST" name="frmEqptoBuscar" target="_self" id="frmEqptoBuscar">
            <fieldset>
            	<legend>Busca de Equipamentos de Clientes</legend>
                
                <?php if($i<1){ ?>
                
                <div class="CampoForm"><label>MAC:</label><input name="txtMac" type="text" id="txtMac" onKeyDown="Mascara(this,mac);" maxlength="17"/></div>
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
            <div class="CampoForm"><input name="cmdBuscar" type="submit" value="Buscar" style="z-index:999"/></div>
         
            <?php 
			} else {
			
				$num = count($eqpto);
				$i = 0;
				while($i < $num){
					mostraEqpto($eqpto[$i]);
					$i++;
				}
			}
			 ?>
            </fieldset>
            </form>        
			<!-- TERMINAÇÃO DA PARTE EDITÁVEL DA PÁGINA -->
		</div>
	</body>
</html>
