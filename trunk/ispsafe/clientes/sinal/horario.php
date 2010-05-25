<?php require_once('includes/ConexaoMySQL.php'); ?>
<?php require_once('includes/funcoes.php'); ?>
<?php

$ConexaoMySQL = new ConexaoMySQL(); 

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


  $codigo_rsSinal = $_GET['id'];
  $anterior_rsSinal = -1;

$query_rsSinal = "SELECT `data`, sinal FROM tbl_sinal WHERE cliente = ".$codigo_rsSinal." AND data >= DATE_SUB(curdate(), INTERVAL '".$anterior_rsSinal."' + 1 DAY) AND data <= DATE_SUB(curdate(), INTERVAL '".$anterior_rsSinal."' DAY) ORDER BY `data`";

$rsSinal = $ConexaoMySQL->sql($query_rsSinal);
$row_rsSinal = mysql_fetch_assoc($rsSinal);
$totalRows_rsSinal = mysql_num_rows($rsSinal);

$query_rsMedia = "SELECT AVG(sinal) MEDIA FROM tbl_sinal WHERE cliente = ".$codigo_rsSinal." AND sinal != 0 AND data >= DATE_SUB(curdate(), INTERVAL '".$anterior_rsSinal."' + 1 DAY) AND data <= DATE_SUB(curdate(), INTERVAL '".$anterior_rsSinal."' DAY)";


$rsMedia = $ConexaoMySQL->sql($query_rsMedia);
$row_rsMedia = mysql_fetch_assoc($rsMedia);
$totalRows_rsMedia = mysql_num_rows($rsMedia);

# PHPlot Example: Bar chart, annual data
require_once 'phplot.php';

$data = array(array(), array());
$inicial = ConverteData($row_rsSinal['data']);
$i = 0;
do {
      $data[$i][0] = $row_rsSinal['data'];
	  if ($row_rsSinal['sinal'] == 0)
	      $data[$i][1] = -100; //$row_rsSinal['sinal'];
	  else
	      $data[$i][1] =  $row_rsSinal['sinal'] * (-1) ;	  	
	  $i++;
	  $final = ConverteData($row_rsSinal['data']);
    } while ($row_rsSinal = mysql_fetch_assoc($rsSinal)); 

$plot = new PHPlot(900, 500);
$plot->SetImageBorderType('raised');

$plot->SetPlotType('bars');
$plot->SetDataType('text-data');
$plot->SetDataValues($data);

# Let's use a new color for these bars:
if($row_rsMedia['MEDIA'] <= 65 ){
	$plot->SetDataColors('green', 'black', 'red');
} else {
	$plot->SetDataColors('red', 'black', 'red');
}

$plot->SetPlotAreaWorld(0, -100, 144, -30);
$plot->SetYTickIncrement(2);
//$plot->SetXTickIncrement(5);
$plot->SetYLabelType('data');
$plot->SetXLabelType('time');
$plot->SetXTimeFormat('%H:%M');
$plot->SetNumXTicks(24);
//$plot->SetXScaleType('log');
$plot->SetXDataLabelPos('none');
$plot->SetYDataLabelPos('both'); 
$plot->SetDrawXDataLabelLines('both');
$plot->SetPrecisionY(0);
//$plot->SetPrecisionX(2);

# Main plot title:
$plot->SetTitle('Sinal de '.$_GET['nome'].' - Media: -'.$row_rsMedia['MEDIA']." dBm");
# Y Axis title:
$plot->SetYTitle('dBm');
$plot->SetXTitle('Sinal de '.$inicial.' a '.$final.' (intervalo de 10min)');

# Turn off X tick labels and ticks because they don't apply here:
$plot->SetXTickLabelPos('all');
$plot->SetXTickPos('both');


$plot->DrawGraph();

mysql_free_result($rsSinal);

mysql_free_result($rsMedia);
?>

