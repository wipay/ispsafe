<?php require_once('includes/ConexaoMySQL.php'); ?><?php
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
	
  $logoutGoTo = "inicial.php";
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

$MM_restrictGoTo = "inicial.php";
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
?>
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

mysql_select_db($database_ConexaoMySQL, $ConexaoMySQL);
$query_rsAtivacao = "SELECT loginFinanceiro, usuario, banda, nome FROM tbl_ativacao";
$rsAtivacao = mysql_query($query_rsAtivacao, $ConexaoMySQL) or die(mysql_error());
$row_rsAtivacao = mysql_fetch_assoc($rsAtivacao);
$totalRows_rsAtivacao = mysql_num_rows($rsAtivacao);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Principal</title>
<!-- InstanceEndEditable -->
<link href="styles/estilo001.css" rel="stylesheet" type="text/css" />
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
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="15%" class="dingbat" scope="col"><a href="novo_cadastro.php">novo cadastro</a></th>
    <th width="15%" class="dingbat" scope="col"><a href="ativacoes_pendentes.php">ativar</a></th>
    <th width="15%" class="dingbat" scope="col"><a href="usuarios.php">usuários</a></th>
    <th width="15%" class="dingbat" scope="col"><a href="historico_acesso.php">histórico</a></th>
    <th width="15%" class="dingbat" scope="col"><a href="logs.php">logs</a></th>
    <th width="15%" class="dingbat" scope="col"><div align="center"><?php if($_SESSION['MM_UserGroup'] <= 2) { ?><a href="administrativo.php">administração</a><?php } ?></div></th>
    <th width="15%" class="dingbat" scope="col"><div align="center"><a href="<?php echo $logoutAction ?>">logout</a></div></th>
  </tr>
  <tr>
    <th colspan="7" scope="col"><!-- InstanceBeginEditable name="miolo" -->
    <!-- INICIO DO MIOLO DA PÁGINA -->
    
        <table width="100%" border="2" cellspacing="0" cellpadding="0">
         <tr>
            <td>
   				<table width="100%" border="1" align="left" cellpadding="0" cellspacing="0" class="legal">
        			<tr>
            			<td width="10%"><div align="left" class="sidebarHeader">usuário</div></td>
          				<td width="10%"><div align="left" class="sidebarHeader">financeiro</div></td>
          				<td width="75%"><div align="left" class="sidebarHeader">nome</div></td>
        			 	<td width="5%" class="sidebarHeader"></td>
			    </tr>

      			<?php do { ?>
        			<tr>
            		  <td><div align="left" class="sidebar"><?php echo $row_rsAtivacao['usuario']; ?></div></td>
       				  <td><div align="left" class="sidebar"><?php echo $row_rsAtivacao['loginFinanceiro']; ?></div></td>
       				  <td><div align="left" class="sidebar"><?php echo $row_rsAtivacao['nome']; ?></div></td>
       			 	  <td><a href="ativar_cliente.php" class="sidebar">ATIVAR</a></td>
			    </tr>
        			<?php } while ($row_rsAtivacao = mysql_fetch_assoc($rsAtivacao)); ?>
   			  </table>
		    </td>
        </tr>
    </table>
	<!-- FINAL DO MIOLO DA PÁGINA --><!-- InstanceEndEditable -->    </th>
   </tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsAtivacao);
?>
