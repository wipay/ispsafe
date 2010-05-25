<?php require_once('../../includes/ConexaoMySQL.php'); ?>
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

$maxRows_rsCliente = 1;
$pageNum_rsCliente = 0;
if (isset($_GET['pageNum_rsCliente'])) {
  $pageNum_rsCliente = $_GET['pageNum_rsCliente'];
}
$startRow_rsCliente = $pageNum_rsCliente * $maxRows_rsCliente;

$colname_rsCliente = "-1";
if (isset($_GET['cliente'])) {
  $colname_rsCliente = $_GET['cliente'];
}
mysql_select_db($database_ConexaoMySQL, $ConexaoMySQL);
$query_rsCliente = sprintf("SELECT * FROM tbl_TecClientes WHERE id = %s", GetSQLValueString($colname_rsCliente, "int"));
$query_limit_rsCliente = sprintf("%s LIMIT %d, %d", $query_rsCliente, $startRow_rsCliente, $maxRows_rsCliente);
$rsCliente = mysql_query($query_limit_rsCliente, $ConexaoMySQL) or die(mysql_error());
$row_rsCliente = mysql_fetch_assoc($rsCliente);

if (isset($_GET['totalRows_rsCliente'])) {
  $totalRows_rsCliente = $_GET['totalRows_rsCliente'];
} else {
  $all_rsCliente = mysql_query($query_rsCliente);
  $totalRows_rsCliente = mysql_num_rows($all_rsCliente);
}
$totalPages_rsCliente = ceil($totalRows_rsCliente/$maxRows_rsCliente)-1;

$maxRows_rsSinal = 1;
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
$query_rsSinal = sprintf("SELECT `data`, sinal FROM tbl_sinal WHERE cliente = %s AND data >= DATE_SUB(CURDATE(), INTERVAL 2 DAY) AND data <= DATE_SUB(CURDATE(), INTERVAL 1 DAY) ORDER BY `data`", GetSQLValueString($colname_rsSinal, "int"));
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
?><html>
<head>
<title>Sinal de <?php echo ucfirst($row_rsCliente['nome']); ?></title>
<style type="text/css">
<!--
.style2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.style3 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style5 {font-size: 12px}
-->
</style>
</head>
<body>
<h2 align="center" class="style2">Sinal de <?php echo ucfirst($row_rsCliente['nome']); ?></h2>
<div align="center">
<div align="center"><img src="horario.php?cliente=<?php echo $row_rsCliente['id']; ?>&nome=<?php echo ucfirst($row_rsCliente['nome']); ?>&anterior=<?php echo $_GET['anterior']; ?>">
  <br>
  <table width="100%">
<tr>
          <td width="40%"><div align="center"><a href="grafico.php?cliente=<?php echo $row_rsCliente['id']; ?>&anterior=<?php echo $_GET['anterior']+1; ?>"><strong><<<<<</strong></a></div></td>
          <td><div align="center"><a href="tabela.php?cliente=<?php echo $row_rsCliente['id']; ?>" class="style3 style5">Tabela detalhada</a></div></td>
          <td width="40%"><div align="center"><a href="grafico.php?cliente=<?php echo $row_rsCliente['id']; ?>&anterior=<?php echo $_GET['anterior']-1; ?>"><strong>>>>>></strong></a></div></td>
    </tr>
  </table>
</div>
</body>
</html>
<?php
mysql_free_result($rsCliente);

mysql_free_result($rsSinal);
?>


