<?php require_once('../../includes/ConexaoMySQL.php'); ?>
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

mysql_select_db($database_ConexaoMySQL, $ConexaoMySQL);
$query_rsRadios = "SELECT * FROM tbl_ap WHERE accesspoint NOT LIKE \"%Rede%\" ORDER BY accesspoint ASC";
$rsRadios = mysql_query($query_rsRadios, $ConexaoMySQL) or die(mysql_error());
$row_rsRadios = mysql_fetch_assoc($rsRadios);
$totalRows_rsRadios = mysql_num_rows($rsRadios);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
<link href="../styles/estilo001.css" rel="stylesheet" type="text/css" />
<link href="../user/css/estilo01.css" rel="stylesheet" type="text/css" />
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" id="alterarSenha">
  <?php do { ?>
  <tr>
    <td><a href="miolo.php?radio=<?php echo $row_rsRadios['id']; ?>" target="mainFrame"><?php echo $row_rsRadios['estacao'].": ".$row_rsRadios['accesspoint']; ?></a></td>
  </tr>
  <?php } while ($row_rsRadios = mysql_fetch_assoc($rsRadios)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($rsRadios);
?>
