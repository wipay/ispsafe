<?php
	include_once("includes/funcoes.php");
	include_once("includes/ConexaoMySQL.php");

	verifica();
	$conn = new ConexaoMySQL();
	
	if($_POST['hidId']){
		if($_POST['hidForm'] == 'DADOS_PESSOAIS'){
			$sql = "UPDATE tbl_TecClientes SET ";
			//$sql .= "usuario = '".$_POST['txtCliLogin']."', ";
			$sql .= "senha = '".$_POST['txtCliSenha']."', ";
			$sql .= "nome = '".valida($_POST['txtNome'],2)."', ";
			$sql .= "endereco = '".valida($_POST['txtEndereco'],2)."', ";
			$sql .= "numero = '".valida($_POST['txtNumero'],4)."', ";
			$sql .= "bairro = '".valida($_POST['txtBairro'],2)."', ";
			$sql .= "cep = '".valida($_POST['txtCep'],2)."', ";
			$sql .= "cpf_cnpj = '".valida($_POST['txtCpfCnpj'],2)."', ";
			$sql .= "rg_ie = '".valida($_POST['txtRgIe'],2)."', ";
			$sql .= "telefone = '".valida($_POST['txtTelefone'],2)."', ";
			$sql .= "celular = '".valida($_POST['txtCelular'],2)."', ";
			$sql .= "emailContato = '".valida($_POST['txtEmail'],3)."', ";
			$sql .= "observacoes = '".valida($_POST['txtObservacoes'],2)."'";
			$sql .= " WHERE id = ".$_POST['hidId'];
			
			$result = $conn->sql($sql);
			if($result) { 
					echo "Dados atualizados com sucesso";
					}
		} else {
			$sql = "UPDATE tbl_TecClientes SET ";
			$sql .= "banda = '".$_POST['cmbBanda']."', ";
			$sql .= "pop = '".getPop($_POST['cmbPop'])."', ";
			$sql .= "ap = '".$_POST['cmbAccessPoint']."'";
			$sql .= "banda = '".$_POST['cmbBanda']."', ";



//    $_POST['txtPortaHttp'] => 80
 //   $_POST['txtPortaSsh'] => 22

			// Edita dados técnicos da Conexão
		
		}
		$cliente = getCliente($_POST['hidId']);
	} else {
	
			$cliente = getCliente($_GET['id']);
	
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
            <fieldset>
            	<fieldset>
                	<legend>Status</legend>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="40%"><iframe scrolling="no" allowtransparency="yes" frameborder="0" height="20px" width="250px" src="executar.php?mod=cli_sinal&id=<?php echo $cliente['id']; ?>" id="iframeSinal"></iframe></td>
                        <td width="15%"><div align="center"><a href="executar.php?mod=cli_estatisticas&id=<?php echo $cliente['id']; ?>"><img src="../images/estatisticas.jpg" alt="estatisticas" border="0" /></a></div></td>
                        <td width="45%"><iframe scrolling="no" allowtransparency="yes" frameborder="0" height="16px" width="200px" src="executar.php?mod=cli_autenticado&usuario=<?php echo $cliente['usuario']; ?>" id="iframeAutenticado"></iframe></td>
                      </tr>
                    </table>

                    
                    
                </fieldset>
                <fieldset>
                	<legend>Ações</legend>
                	<div align="center">
                	  <input name="cmbBloquear" type="button" value="Bloquear Cliente" onclick=""/> 
                	  <input name="cmdExcluir" type="button" value="Excluir Cliente" onclick=""/>
              	      </div>
                </fieldset>
                <fieldset>
            	<legend>Editar Cliente</legend>
                	
			<form action="../executar.php?mod=cli_editar" method="POST" name="frmCliNovo" target="_self" id="frmCliNovo">
            <input name="hidId" type="hidden" value="<?php echo $cliente['id']; ?>" />
            <input name="hidForm" type="hidden" value="DADOS_PESSOAIS" />
            <fieldset>
            	<legend>Dados Pessoais</legend>
                <div class="CampoForm">
                  <label>Login</label><input name="txtCliLogin" type="text" id="txtUsuario" value="<?php echo $cliente['usuario']; ?>" readonly="readonly"/></div>
                <div class="CampoForm">
                  <label>Senha</label><input name="txtCliSenha" type="password" id="txtSenha"  value="<?php echo $cliente['senha']; ?>"/></div>
				<div class="CampoForm">
				  <label>Nome</label><input name="txtNome" type="text" id="txtNome"  value="<?php echo $cliente['nome']; ?>"/></div>
                <div class="CampoForm">
                  <label>Endereço/Nº</label><input name="txtEndereco" type="text" id="txtEndereco"  value="<?php echo $cliente['endereco']; ?>"/><input name="txtNumero" type="text" id="txtNumero"  value="<?php echo $cliente['numero']; ?>"/></div>
                <div class="CampoForm">
                  <label>Bairro/CEP</label><input name="txtBairro" type="text" id="txtBairro"  value="<?php echo $cliente['bairro']; ?>"/><input name="txtCep" type="text" id="txtCep"  value="<?php echo $cliente['cep']; ?>"/></div>
                <div class="CampoForm">
                  <label>CPF/CNPJ</label><input name="txtCpfCnpj" type="text" id="txtCpfCnpj"  value="<?php echo $cliente['cpf_cnpj']; ?>"/></div>
                <div class="CampoForm">
                  <label>RG/IE</label><input name="txtRgIe" type="text" id="txtRgIe"  value="<?php echo $cliente['rg_ie']; ?>"/></div>
                <div class="CampoForm">
                  <label>Telefone/Celular</label><input name="txtTelefone" type="text" id="txtTelefone"  value="<?php echo $cliente['telefone']; ?>"/><input name="txtCelular" type="text" id="txtCelular" value="<?php echo $cliente['celular']; ?>"/></div>
                <div class="CampoForm">
                  <label>E-mail Contato</label><input name="txtEmail" type="text" id="txtEmail" value="<?php echo $cliente['email']; ?>"/></div>
                <div class="CampoForm">
                  <label>Observações</label><textarea name="txtObservacoes" cols="" rows="" id="txtObservacoes"><?php echo $cliente['observacoes']; ?></textarea></div>
            <div class="CampoForm"><input name="cmdSalvar" type="submit" value="Salvar" style="z-index:999"/></div>

            </form>                    
                    
                    
                </fieldset>
    			<fieldset>
                	<legend>Dados Técnicos</legend>
           			<form action="../executar.php?mod=cli_editar" method="POST" name="frmCliNovo" target="_self" id="frmCliNovo">
	                <input name="hidId" type="hidden" value="<?php echo $cliente['id']; ?>" />
			            <input name="hidForm" type="hidden" value="DADOS_TECNICOS" />                        
                  <div class="CampoForm"><label>Banda:</label>
				<?php
					$dados = array("tabela" => "tbl_banda", "value" => "band_configuracao", "view" => "band_plano");
					echo preencheCombo("cmbBanda", "cmbBanda", $dados, $cliente['banda']);
				?>
				</div>
                <div class="CampoForm"><label>Roteador:</label>
				<?php
					$dados = array("tabela" => "tbl_pop", "value" => "id", "view" => "pop", "linhasBranco" => "1");
					echo preencheCombo("cmbPop", "cmbPop", $dados, getIdPop($cliente['pop']));
					?>
                </div>
                <div class="CampoForm"><label>AccessPoint:</label>
                <?php
					$dados = array("tabela" => "tbl_ap", "value" => "id", "view" => "accesspoint", "linhasBranco" => "1");
					echo preencheCombo("cmbAccessPoint", "cmbAccessPoint", $dados, $cliente['ap']);
				?>
				</div>
                <div class="CampoForm"><label>WPA:</label><input name="txtWpa" type="text" id="txtWpa" value="<?php echo $cliente['wpaPsk']; ?>"readonly="readonly"/></div>
                <div class="CampoForm"><label>Equipamento:</label><input name="txtEqpto" type="text" id="txtEqpto" value="<?php echo $cliente['eqptoPwd']; ?>"readonly="readonly"/></div>
                <div class="CampoForm"><label>Eqpto. HTTP:</label><input name="txtPortaHttp" type="text" id="txtPortaHttp" value="80"/></div>
                <div class="CampoForm"><label>Eqpto. SSH:</label><input name="txtPortaSsh" type="text" id="txtPortaSsh" value="22" /></div>
            <div class="CampoForm"><input name="cmdSalvar" type="submit" value="Salvar" style="z-index:999"/></div>

            </form>
            </fieldset>    
            </fieldset>    
            <img src="../images/10px.gif" alt="espaco_em_branco" />
  			<!-- TERMINAÇÃO DA PARTE EDITÁVEL DA PÁGINA -->
		</div>
	</body>
</html>
