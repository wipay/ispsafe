<?php
/**
*****************************
** Arquivo gerado no EditPlus v3.01
** Marcelo Divaldo Brake
** marcelo@marcelobrake.com.br
** Todos os direitos são reservados.
*******************************/

//
// TODO:
//

	include_once("ConexaoMySQL.php");



function gerarEqpto(){
			$vogais =Array('a','e','i','o','u','y','b','c','d','f','g','h','j','k','l','m','n','p','q','r','s','t','v','w','x','z','1','2','3','4','5','6','7','8','9','0');
			$consoantes=Array('a','e','i','o','u','y','b','c','d','f','g','h','j','k','l','m','n','p','q','r','s','t','v','w','x','z','1','2','3','4','5','6','7','8','9','0');
			$pwdEqpto='';
			for($i=0;$i<6;$i++){
				if($i%2==0){
					$xx3=mt_rand(0,35);
					$pwdEqpto.=$consoantes[$xx3];
				}else{
					$xx4=mt_rand(0,35);
					$pwdEqpto.=$vogais[$xx4];
				}
			}
			return($pwdEqpto);
}

function gerarWPA(){
			$string1 =Array('a','e','i','o','u','y','b','c','d','f','g','h','j','k','l','m','n','p','q','r','s','t','v','w','x','z','1','2','3','4','5','6','7','8','9','0','!','@','#','$','&','*','(',')','_','-');
			$string2=Array('a','e','i','o','u','y','b','c','d','f','g','h','j','k','l','m','n','p','q','r','s','t','v','w','x','z','1','2','3','4','5','6','7','8','9','0','!','@','#','$','&','*','(',')','_','-');
			$pwdWAP='';
			for($i=0;$i<10;$i++){
				if($i%2==0){
					$xx3=mt_rand(0,40);
					$pwdWAP.=$string2[$xx3];
				}else{
					$xx4=mt_rand(0,40);
					$pwdWAP.=$string1[$xx4];
				}
			}
			return($pwdWAP);
}
/*function valida($array){
	$sql = "SELECT id IDUSER, login LOGIN, senha SENHA, nivel NIVEL FROM tbl_usuario WHERE login = '".$array['LOGIN']."' AND senha = '".$array['SENHA']."'";
	$conn = new ConexaoMySQL();
	$xpto = $conn->sql($sql);
	$num = MySQL_Num_Rows($xpto);
	if($num == 1)
		return(true);
	else
		return(false);
}
*/
function intruso($array){
	$sql = "SELECT id IDUSER, login LOGIN, senha SENHA, nivel NIVEL FROM tbl_usuario WHERE login = '".$array['LOGIN']."' AND senha = '".$array['SENHA']."'";
	$conn = new ConexaoMySQL();
	$xpto = $conn->sql($sql);
	$num = MySQL_Num_Rows($xpto);
	if($num != 1){
		echo "<meta http-equiv=\"refresh\" content=\"0;URL=inicial.php\" />";
		$_SESSION = array();
		exit();
	}
	return;
}
function permite($array, $nivel, $tipo){
	$sql = "SELECT id IDUSER, login LOGIN, senha SENHA, nivel NIVEL FROM tbl_usuario WHERE login = '".$array['LOGIN']."' AND senha = '".$array['SENHA']."'";
	$conn = new ConexaoMySQL();
	$xpto = $conn->sql($sql);
	$xyz = MySQL_Fetch_Array($xpto);
	if ($xyz['NIVEL'] <= $nivel){
		$acesso = "";
	}
	else
	{
		$tipo = "password";
		$acesso = "readonly";
	}

	echo " type=\"".$tipo."\" ".$acesso." ";

}


function ConverteData($data){
	$xpto = explode(" ", $data);
	$data = $xpto[0];
	$hora = $xpto[1];

	$dataArray = explode("-", $data);

	$dataConvertida = $dataArray[2]."/".$dataArray[1]."/".$dataArray[0];

	return($dataConvertida." ".$hora);

}

function ConverteTempo($tempo){
	return(gmdate("H:m:s",$tempo));
}


