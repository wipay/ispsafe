
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>ISP-Save v<?php include('VERSION');?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="../css/estilo02.css" rel="stylesheet" type="text/css" />
        <meta http-equiv="refresh" content="1" />
</head>

	<body>
		<div class="espacoInterno">
		  <!-- ALTERAR A PARTIR DESTE PONTO -->
			<?php 
            $linhas = $_GET['linhas'];
            $palavra = $_GET['palavra'];
            $comando = "/usr/bin/tail ";
            
            if ($linhas == '') $linhas = "100";
            $comando .= "-".$linhas." /var/log/radius.log ";
            if ( $palavra != '' ) $comando .= " | grep '".$palavra."'";
            
            $lista = shell_exec($comando);
            echo nl2br($lista);
            
            ?>  			
            <!-- TERMINAÇÃO DA PARTE EDITÁVEL DA PÁGINA -->
          </div>
	</body>
</html>
