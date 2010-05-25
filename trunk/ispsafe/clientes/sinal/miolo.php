<?php require_once('../../includes/ConexaoMySQL.php'); ?>
<?php include("../../includes/funcoes.php"); ?>

<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_rsRadio = "-1";
if (isset($_GET['radio'])) {
  $colname_rsRadio = $_GET['radio'];
}
mysql_select_db($database_ConexaoMySQL, $ConexaoMySQL);
$query_rsRadio = sprintf("SELECT * FROM tbl_ap WHERE id = %s", GetSQLValueString($colname_rsRadio, "int"));
$rsRadio = mysql_query($query_rsRadio, $ConexaoMySQL) or die(mysql_error());
$row_rsRadio = mysql_fetch_assoc($rsRadio);
$totalRows_rsRadio = mysql_num_rows($rsRadio);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="<?php echo $_GET['tempo']; ?>" />

<title>Sistema de Gestão Wireless</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<link href="../user/css/estilo01.css" rel="stylesheet" type="text/css" />
</head>

<body>
<hr/>
<FORM ACTION="" METHOD="GET" TARGET="_self">
  Atualizar a cada
  
<INPUT NAME="tempo" TYPE="text" value="<?php echo $_GET['tempo']; ?>" SIZE="4" /> segundos <INPUT NAME="" TYPE="submit" VALUE="OK" /></FORM>
<?php 		
	$accesspoints = shell_exec('/usr/local/bin/snmpwalk  -Os -c '.$row_rsRadio['snmp'].' -v 1 '.$row_rsRadio['ip'].' .1.3.6.1.4.1.14988.1.1.1.3.1.4');
	$sinal = shell_exec('/usr/local/bin/snmpwalk  -Os -c '.$row_rsRadio['snmp'].' -v 1 '.$row_rsRadio['ip'].' .1.3.6.1.4.1.14988.1.1.1.2.1.3');
	
	$i = 0;
	$xpto = explode("enterprises.14988.1.1.1.3.1.4",$accesspoints);
	do {
		$ap = explode("STRING: \"",$xpto[$i]);
		$tamanho = strlen($ap[1]);
		$a = substr_replace($ap[1], '', -1, $tamanho-1);
		$array_ap = array($i => substr_replace($a, '', -1, $tamanho-1));
		echo substr_replace($a, '', -1, $tamanho-1)."<br/>";
		$i++;
	}while($i <= count($xpto));

	print_r($array_ap);
	echo "<hr/>";
	
	$i = 1;
	$asinal = explode("enterprises.14988.1.1.1.2.1.3.",$sinal);
	do {
		$x = $asinal[$i];
		$b = explode(" = INTEGER: ", $x);
		echo grafico($b[1], mostraNomeMac($b[0]));
		$i++;
	}while($i < count($asinal));	
	echo "<hr/>";
?>
</body>
</html>
<?php
mysql_free_result($rsRadio);
?>