function RegistraModificacao($usuario, $funcionario, $momento){
		//usuário: login do cliente que será feito o registro da modificação
		//funcionario: login do funcionario que está fazendo a modificação
		//momento: antes ou depois da modificação
/*===============================================================================================================*/
		if ($momento == 'ANTES') {
			$sql = "SELECT * FROM tbl_TecClientes WHERE usuario = '".$usuario."'";
			$conn = new ConexaoMySQL();
			$xpto = $conn->sql($sql);
			$arrayAntes = MySQL_Fetch_Array($xpto);
			$antes = $arrayAntes['id']."|".$arrayAntes['usuario']."|".$arrayAntes['senha']."|".$arrayAntes['dominio']."|".$arrayAntes['pop']."|".$arrayAntes['ip']."|".$arrayAntes['mascara']."|".$arrayAntes['mac']."|".$arrayAntes['banda']."|".$arrayAntes['status']."|".$arrayAntes['wpaPsk']."|".$arrayAntes['eqptoPwd']."|".$arrayAntes['loginFinanceiro']."|".$arrayAntes['emailContato']."|".$arrayAntes['nome']."|".$arrayAntes['endereco']."|".$arrayAntes['numero']."|".$arrayAntes['bairro']."|".$arrayAntes['cep']."|".$arrayAntes['telefone']."|".$arrayAntes['celular']."|".$arrayAntes['funcionario']."|".$arrayAntes['dataUltMod']."|".$arrayAntes['observacoes'];
			$depois = "|||||||||||||||||||||||";
			$sql_modificacao = "INSERT INTO tbl_modificacoes (id, data, usuarioSistema, loginCliente, antes, depois, concluido) VALUES (null, NOW(), '".$funcionario."', '".$usuario."', '".$antes."', '".$depois."', 'N')";
			$xpto = $conn->sql($sql_modificacao);
		}
/*===============================================================================================================*/
		if ($momento == 'DEPOIS') {
			$sql = "SELECT * FROM tbl_TecClientes WHERE usuario = '".$usuario."'";
			$conn = new ConexaoMySQL();
			$xpto = $conn->sql($sql);
			$arrayDepois = MySQL_Fetch_Array($xpto);
			$depois = $arrayDepois['id']."|".$arrayDepois['usuario']."|".$arrayDepois['senha']."|".$arrayDepois['dominio']."|".$arrayDepois['pop']."|".$arrayDepois['ip']."|".$arrayDepois['mascara']."|".$arrayDepois['mac']."|".$arrayDepois['banda']."|".$arrayDepois['status']."|".$arrayDepois['wpaPsk']."|".$arrayDepois['eqptoPwd']."|".$arrayDepois['loginFinanceiro']."|".$arrayDepois['emailContato']."|".$arrayDepois['nome']."|".$arrayDepois['endereco']."|".$arrayDepois['numero']."|".$arrayDepois['bairro']."|".$arrayDepois['cep']."|".$arrayDepois['telefone']."|".$arrayDepois['celular']."|".$arrayDepois['funcionario']."|".$arrayDepois['dataUltMod']."|".$arrayDepois['observacoes'];
			$sqlId = "SELECT id FROM tbl_modificacoes WHERE loginCliente = '".$usuario."' AND concluido = 'N'";
			$xyz = $conn->sql($sqlId);
			$id = MySQL_Fetch_Array($xyz);
			$sqlConcluido = "UPDATE tbl_modificacoes SET depois = '".$depois."', concluido = 'S' WHERE id = ".$id['id'];
			$xpto = $conn->sql($sqlConcluido);

			$sqlVerModidicacao = "SELECT * FROM tbl_modificacoes WHERE id = ".$id['id'];
			$xpto = $conn->sql($sqlVerModidicacao);
			$array = MySQL_Fetch_Array($xpto);
			$antes = $array['antes'];
			$antes = explode('|',$antes);
			$depois = $array['depois'];
			$depois = explode('|', $depois);

			$xpto = explode(" ", $array['data']);
			$data = $xpto[0];
			$hora = $xpto[1];
			$dataArray = explode("-", $data);
			$dia = $dataArray[2]."/".$dataArray[1]."/".$dataArray[0];


			$to = "wireless-adm@mdbrasil.com.br";
			$subject = "Modificação em Cliente Wireless";
			$html = "
					<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
					<html xmlns=\"http://www.w3.org/1999/xhtml\">
					<head>
					<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
					<title>Modificação de Cliente Wireless</title>
					<style type=\"text/css\">
					<!--
					body,td,th {
						font-family: Verdana, Arial, Helvetica, sans-serif;
						font-size: 12px;
						color: #000000;
					}
					body {
						background-color: #CCCCCC;
						margin-left: 0px;
						margin-top: 0px;
						margin-right: 0px;
						margin-bottom: 0px;
					}
					a {
						font-family: Verdana, Arial, Helvetica, sans-serif;
						font-size: 12px;
						color: #000000;
					}
					a:link {
						text-decoration: none;
					}
					a:visited {
						text-decoration: none;
						color: #000000;
					}
					a:hover {
						text-decoration: underline;
						color: #000000;
					}
					a:active {
						text-decoration: none;
						color: #000000;
					}
					.style1 {
						font-size: 14px;
						font-weight: bold;
					}
					.style2 {
						color: #000099;
						font-weight: bold;
					}
					.style3 {color: #000099}
					-->
					</style></head>

					<body>
					<table width=\"780\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
					  <tr>
						<td><div align=\"center\"><span class=\"style1\">Modificação em Cliente Wireless</span></div></td>
					  </tr>
					  <tr>
						<td><p><strong>ANTES:</strong></p>
						  <table width=\"600\" border=\"0\" align=\"right\" cellpadding=\"0\" cellspacing=\"3\">
							<tr>
							  <th width=\"123\" bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">Usuário</div></th>
							  <td width=\"468\">".$antes[1]."</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">Senha</div></th>
							  <td>".md5($antes[2])." *</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">Dominio/POP</div></th>
							  <td>".$antes[3]."/".$antes[4]."</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">IP/mascara</div></th>
							  <td>".$antes[5]."/".$antes[6]."</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">MAC</div></th>
							  <td>".$antes[7]."</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">Banda</div></th>
							  <td>".$antes[8]."</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">Status</div></th>
							  <td>".$antes[9]."</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">WPA</div></th>
							  <td>".md5($antes[10])." *</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">Transceptor</div></th>
							  <td>".md5($antes[11])." *</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">Financeiro</div></th>
							  <td>".$antes[12]."</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">E-mail de contato</div></th>
							  <td>".$antes[13]."</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">Nome</div></th>
							  <td>".$antes[14]."</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">Endereço</div></th>
							  <td>".$antes[15].", ".$antes[16]."</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">Bairro</div></th>
							  <td>".$antes[17]."</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">CEP</div></th>
							  <td>".$antes[18]."</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">Telefone</div></th>
							  <td>".$antes[19]."</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">Celular</div></th>
							  <td>".$antes[20]."</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">Observações</div></th>
							  <td rowspan=\"3\" align=\"left\" valign=\"top\">".$antes[23]."</td>
							</tr>
							<tr>
							  <th scope=\"row\"><div align=\"left\"></div></th>
							</tr>
							<tr>
							  <th scope=\"row\"><div align=\"left\"></div></th>
							</tr>
						  </table>
						  </td>
					  </tr>
					  <tr>
					  <td>
					  <hr />
					  </td>
					  </tr>
					  <tr>
						<td><p><strong>DEPOIS:</strong></p>
						  <table width=\"600\" border=\"0\" align=\"right\" cellpadding=\"0\" cellspacing=\"3\">
							<tr>
							  <th width=\"123\" bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">Usuário</div></th>
							  <td width=\"468\">".$depois[1]."</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">Senha</div></th>
							  <td>".md5($depois[2])." *</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">Dominio/POP</div></th>
							  <td>".$depois[3]."/".$depois[4]."</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">IP/mascara</div></th>
							  <td>".$depois[5]."/".$depois[6]."</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">MAC</div></th>
							  <td>".$depois[7]."</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">Banda</div></th>
							  <td>".$depois[8]."</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">Status</div></th>
							  <td>".$depois[9]."</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">WPA</div></th>
							  <td>".md5($depois[10])." *</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">Transceptor</div></th>
							  <td>".md5($depois[11])." *</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">Financeiro</div></th>
							  <td>".$depois[12]."</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">E-mail de contato</div></th>
							  <td>".$depois[13]."</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">Nome</div></th>
							  <td>".$depois[14]."</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">Endereço</div></th>
							  <td>".$depois[15].", ".$depois[16]."</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">Bairro</div></th>
							  <td>".$depois[17]."</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">CEP</div></th>
							  <td>".$depois[18]."</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">Telefone</div></th>
							  <td>".$depois[19]."</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">Celular</div></th>
							  <td>".$depois[20]."</td>
							</tr>
							<tr>
							  <th bgcolor=\"#FFFFFF\" scope=\"row\"><div align=\"left\">Observações</div></th>
							  <td rowspan=\"3\" align=\"left\" valign=\"top\">".$depois[23]."</td>
							</tr>
							<tr>
							  <th scope=\"row\"><div align=\"left\"></div></th>
							</tr>
							<tr>
							  <th scope=\"row\"><div align=\"left\"></div></th>
							</tr>
						  </table>      </td>
					  </tr>
					  <tr>
					  <td>
					  <hr />
					  </td>
					  </tr>
					  <tr>
						<td><div align=\"right\">Modificação realizada por <span class=\"style2\">".$funcionario."</span> em <span class=\"style2\">".$dia."</span> às <span class=\"style3\"><strong>".$hora."</strong>.</span></div></td>
					  </tr>
					</table>
					</body>
					</html>


			";
			$headers = "Content-type: text/html; charset=utf-8\r\n";
			$headers .= "Reply-to: \"Agenda MD Brasil\" <agenda@mdbrasil.com.br>\r\n";
			$headers .= "From: \"Sistema Wireless\" <wireless@mdbrasil.com.br>\r\n";
			$headers .= "Organization: \"MD Brasil - Tecnologia da Informação S/C Ltda\"\r\n";
			$headers .= "Sender: \"Sistema de Controle Wireless\" <marcelo@marcelobrake.eti.br>\"\r\n";

			if (mail($to, $subject, $html, $headers)) {
				echo "Email enviado com sucesso !<br/>";
			} else {
				echo "Ocorreu um erro durante o envio do email.<br/>";
			}
		}
	return;
}

function mostraAp($id) {
	if(!empty($id)) {
		$sql = "SELECT accesspoint FROM tbl_ap WHERE id = $id";
		$conn = new ConexaoMySQL();
		$xpto = $conn->sql($sql);
		$xyz = MySQL_Fetch_Array($xpto);
		echo $xyz[0];
	} else {
		echo "Access Point não registrado.";
	}
}
function mostraBanda($banda) {
	if(!empty($banda)) {
		$sql = "SELECT band_plano FROM tbl_banda WHERE band_configuracao = '".$banda."'";
		$conn = new ConexaoMySQL();
		$xpto = $conn->sql($sql);
		$xyz = MySQL_Fetch_Array($xpto);
		echo $xyz[0];
	} else {
		echo "Plano Desconhecido.";
	}
}
function mostraUsuario($id) {
	if(!empty($id)) {
		$sql = "SELECT nome FROM tbl_usuario WHERE id = ".$id;
		$conn = new ConexaoMySQL();
		$xpto = $conn->sql($sql);
		$xyz = MySQL_Fetch_Array($xpto);
		echo $xyz[0];
	} else {
		echo "Usuário Desconhecido.";
	}
}
function mostraPop($id) {
	if(!empty($id)) {
		$sql = "SELECT dominio FROM tbl_pop WHERE id = ".$id;
		$conn = new ConexaoMySQL();
		$xpto = $conn->sql($sql);
		$xyz = MySQL_Fetch_Array($xpto);
		echo $xyz[0];
	} else {
		echo "POP Desconhecido.";
	}
}


function mostraNomeMac($mac_dec){
	if(!empty($mac_dec)) {
		$mac = explode(".", $mac_dec);
		if(strlen(dechex($mac[0])) < 2 ) { $mac1 = "0".dechex($mac[0]); } else { $mac1 = dechex($mac[0]); }
		if(strlen(dechex($mac[1])) < 2 ) { $mac2 = "0".dechex($mac[1]); } else { $mac2 = dechex($mac[1]); }
		if(strlen(dechex($mac[2])) < 2 ) { $mac3 = "0".dechex($mac[2]); } else { $mac3 = dechex($mac[2]); }
		if(strlen(dechex($mac[3])) < 2 ) { $mac4 = "0".dechex($mac[3]); } else { $mac4 = dechex($mac[3]); }
		if(strlen(dechex($mac[4])) < 2 ) { $mac5 = "0".dechex($mac[4]); } else { $mac5 = dechex($mac[4]); }
		if(strlen(dechex($mac[5])) < 2 ) { $mac6 = "0".dechex($mac[5]); } else { $mac6 = dechex($mac[5]); }
		$mac_final = $mac1.":".$mac2.":".$mac3.":".$mac4.":".$mac5.":".$mac6;
		$sql = "SELECT usuario FROM tbl_TecClientes WHERE mac = '".$mac_final."'";
		$conn = new ConexaoMySQL();
		$xpto = $conn->sql($sql);
		$xyz = MySQL_Fetch_Array($xpto);
		return($xyz[0]);
	}
}

function grafico($sinal, $legenda){
	$sinalAbsoluto=100-abs($sinal);
	$limite = 65;
	if ( abs($sinal) < $limite )
		$cor = "#00FF00";
	else
		$cor = "#FF0000";
		$tabela = "<center><table><tr><td width='180px'><div align='right'>".$legenda."</div></td><td><table width='200px'><tr><td width='".$sinalAbsoluto."%' bgcolor='".$cor."'>&nbsp;</td><td bgcolor='#FFFFFF'>".$sinal."dBi</tr></table></td></tr></table></center>";
	return($tabela);
}
function idCliente($login) {
	if(!empty($login)) {
		$sql = "SELECT id FROM tbl_TecClientes WHERE usuario = '".$login."'";
		$conn = new ConexaoMySQL();
		$asdfg = $conn->sql($sql);
		$xyz = MySQL_Fetch_Array($asdfg);
		return($xyz[0]);
	} else {
		return(0);
	}
}

function loginCliente($id) {
	if(!empty($id)) {
		$sql = "SELECT usuario FROM tbl_TecClientes WHERE id = '".$id."'";
		$conn = new ConexaoMySQL();
		$qwert = $conn->sql($sql);
		$xyz = MySQL_Fetch_Array($qwert);
		return($xyz[0]);
	} else {
		return(0);
	}
}

function statusHotspot($usuario){
	$conectado = false;
	$conn = new ConexaoMySQL();
	$sql = "SELECT dominio FROM tbl_TecClientes WHERE usuario = '".$usuario."'";
	$dominio = mysql_fetch_array($conn->sql($sql));
	$sql2 = "SELECT * FROM tbl_pop WHERE dominio = '".$dominio[0]."'";
	$servidor = mysql_fetch_array($conn->sql($sql2));


	$executa = nl2br(shell_exec("/usr/local/bin/snmpwalk -Os -c ".$servidor['snmp']." -v 1 ".$servidor['ip']." .1.3.6.1.4.1.14988.1.1.5.1.1.3"));
	$limpa = explode("<br />", $executa);

	foreach($limpa as $linha){
		$xpto = explode(" = ", $linha);
		$usr = explode('"', $xpto[1]);
		if($usr[1] == $usuario) {
			$conectado = true;
		}
	}

	if($conectado) {
		echo "<img src=\"/images/hotspot_on.png\" alt=\"Hotspot Conectado\" width=\"16\" height=\"16\" border=\"0\" /> Usu&aacute;rio Autenticado.";
	} else {
		echo "<img src=\"/images/hotspot_off.png\" alt=\"Hotspot Desconectado\" width=\"16\" height=\"16\" border=\"0\" /> Usu&aacute;rio N&atilde;o Autenticado";
	}

}

function dataPtBr(){
// leitura das datas automaticamente
$dia = date('d');
$mes = date('m');
$ano = date('Y');
$semana = date('w');
$cidade = "Bebedouro";

// configuração mes 

switch ($mes){

case 1: $mes = "Janeiro"; break;
case 2: $mes = "Fevereiro"; break;
case 3: $mes = "Mar&ccedil;o"; break;
case 4: $mes = "Abril"; break;
case 5: $mes = "Maio"; break;
case 6: $mes = "Junho"; break;
case 7: $mes = "Julho"; break;
case 8: $mes = "Agosto"; break;
case 9: $mes = "Setembro"; break;
case 10: $mes = "Outubro"; break;
case 11: $mes = "Novembro"; break;
case 12: $mes = "Dezembro"; break;

}


// configuração semana 

switch ($semana) {

case 0: $semana = "Domingo"; break;
case 1: $semana = "Segunda Feira"; break;
case 2: $semana = "Ter&ccedil;a Feira"; break;
case 3: $semana = "Quarta Feira"; break;
case 4: $semana = "Quinta Feira"; break;
case 5: $semana = "Sexta Feira"; break;
case 6: $semana = "S&aacute;bado"; break;

}
//Agora basta imprimir na tela...
return("$cidade, $semana, $dia de $mes de $ano");

}


function valida($valor, $tipo){
	switch($tipo){
		case 1:	//hash md5
			$saida = explode(" ", $valor); //como espera um hash md5, obviamente não pode conter espaços, caso venha, pega somente a primeira porção
			$saida = htmlentities($saida[0]);//substitui qualquer caractere especial pelo seu representante me HTML
			break;
		case 2: //texto normal
			$saida = htmlentities(strtoupper($valor)); //coloca toda a string em caixa alta e substitie caracteres especiais pelos seus correspondentes em HTML
			break;
		case 3: //email
			$saida = htmlentities(strtolower($valor)); //coloca toda a string em caixa baixa e substitui caracteres especiais pelos seus correspondentes em HTML
			break;
		case 4: //número inteiro
			$saida = intval($valor);
			break;
		case 5: //minusculos
			$saida = strtolower(strtoupper($valor));
			break;
		case 6: //maiusculos
			$saida = htmlentities(strtoupper($valor));
			break;
		case 7: //Endereços IP
			$octeto = explode(".",$valor);
			for($i = 0; $i < 4; $i++){
				if(($octeto[$i]<=255)&&($octeto[$i]>=0)){
					$bloco[$i] = $octeto[$i];
				} else {
					$saida = "0.0.0.0";
					break;
				}
			}
			$ip = $bloco[0].".".$bloco[1].".".$bloco[2].".".$bloco[3];
			include_once('ConexaoMySQL.php');
			$conn = new ConexaoMySQL();
			
			$sql = "SELECT usuario FROM tbl_TecClientes WHERE ip = '".$ip."'";
			$query = $conn->sql($sql);
			
			$num = mysql_num_rows($query);
			
			if($num < 1) {
				$saida = $ip;
			} else {
				$saida = false;
			}
			break;
		default: //se nao foi especificado tipo
			$saida = htmlentities($valor); //retorna a string substituindo os caracteres especiais por seus correspondentes em HTML
	}
	return $saida; //retorna a string teoricamente validada
}

function verifica(){
	session_start();
	include_once("ConexaoMySQL.php");
	
	$conn = new ConexaoMySQL();
	$sql = "SELECT * FROM tbl_usuario WHERE login = '".$_SESSION['usuario']."'";
	
	$result = $conn->sql($sql);
	$dados = mysql_fetch_array($result);
	if($_SESSION['senha'] == md5($dados['senha'])) {
	if(mysql_num_rows($result) == 1) {
			$saudacao = "Olá, ".$dados['nome'].", seja bem vindo à esta página";
		} else {
			header("Location: inicial.php?msg=2");
			exit();
		}
		return($saudacao);
	} else {
		header("Location: inicial.php?msg=2");
		exit();
	}
}

function logado(){
	session_start();
	include_once("ConexaoMySQL.php");
	
	if(($_SESSION['usuario'] != '')||($_SESSION['senha'] != '')) {
		$conn = new ConexaoMySQL();
		$sql = "SELECT * FROM tbl_usuario WHERE login = '".$_SESSION['usuario']."'";
	
		$result = $conn->sql($sql);
		$dados = mysql_fetch_array($result);
	
		if(($dados['nivel'] < 10) && ($_SESSION['senha'] == md5($dados['senha']))) {
			header("Location: interno.php");
		} else {
			header("Location: inicial.php?msg=3");
		}
	} 
	return;
}

function msgErro($cod){
	switch($cod){
		case 1:
			$msg = "<div class=erro>Erro no usuário ou senha.</div>";
			break;
		case 2:
			$msg = "<div class=erro>Você precisa estar autenticado para acessar esta página.</div>";
			break;
		case 3:
			$msg = "<div class=msg>Logout realizado com sucesso.</div>";
			break;
		case 4:
			$msg = "<div class=msg>Cadastro Realizado com Sucesso!</div>";
			break;
		case 5:
			$msg = "<div class=erro>Houve um erro durante o cadastro. Realize o cadastro novamente.</div>";
			break;
		case 6:
			$msg = "<div class=msg>Dados atualizados com sucesso.</div>";
			break;
		case 7:
			$msg = "<div class=erro>Houve um erro durante a atualiza&ccedil;ão. Tente novamente.</div>";
			break;
		case 8:
			$msg = "<div class=erro>Houve um erro durante o login. Seu IP n&atilde;o est&aacute; autorizado para este usu&aacute;rio.</div>";
			break;
		case 9:
			$msg = "<div class=erro>Houve um erro durante o login. Seu usuário n&atilde;o est&aacute; mais autorizado.</div>";
			break;
		case 10:
			$msg = "<div class=erro>Este usu&aacute;rio n&atilde;o tem permiss&atilde;o para acessar a p&aacute;gina <span class=\"paginaNaoPermitida\">".$_GET['pagSemAcesso']."</span>.</div>";
			break;
		case 11:
			$msg = "<div class=erro>Este MAC Address j&aacute; est&aacute; cadastrado no Sistema.</div>";
			break;
		default:
			$msg = "";
		}
		return($msg);
}

function exibir($nivel, $exibe){
	if($_SESSION['nivel'] == $nivel){
		return($exibe);
	}
	return;
}

function nClientes($filtra) {
	include_once('ConexaoMySQL.php');
	$conn = new ConexaoMySQL();
	
	switch($filtra){
		case 'ATIVAR':
			$sql = "SELECT COUNT(usuario) FROM tbl_ativacao";
			$query = $conn->sql($sql);
			$saida = mysql_fetch_row($query);		
			break;
		case 'BLOQUEADOS':
			$sql = "SELECT COUNT(usuario) FROM tbl_TecClientes WHERE status = 'BLOQUEADO'";
			$query = $conn->sql($sql);
			$saida = mysql_fetch_row($query);		
			break;
		case 'ATIVOS':
			$sql = "SELECT COUNT(usuario) FROM tbl_TecClientes WHERE status = 'ATIVO'";
			$query = $conn->sql($sql);
			$saida = mysql_fetch_row($query);		
			break;
		case 'CADASTRADOS':
			$sql = "SELECT COUNT(usuario) FROM tbl_TecClientes";
			$query = $conn->sql($sql);
			$saida = mysql_fetch_row($query);		
			break;
	}
	return($saida[0]);
}

function nSistema($filtra){
	include_once('ConexaoMySQL.php');
	$conn = new ConexaoMySQL();
	
	switch($filtra){
		case 'DOMINIOS':
			$sql = "SELECT COUNT(dominio) FROM tbl_pop";
			$query = $conn->sql($sql);
			$saida = mysql_fetch_row($query);		
			break;
		case 'ACCESSPOINT':
			$sql = "SELECT COUNT(accesspoint) FROM tbl_ap";
			$query = $conn->sql($sql);
			$saida = mysql_fetch_row($query);		
			break;
	}
	return($saida[0]);
}

function nivelPagina(){
	include_once('ConexaoMySQL.php');
	$conn = new ConexaoMySQL();

	$pagina = explode("/", $_SERVER['REQUEST_URI']);
	$pagina = explode("&", $pagina[1]);
	
	$sql = "SELECT nivel FROM tbl_paginas WHERE pagina LIKE '".$pagina[0]."%'";
	$query = $conn->sql($sql);
	
	$nivelPagina = mysql_fetch_array($query);
	
	return(intval($nivelPagina[0]));
}
function verificaNivel(){
	$nivelUsuario = $_SESSION['nivel'];
	$nivelPagina = nivelPagina();
	
	$pagina = explode("/", $_SERVER['REQUEST_URI']);
	
	if(intval($nivelPagina) < intval($nivelUsuario)){
		echo "<meta http-equiv=\"Refresh\" content=\"0;URL=/home.php?msg=10&pagSemAcesso=".$pagina[1]."\" />";
		exit();
	}
}

function anexa($mod){

	switch($mod){
		case 'adm':
			$pagina = "adm/index.php";
			break;
		case 'adm_pagina':
			$pagina = "adm/pagina.php";
			break;
		case 'adm_roteador':
			$pagina = "adm/roteador.php";
			break;
		case 'adm_banda':
			$pagina = "adm/banda.php";
			break;
		case 'adm_accesspoint':
			$pagina = "adm/accesspoint.php";
			break;
		case 'adm_usuario':
			$pagina = "adm/usuario.php";
			break;
		case 'cli':
			$pagina = "clientes/index.php";
			break;
		case 'cli_novo':
			$pagina = "clientes/novo.php";
			break;
		case 'cli_ativar':
			$pagina = "clientes/ativar.php";
			break;
		case 'cli_buscar':
			$pagina = "clientes/buscar.php";
			break;
		case 'cli_excluidos':
			$pagina = "clientes/excluidos.php";
			break;
		case 'eqpto':
			$pagina = "equipamentos/index.php";
			break;
		case 'eqpto_novo':
			$pagina = "equipamentos/novo.php";
			break;
		case 'eqpto_buscar':
			$pagina = "equipamentos/buscar.php";
			break;
		case 'eqpto_editar':
			$pagina = "equipamentos/editar.php";
			break;
		case 'log_autenticacao':
			$pagina = "log/autenticacao.php";
			break;
		default:
			$pagina = "home.php";
	}
	include_once($pagina);
}

function listaPop(){
	include_once('ConexaoMySQL.php');
	$conn = new ConexaoMySQL();
	$sql = "SELECT * FROM tbl_pop ORDER BY dominio";
	
	$query = $conn->sql($sql);
	echo "<UL TYPE='circle'>";
	while($dados = mysql_fetch_array($query)){
		echo "<LI><A HREF='?mod=adm_roteador&id=".$dados['id']."'>".$dados['dominio']." [".$dados['ip']."]</A></LI>";
	}
	echo "</UL>";
}


function listaBanda(){
	include_once('ConexaoMySQL.php');
	$conn = new ConexaoMySQL();
	$sql = "SELECT * FROM tbl_banda ORDER BY band_plano";
	
	$query = $conn->sql($sql);
	
	echo "<UL TYPE='circle'>";
	while($dados = mysql_fetch_array($query)){
		echo "<LI><A HREF='?mod=adm_banda&id=".$dados['band_id']."'>".$dados['band_plano']." [".$dados['band_configuracao']."]</A></LI>";
	}
	echo "</UL>";
}

function listaAccessPoints(){
	include_once('ConexaoMySQL.php');
	$conn = new ConexaoMySQL();
	$sql = "SELECT * FROM tbl_ap ORDER BY accesspoint";
	
	$query = $conn->sql($sql);
	
	echo "<UL TYPE='circle'>";
	while($dados = mysql_fetch_array($query)){
		echo "<LI><A HREF='?mod=adm_accesspoint&id=".$dados['id']."'>".$dados['accesspoint']." [".$dados['estacao']."]</A></LI>";
	}
	echo "</UL>";
}

function preencheCombo($name, $id, $config, $selected){
	include_once('ConexaoMySQL.php');
	$conn = new ConexaoMySQL();

	$saida = "<SELECT name='".$name."' ID='".$id."' ".$config['adicional'].">";
	$i = 0;
	
	$tabela = $config['tabela'];
	$value = $config['value'];
	$view = $config['view'];
	$condicao = $config['condicao'];
	
	$sql = "SELECT ".$value." AS value, ".$view." AS view FROM ".$tabela;
	if($condicao != ''){
		$sql .= " WHERE ".$condicao;
	}
	$sql .= " ORDER BY ".$view;
	$query = $conn->sql($sql);	

	if($config['linhasBranco'] > 0) { $saida .= "<OPTION></OPTION>"; }

	while($valores = mysql_fetch_array($query)){
		$saida .= "<OPTION VALUE='".$valores['value']."'";
		if($valores['value'] == $selected) { $saida .= " SELECTED "; }
		$saida .= ">".$valores['view']."</OPTION>";
	}
	$saida .= "</SELECT>";
	return($saida);
}

function exibeEstacao($id){
	include_once('ConexaoMySQL.php');
	$conn = new ConexaoMySQL();
	
	$sql = "SELECT pop FROM tbl_pop WHERE id = ".intval($id);
	$query = $conn->sql($sql);
	
	$estacao = mysql_fetch_row($query);
	
	return($estacao[0]);
}

function listaUsuarios(){
	include_once('ConexaoMySQL.php');
	$conn = new ConexaoMySQL();
	$sql = "SELECT * FROM tbl_usuario ORDER BY login";
	
	$query = $conn->sql($sql);
	
	echo "<UL TYPE='circle'>";
	while($dados = mysql_fetch_array($query)){
		if($dados['status'] == 'REMOVIDO') { $configCss = ' class="usuarioBloqueado"';}
		echo "<LI><SPAN".$configCss."><A HREF='?mod=adm_usuario&id=".$dados['id']."'>".$dados['nome']." [".$dados['login']."]</A></SPAN></LI>";
	}
	echo "</UL>";
}

function listaAtivacoesPendentes(){
	include_once('ConexaoMySQL.php');
	$conn = new ConexaoMySQL();
	$sql = "SELECT * FROM tbl_ativacao ORDER BY nome";
	
	$query = $conn->sql($sql);
	
	echo "<UL TYPE='circle'>";
	while($dados = mysql_fetch_array($query)){
		echo "<LI><A HREF='?mod=cli_ativar&id=".$dados['id']."'>".$dados['nome']." [".$dados['usuario']."]</A></LI>";
	}
	echo "</UL>";
}

function formataArray($array){
		echo "<FONT FACE='Verdana' SIZE='3' COLOR='#0000FF'>";
		echo "<PRE>";
		print_r($array);
		echo "</PRE>";
		echo "</FONT>";
}

function mostraEqpto($id){
	include_once('ConexaoMySQL.php');
	$conn = new ConexaoMySQL();
	$sql = "SELECT * FROM tbl_equipamento WHERE eqpto_id = ".$id;
	$query = $conn->sql($sql);
	
	$dados = mysql_fetch_array($query);

	echo "<div id='eqptoExterno'><a href='executar.php?mod=eqpto_editar&id=".$dados['eqpto_id']."'>[".$dados['eqpto_mac']."]<div id='eqptoInterno'>".$dados['eqpto_status']."/".$dados['eqpto_situacao']."</a></div></div>";
}

function getIdPop($pop){
	include_once('ConexaoMySQL.php');
	$conn = new ConexaoMySQL();
	$sql = "SELECT id FROM tbl_pop WHERE pop = '".$pop."'";
	$query = $conn->sql($sql);
	
	$dados = mysql_fetch_array($query);
	$id = $dados[0];
	return($id);
}


function getAtivacao($id){
	include_once('ConexaoMySQL.php');
	$conn = new ConexaoMySQL();
	
	$sql = "SELECT * FROM tbl_ativacao WHERE id = ".intval($id);
	$query = $conn->sql($sql);
	
	$cliente =  mysql_fetch_array($query);
	return($cliente);
}

function getPop($id){
	include_once('ConexaoMySQL.php');
	$conn = new ConexaoMySQL();
	
	$sql = "SELECT * FROM tbl_pop WHERE id = ".intval($id);
	$query = $conn->sql($sql);
	
	$pop =  mysql_fetch_array($query);
	return($pop);
}
function getAp($id){
	include_once('ConexaoMySQL.php');
	$conn = new ConexaoMySQL();
	
	$sql = "SELECT * FROM tbl_ap WHERE id = ".intval($id);
	$query = $conn->sql($sql);
	
	$ap =  mysql_fetch_array($query);
	return($ap);
}

function getEqpto($mac){
	include_once('ConexaoMySQL.php');
	$conn = new ConexaoMySQL();
	
	$sql = "SELECT * FROM tbl_equipamento WHERE eqpto_mac = '".$mac."'";
	$query = $conn->sql($sql);
	
	$mac =  mysql_fetch_array($query);
	return($mac);	
}

function getCliente($id){
	include_once('ConexaoMySQL.php');
	$conn = new ConexaoMySQL();
	
	$sql = "SELECT * FROM tbl_TecClientes WHERE id = ".intval($id)."";
	$query = $conn->sql($sql);
	
	$cliente =  mysql_fetch_array($query);
	return($cliente);	
}


?>
