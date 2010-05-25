<?php
	
	switch($_GET['mod']){
		case 'adm_roteador':
			include_once('adm/roteador.php');
			break;	
		case 'adm_banda':
			include_once('adm/banda.php');
			break;	
		case 'adm_accesspoint':
			include_once('adm/accesspoint.php');
			break;	
		case 'adm_usuario':
			include_once('adm/usuario.php');
			break;	
		case 'adm_pagina':
			include_once('adm/pagina.php');
			break;	
		case 'cli_novo':
			include_once('clientes/novo.php');
			break;	
		case 'cli_ativar':
			include_once('clientes/ativar.php');
			break;	
		case 'cli_buscar':
			include_once('clientes/buscar.php');
			break;	
		case 'cli_ativacao':
			include_once('clientes/ativado.php');
			break;	
		case 'cli_buscaOk':
			include_once('clientes/lista.php');
			break;	
		case 'cli_editar':
			include_once('clientes/editar.php');
			break;	
		case 'cli_sinal':
			include_once('clientes/sinal/index.php');
			break;	
		case 'cli_autenticado':
			include_once('clientes/autenticado.php');
			break;	
		case 'eqpto_novo':
			include_once('equipamentos/novo.php');
			break;	
		case 'eqpto_buscar':
			include_once('equipamentos/buscar.php');
			break;	
		case 'eqpto_editar':
			include_once('equipamentos/editar.php');
			break;	
		case 'cli_estatisticas':
			include_once('clientes/sinal/horario.php');
			break;	
		default:
			header('Location: home.php');
	}
?>
