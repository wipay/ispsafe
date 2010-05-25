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

$colname_rsSinal = "-1";
if (isset($_GET['cliente'])) {
  $colname_rsSinal = $_GET['cliente'];
}
mysql_select_db($database_ConexaoMySQL, $ConexaoMySQL);
$query_rsSinal = sprintf("SELECT `data`, sinal FROM tbl_sinal WHERE cliente = %s AND data >= DATE_SUB(CURDATE(), INTERVAL 1 HOUR) ORDER BY `data` ASC", GetSQLValueString($colname_rsSinal, "int"));
$rsSinal = mysql_query($query_rsSinal, $ConexaoMySQL) or die(mysql_error());
$row_rsSinal = mysql_fetch_assoc($rsSinal);
$totalRows_rsSinal = mysql_num_rows($rsSinal);

# PHPlot Example: Bar chart, annual data
require_once 'phplot.php';

$data = array(array(), array());
$i = 0;
do {
      $data[$i][0] = $row_rsSinal['data'];
	  if ($row_rsSinal['sinal'] == 0)
	      $data[$i][1] = -95; //$row_rsSinal['sinal'];
	  else
	      $data[$i][1] =  $row_rsSinal['sinal'] * (-1) ;	  	
	  $i++;
    } while ($row_rsSinal = mysql_fetch_assoc($rsSinal)); 

$plot = new PHPlot(1000, 600);
$plot->SetImageBorderType('raised');

$plot->SetPlotType('bars');
$plot->SetDataType('text-data');
$plot->SetDataValues($data);

# Let's use a new color for these bars:
$plot->SetDataColors('green', 'black', 'red');

# Force bottom to Y=0 and set reasonable tick interval:
$plot->SetPlotAreaWorld(NULL, -95, NULL, -30);
$plot->SetYTickIncrement(2);
# Format the Y tick labels as numerics to get thousands separators:
$plot->SetYLabelType('data');
$plot->SetXLabelType('time');
//$plot->SetXDataLabelPos('both')
//$plot->SetDrawXDataLabelLines('data')
$plot->SetPrecisionY(0);

# Main plot title:
$plot->SetTitle('N�veis de Sinal');
# Y Axis title:
$plot->SetYTitle('dBm');

# Turn off X tick labels and ticks because they don't apply here:
$plot->SetXTickLabelPos('all');
$plot->SetXTickPos('both');

$plot->DrawGraph();

mysql_free_result($rsSinal);
?>
