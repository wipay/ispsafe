<?php
/**
*****************************
** Arquivo gerado no EditPlus v2.31
** Marcelo Divaldo Brake
** marcelo@tiexpress.com.br
** Todos os direitos s�o reservados.
*******************************/

//
// TODO: 
//

	include_once('/home/marcelo/public_html/ispsafe/2.2/includes/ConexaoMySQL.php');
	include_once('/home/marcelo/public_html/ispsafe/2.2/includes/funcoes.php');

	$conn = new ConexaoMySQL();


	$sql_todos = "SELECT id, mac, pop, ap FROM tbl_TecClientes;";
	$array_todos = $conn->sql($sql_todos);

	while ($campos = MySQL_Fetch_Array($array_todos)){
		
		if($campos['mac']){
			$mac_separado = explode(":", $campos['mac']);
			$macdec=hexdec($mac_separado['0']).".".hexdec($mac_separado['1']).".".hexdec($mac_separado['2']).".".hexdec($mac_separado['3']).".".hexdec($mac_separado['4']).".".hexdec($mac_separado['5']);
			if($campos['ap']!='') {
				$sql_snmp = "SELECT * FROM tbl_ap WHERE id = '".$campos['ap']."'";
			} else {
				$sql_snmp = "SELECT * FROM tbl_ap WHERE estacao = '".$campos['pop']."'";
			}		
			$array_snmp = $conn->sql($sql_snmp);
			$snmp = MySQL_Fetch_Array($array_snmp);
			$sinal = exec('/usr/local/bin/snmpwalk  -Os -c '.$snmp['snmp'].' -v 1 '.$snmp['ip'].' .1.3.6.1.4.1.14988.1.1.1.2.1.3.'.$macdec);
			$sinalfinal = explode("INTEGER:",$sinal);
			$sinalAbsoluto=abs($sinalfinal['1']);
			
			$sql_salvaSinal = "INSERT INTO tbl_sinal(cliente, data, sinal) VALUES (".$campos['id'].", NOW(), ".$sinalAbsoluto.")";
			$salvaSinal = $conn->sql($sql_salvaSinal);

			echo $salvaSinal;
		}
		
	}


?>
