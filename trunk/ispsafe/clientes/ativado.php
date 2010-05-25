<?php
	include_once("includes/funcoes.php");
	include_once("includes/ConexaoMySQL.php");

	verifica();
	$erro = NULL;
	
	$ip = valida($_POST['txtIp'],7);
	if($ip){
		$pop = getPop($_POST['cmbPop']);
		$ap = getAp($_POST['cmbAccessPoint']);
		if($ap['estacao'] == $pop['pop']){
			$usuario = getAtivacao($_POST['hidCliente']);
			$eqpto = getEqpto($_POST['cmbMac']);
			$sql = "INSERT INTO tbl_TecClientes(
				id,
				usuario,
				senha,
				dominio,
				pop,
				ap,
				ip,
				mascara,
				mac,
				banda,
				status,
				motivoBloqueio,
				wpaPsk,
				eqptoPwd,
				emailContato,
				nome,
				endereco,
				numero,
				bairro,
				cidade,
				uf,
				cep,
				cpf_cnpj,
				rg_ie,
				telefone,
				celular,
				funcionario,
				dataUltMod,
				observacoes	
				) VALUES(
				0,
				'".$usuario['usuario']."',
				'".$usuario['senha']."',
				'".$pop['dominio']."',
				'".$pop['pop']."',
				'".$ap['id']."',
				'".$_POST['txtIp']."',
				'255.255.255.255',
				'".$_POST['cmbMac']."',
				'".$usuario['banda']."',
				'ATIVO',
				'',
				'".$eqpto['eqpto_wpa']."',
				'".$eqpto['eqpto_senha']."',
				'".$usuario['emailContato']."',
				'".$usuario['nome']."',
				'".$usuario['endereco']."',
				'".$usuario['numero']."',
				'".$usuario['bairro']."',
				'".$usuario['cidade']."',
				'".$usuario['uf']."',
				'".$usuario['cep']."',
				'".$usuario['cpf_cnpj']."',
				'".$usuario['rg_ie']."',
				'".$usuario['telefone']."',
				'".$usuario['celular']."',
				'".$_SESSION['usuario']."',
				NOW(),
				'".$usuario['observacoes']."'				
				)";
				
				echo $sql;
				$conn = new ConexaoMySQL();
				$insere = $conn->sql($sql);
				
				if($insere == 1) {
					$sql = "UPDATE tbl_equipamento SET eqpto_status = 'USO' WHERE eqpto_mac = '".$_POST['cmbMac']."'";
					$muda = $conn->sql($sql);

					$sql = "DELETE FROM tbl_ativacao WHERE id = ".$_POST['hidCliente'];
					$conn->sql($sql);
			}
				if(($muda == 1) && ($insere == 1)){
					$resultado = "OK";
				} else {
					$resultado = "PROBLEMA";
				}
		} else {
			$erro = "Access-Point n�o est� nesta esta&ccedil;&atilde;o.";
		}
	} else {
		echo "N&Atilde;O";
	}
	

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
            	<legend>Ativa��o de Cliente</legend>

					<span class="celTitulo1">Cliente ativado com sucesso.</span>
            </fieldset>	
  			<!-- TERMINA��O DA PARTE EDIT�VEL DA P�GINA -->
		</div>
</body>
</html>
