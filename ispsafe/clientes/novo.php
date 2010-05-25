<?php
	include_once("includes/funcoes.php");
	include_once("includes/ConexaoMySQL.php");
	verifica();
	
	if($_POST){
		$conn = new ConexaoMySQL();

	    $usuario = valida($_POST['txtCliLogin'],5);
	    $senha = $_POST['txtCliSenha']; 
		$banda = valida($_POST['cmbBanda'],5);
		$pop = $_POST['cmbPop'];
		$ap = $_POST['cmbAccessPoint'];
		$nome = valida($_POST['txtNome'],6);
		$endereco = valida($_POST['txtEndereco'],6);
		$numero = valida($_POST['txtNumero'],3);
		$bairro = valida($_POST['txtBairro'],6);
		$cep = valida($_POST['txtCep'],6);
		$cpfCnpj = valida($_POST['txtCpfCnpj'],6);
		$rgIe = valida($_POST['txtRgIe'],6);
		$telefone = valida($_POST['txtTelefone'],6);
		$celular = valida($_POST['txtCelular'],6);
		$email = valida($_POST['txtEmail'],3);
		$observacoes = valida($_POST['txtObservacoes'],6);
		
		$sql = "INSERT INTO tbl_ativacao (id, emailContato, usuario, senha, banda, nome, endereco, numero, bairro, cep, cpf_cnpj, rg_ie, telefone, celular, ap) VALUES (0, '".$email."', '".$usuario."', '".$senha."', '".$banda."', '".$nome."', '".$endereco."', '".$numero."', '".$bairro."', '".$cep."', '".$cpfCnpj."', '".$rgIe."', '".$telefone."', '".$celular."', '".$ap."')";
		$saida = $conn->sql($sql);
	}	

?><?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>ISP-Save v<?php include('VERSION');?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="../css/estilo02.css" rel="stylesheet" type="text/css" />
     <?php verificaNivel(); ?>
     <?php 	if($saida == 1) {
		echo "<meta http-equiv=\"Refresh\" content=\"0;URL=/clientes.php?mod=cli_ativar\" />";
	} 
	?>
	</head>
	<body>
		<div class="espacoInterno">
		  <!-- ALTERAR A PARTIR DESTE PONTO -->
			<form action="../executar.php?mod=cli_novo" method="POST" name="frmCliNovo" target="_self" id="frmCliNovo">
            <fieldset>
            	<legend>Pré-Cadastro de Clientes</legend>
                <div class="CampoForm"><label>Login:</label><input name="txtCliLogin" type="text" id="txtUsuario" /></div>
                <div class="CampoForm"><label>Senha:</label><input name="txtCliSenha" type="password" id="txtSenha" /></div>
                <div class="CampoForm"><label>Banda:</label>
				<?php
					$dados = array("tabela" => "tbl_banda", "value" => "band_configuracao", "view" => "band_plano");
					echo preencheCombo("cmbBanda", "cmbBanda", $dados, null);
				?>
				</div>
                <div class="CampoForm"><label>Roteador:</label>
				<?php
					$dados = array("tabela" => "tbl_pop", "value" => "id", "view" => "pop", "linhasBranco" => "1");
					echo preencheCombo("cmbPop", "cmbPop", $dados, $accesspoint['pop']);
					?>
                </div>
                <div class="CampoForm"><label>AccessPoint:</label>
                <?php
					$dados = array("tabela" => "tbl_ap", "value" => "id", "view" => "accesspoint", "linhasBranco" => "1");
					echo preencheCombo("cmbAccessPoint", "cmbAccessPoint", $dados, null);
				?>
				</div>
				<div class="CampoForm"><label>Nome:</label><input name="txtNome" type="text" id="txtNome" value="<?php echo $radius['nasname']; ?>"/></div>
                <div class="CampoForm"><label>Endereço/Nº:</label><input name="txtEndereco" type="text" id="txtEndereco" /><input name="txtNumero" type="text" id="txtNumero" /></div>
                <div class="CampoForm"><label>Bairro/CEP:</label><input name="txtBairro" type="text" id="txtBairro" /><input name="txtCep" type="text" id="txtCep" /></div>
                <div class="CampoForm"><label>CPF/CNPJ:</label><input name="txtCpfCnpj" type="text" id="txtCpfCnpj" /></div>
                <div class="CampoForm"><label>RG/IE:</label><input name="txtRgIe" type="text" id="txtRgIe" /></div>
                <div class="CampoForm"><label>Telefone/Celular:</label><input name="txtTelefone" type="text" id="txtTelefone" /><input name="txtCelular" type="text" id="txtCelular" /></div>
                <div class="CampoForm"><label>E-mail de Contato:</label><input name="txtEmail" type="text" id="txtEmail"/></div>
                <div class="CampoForm"><label>Observações:</label><textarea name="txtObservacoes" cols="" rows="" id="txtObservacoes"></textarea></div>
            <div class="CampoForm"><input name="cmdSalvar" type="submit" value="<?php if($radius['id'] != '') { echo "Atualizar"; } else {echo "Salvar"; } ?>" style="z-index:999"/></div>
            </fieldset>
			<input name="hidAcao" type="hidden" value="<?php if($radius['id'] != '') { echo "ATUALIZA"; } else {echo "SALVA"; } ?>" />
            </form>
  			<!-- TERMINAÇÃO DA PARTE EDITÁVEL DA PÁGINA -->
		</div>
	</body>
</html>
