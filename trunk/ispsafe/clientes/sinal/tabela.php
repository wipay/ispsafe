<?php require_once('../../includes/ConexaoMySQL.php'); ?><?php require('../../includes/funcoes.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

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
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsSinal = 50;
$pageNum_rsSinal = 0;
if (isset($_GET['pageNum_rsSinal'])) {
  $pageNum_rsSinal = $_GET['pageNum_rsSinal'];
}
$startRow_rsSinal = $pageNum_rsSinal * $maxRows_rsSinal;

$colname_rsSinal = "-1";
if (isset($_GET['cliente'])) {
  $colname_rsSinal = $_GET['cliente'];
}
mysql_select_db($database_ConexaoMySQL, $ConexaoMySQL);
$query_rsSinal = sprintf("SELECT `data`, sinal FROM tbl_sinal WHERE cliente = %s ORDER BY `data` DESC", GetSQLValueString($colname_rsSinal, "int"));
$query_limit_rsSinal = sprintf("%s LIMIT %d, %d", $query_rsSinal, $startRow_rsSinal, $maxRows_rsSinal);
$rsSinal = mysql_query($query_limit_rsSinal, $ConexaoMySQL) or die(mysql_error());
$row_rsSinal = mysql_fetch_assoc($rsSinal);

if (isset($_GET['totalRows_rsSinal'])) {
  $totalRows_rsSinal = $_GET['totalRows_rsSinal'];
} else {
  $all_rsSinal = mysql_query($query_rsSinal);
  $totalRows_rsSinal = mysql_num_rows($all_rsSinal);
}
$totalPages_rsSinal = ceil($totalRows_rsSinal/$maxRows_rsSinal)-1;

$colname_rsCliente = "-1";
if (isset($_GET['cliente'])) {
  $colname_rsCliente = $_GET['cliente'];
}
mysql_select_db($database_ConexaoMySQL, $ConexaoMySQL);
$query_rsCliente = sprintf("SELECT * FROM tbl_TecClientes WHERE id = %s", GetSQLValueString($colname_rsCliente, "int"));
$rsCliente = mysql_query($query_rsCliente, $ConexaoMySQL) or die(mysql_error());
$row_rsCliente = mysql_fetch_assoc($rsCliente);
$totalRows_rsCliente = mysql_num_rows($rsCliente);

$queryString_rsSinal = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsSinal") == false && 
        stristr($param, "totalRows_rsSinal") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsSinal = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsSinal = sprintf("&totalRows_rsSinal=%d%s", $totalRows_rsSinal, $queryString_rsSinal);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Nivel de Sinal detalhado</title>
<style type="text/css">
<!--
.style8 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style9 {
	color: #CCCCCC;
	font: bold;
}
.style10 {
	color: #CCCCCC;
	font: bold;
}
.style12 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 16px;
}
-->
</style>
</head>

<body>
















<div align="center"><span class="style12">Sinal detalhado de <?php echo ucfirst($row_rsCliente['nome']); ?> (<?php echo strtolower($row_rsCliente['usuario']); ?>)</span><br />
</div>
<table width="50%" border="0" align="center">
  <tr>
    <td width="25%"><div align="center">
      <?php if ($pageNum_rsSinal > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_rsSinal=%d%s", $currentPage, 0, $queryString_rsSinal); ?>"><img src="First.gif" alt="Primeiro" border="0" /></a>
      <?php } // Show if not first page ?>
    </div></td>
    <td width="25%"><div align="center">
      <?php if ($pageNum_rsSinal > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_rsSinal=%d%s", $currentPage, max(0, $pageNum_rsSinal - 1), $queryString_rsSinal); ?>"><img src="Previous.gif" alt="Anterior" border="0" /></a>
      <?php } // Show if not first page ?>
    </div></td>
    <td width="25%"><div align="center">
      <?php if ($pageNum_rsSinal < $totalPages_rsSinal) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_rsSinal=%d%s", $currentPage, min($totalPages_rsSinal, $pageNum_rsSinal + 1), $queryString_rsSinal); ?>"><img src="Next.gif" alt="Proximo" border="0" /></a>
      <?php } // Show if not last page ?>
    </div></td>
    <td width="25%"><div align="center">
      <?php if ($pageNum_rsSinal < $totalPages_rsSinal) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_rsSinal=%d%s", $currentPage, $totalPages_rsSinal, $queryString_rsSinal); ?>"><img src="Last.gif" alt="Ultimo" border="0" /></a>
      <?php } // Show if not last page ?>
    </div></td>
  </tr>
</table>
<table width="50%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <td bgcolor="#333333"><div align="center" class="style9"><span class="style8">data</span></div></td>
    <td bgcolor="#333333"><div align="center" class="style10"><span class="style8">sinal</span></div></td>
  </tr>
  <?php do { ?>
  <?php 
  	if (empty($style)){
		$style = "bgcolor = \"#F0F0F0\"";
	} else {
		$style = 0;
	}	
	if($row_rsSinal['sinal'] > 65 ) { 
		$cor_td = " bgcolor = \"#FFC0C0\""; 
	}	
	if ($row_rsSinal['sinal'] == 0) {
		$row_rsSinal['sinal'] = "Sem Sinal";
		$cor_td = ""; 
	} else {
		$row_rsSinal['sinal'] = "-".$row_rsSinal['sinal']."dBm";
	}
  ?>
  <tr <?php echo $style; ?>>
    <td><div align="center"><span class="style8"><?php echo ConverteData($row_rsSinal['data']); ?></span></div></td>
    <td <?php echo $cor_td; ?>><div align="center"><span class="style8"><?php echo $row_rsSinal['sinal']; ?></span></div></td>
  </tr>
  <?php } while ($row_rsSinal = mysql_fetch_assoc($rsSinal)); ?>
</table>
<table width="50%" border="0" align="center">
  <tr>
    <td width="25%"><div align="center">
      <?php if ($pageNum_rsSinal > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_rsSinal=%d%s", $currentPage, 0, $queryString_rsSinal); ?>"><img src="First.gif" border="0" /></a>
    <?php } // Show if not first page ?></div></td>
    <td width="25%"><div align="center">
      <?php if ($pageNum_rsSinal > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_rsSinal=%d%s", $currentPage, max(0, $pageNum_rsSinal - 1), $queryString_rsSinal); ?>"><img src="Previous.gif" border="0" /></a>
      <?php } // Show if not first page ?>
    </div></td>
    <td width="25%"><div align="center"><?php if ($pageNum_rsSinal < $totalPages_rsSinal) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_rsSinal=%d%s", $currentPage, min($totalPages_rsSinal, $pageNum_rsSinal + 1), $queryString_rsSinal); ?>"><img src="Next.gif" border="0" /></a>
      <?php } // Show if not last page ?>
    </div></td>
    <td width="25%"><div align="center">
      <?php if ($pageNum_rsSinal < $totalPages_rsSinal) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_rsSinal=%d%s", $currentPage, $totalPages_rsSinal, $queryString_rsSinal); ?>"><img src="Last.gif" border="0" /></a>
      <?php } // Show if not last page ?>
    </div></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($rsSinal);

mysql_free_result($rsCliente);
?>
