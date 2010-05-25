<?php require_once('../../../includes/ConexaoMySQL.php'); ?>
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

$colname_rsCliente = "-1";
if (isset($_GET['cliente'])) {
  $colname_rsCliente = $_GET['cliente'];
}
mysql_select_db($database_ConexaoMySQL, $ConexaoMySQL);
$query_rsCliente = sprintf("SELECT * FROM tbl_TecClientes WHERE id = %s", GetSQLValueString($colname_rsCliente, "int"));
$rsCliente = mysql_query($query_rsCliente, $ConexaoMySQL) or die(mysql_error());
$row_rsCliente = mysql_fetch_assoc($rsCliente);
$totalRows_rsCliente = mysql_num_rows($rsCliente);
?><html>
<head>
<title>Sinal de <?php echo ucfirst($row_rsCliente['nome']); ?></title>
</head>
<body>
<h1 align="center">Sinal de <?php echo ucfirst($row_rsCliente['nome']); ?></h1>
<div align="center"><img src="simpleplot.php?cliente=<?php echo $row_rsCliente['id']; ?>">
</div>
</body>
</html>
<?php
mysql_free_result($rsCliente);
?>


