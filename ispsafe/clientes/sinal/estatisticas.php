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
?><?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../inicial.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "1,2,3,4,5";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../inicial.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Sinal de <?php echo ucfirst($row_rsCliente['nome']); ?></title>
<meta http-equiv="refresh" content="60" />
<!-- InstanceEndEditable -->
<link href="../styles/estilo001.css" rel="stylesheet" type="text/css" />
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
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
<!--
.style2 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.style3 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style5 {font-size: 12px}
-->
</style>
<!-- InstanceEndEditable -->
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="15%" class="dingbat" scope="col"><a href="../novo_cadastro.php">novo cadastro</a></th>
    <th width="15%" class="dingbat" scope="col"><a href="../ativacoes_pendentes.php">ativar</a></th>
    <th width="15%" class="dingbat" scope="col"><a href="../usuarios.php">usuários</a></th>
    <th width="15%" class="dingbat" scope="col"><a href="../historico_acesso.php">histórico</a></th>
    <th width="15%" class="dingbat" scope="col"><a href="../logs.php">logs</a></th>
    <th width="15%" class="dingbat" scope="col"><div align="center"><?php if($_SESSION['MM_UserGroup'] <= 2) { ?><a href="../administrativo.php">administração</a><?php } ?></div></th>
    <th width="15%" class="dingbat" scope="col"><div align="center"><a href="<?php echo $logoutAction ?>">logout</a></div></th>
  </tr>
  <tr>
    <th colspan="7" scope="col"><!-- InstanceBeginEditable name="miolo" -->
    <!-- INICIO DO MIOLO DA PÁGINA  -->
    
    
	<!-- FINAL DO MIOLO DA PÁGINA -->
	<h2 align="center" class="style2"><img src="horario.php?cliente=<?php echo $row_rsCliente['id']; ?>&amp;nome=<?php echo ucfirst($row_rsCliente['nome']); ?>&amp;anterior=<?php echo $_GET['anterior']; ?>" alt="Gráfico de <?php echo ucfirst($row_rsCliente['nome']); ?>" border="0" align="absmiddle" /></h2>
	<div align="center">
	  <table width="100%">
          <tr>
            <td width="40%"><div align="center"><a href="estatisticas.php?cliente=<?php echo $row_rsCliente['id']; ?>&amp;anterior=<?php echo $_GET['anterior']+1; ?>"><strong>&lt;&lt;&lt;&lt;&lt;</strong></a></div></td>
            <td><div align="center"><a href="detalhes.php?cliente=<?php echo $row_rsCliente['id']; ?>" class="style3 style5">Tabela detalhada</a></div></td>
            <td width="40%"><div align="center"><a href="estatisticas.php?cliente=<?php echo $row_rsCliente['id']; ?>&amp;anterior=<?php echo $_GET['anterior']-1; ?>"><strong>&gt;&gt;&gt;&gt;&gt;</strong></a></div></td>
          </tr>
        </table>
    </div>
    <!-- InstanceEndEditable -->    </th>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsSinal);

mysql_free_result($rsCliente);
?>