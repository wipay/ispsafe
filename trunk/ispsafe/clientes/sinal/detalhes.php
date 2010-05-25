<?php
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
?><?php require_once('../../includes/ConexaoMySQL.php'); ?><?php require('../../includes/funcoes.php'); ?>
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
<title>Principal</title>
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
.style10 {	color: #CCCCCC;
	font: bold;
}
.style8 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style9 {	color: #CCCCCC;
	font: bold;
}
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
    
    
	<!-- FINAL DO MIOLO DA PÁGINA --><div align="center"><span class="legal">Sinal detalhado de <?php echo htmlentities(ucfirst($row_rsCliente['nome'])); ?> (<?php echo strtolower($row_rsCliente['usuario']); ?>)</span><br />
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
        <td bgcolor="#333333" class="sidebarHeader"><div align="center" class="style9"><span class="style8">data</span></div></td>
        <td bgcolor="#333333" class="sidebarHeader"><div align="center" class="style10"><span class="style8">sinal</span></div></td>
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
	} else {
		$cor_td = "";
	}	
	if ($row_rsSinal['sinal'] == 0) {
		$row_rsSinal['sinal'] = "Sem Sinal";
		$cor_td = ""; 
	} else {
		$row_rsSinal['sinal'] = "-".$row_rsSinal['sinal']."dBm";
	}
  ?>
      <tr <?php echo $style; ?>>
        <td><div align="center"><span class="legal"><?php echo ConverteData($row_rsSinal['data']); ?></span></div></td>
        <td <?php echo $cor_td; ?>><div align="center"><span class="legal"><?php echo $row_rsSinal['sinal']; ?></span></div></td>
      </tr>
      <?php } while ($row_rsSinal = mysql_fetch_assoc($rsSinal)); ?>
    </table>
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
    <!-- InstanceEndEditable -->    </th>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsCliente);

mysql_free_result($rsSinal);
?>