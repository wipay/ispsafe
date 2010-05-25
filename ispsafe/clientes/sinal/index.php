<?php
	include_once("includes/funcoes.php");
	include_once("includes/ConexaoMySQL.php");

	verifica();
	
	
		$cliente = getCliente($_GET['id']);
		$ap = getAp($cliente['ap']);
		$ipAp=$ap['ip'];
		$community = $ap['snmp'];
		$mac_separado = explode(":", $cliente['mac']);
		$macdec=hexdec($mac_separado['0']).".".hexdec($mac_separado['1']).".".hexdec($mac_separado['2']).".".hexdec($mac_separado['3']).".".hexdec($mac_separado['4']).".".hexdec($mac_separado['5']);


		$sinal = exec('/usr/local/bin/snmpwalk  -Os -c '.$community.' -v 1 '.$ipAp.' .1.3.6.1.4.1.14988.1.1.1.2.1.3.'.$macdec);
		$sinalfinal = explode("=",$sinal);
		$sinalAbsoluto=100-abs($sinalfinal[1]);
		
		if($sinalAbsoluto == 100) {
			$bgcolor = "#999999";
			$saida = "&oslash;";
		} elseif($sinalAbsoluto < 65) {
			$saida = $sinalfinal[1]." dBm";
			$bgcolor = "#FF0000";
		} else {
			$saida = $sinalfinal[1]." dBm";
			$bgcolor = "#00FF00";
		}

?><?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>ISP-Save v<?php include('../../VERSION');?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="../../css/estilo02.css" rel="stylesheet" type="text/css" />
        <meta http-equiv="refresh" content="1" />

     <?php verificaNivel(); ?>
</head>

	<body>
<table width="200" border="0" align="center" cellpadding="0" cellspacing="0" class="medidorSinal">
  <tr>
    <td width="<?php echo $sinalAbsoluto;?>%" bgcolor="#999999">
    	<table width="160" border="0" cellspacing="0" cellpadding="0">
	  		<tr>
   				<td width="<?php echo $sinalAbsoluto;?>%" bgcolor="<?php echo $bgcolor; ?>">&nbsp;</td>
   			  <td bgcolor="#999999"><img src="../../images/16x16.gif" alt="sinal" />&nbsp;</td>
		  </tr>
		</table></td>
    <td>&nbsp;&nbsp;<?php echo $saida; ?>&nbsp;<br />
</td>
  </tr>
</table>

</body>
</html>