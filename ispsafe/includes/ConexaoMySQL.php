<?php
/* Arquivo gerado no EditPlus 2.31 */
/* Autor: Marcelo Divaldo Brake - marcelo@tiexpress.com.br */
/* ter�a-feira, 16 de outubro de 2007 */

//
Class ConexaoMySQL{
	////////////////Atributos da class//////////////////
	var $servidor="localhost";
	var $usuario="ispsafe";
	var $senha="1sps4f3-db";
	var $banco="ispsafe";
	var $query="";
	var $link="";

	////////////////Metodos da classe///////////////
	// Metodo Contrutor
	function ConexaoMySQL()
	{
		$this->conexao();
	}

	// Metodo conexao com o banco
	function conexao()
	{
		$this->link = mysql_pconnect($this-> servidor,$this->usuario,$this->senha);
		if (!$this->link) {
			die("Error na conexao. (cod. m001)");
		} elseif (!mysql_select_db($this->banco,$this->link)) {
			die("Error na conexao. (cod. m002)");
		}
	}

	// Metodo sql
	function sql($query)
	{
		$this->query = $query;
		if ($result = mysql_query($this->query,$this->link)) {
			return $result;
		} else {
			return 0;
		}
	}

	function conta($query)
	{
		$this->query = $query;
		$result = mysql_query($this->query,$this->link);
		$conta = mysql_num_rows($result);
		return $conta;
	}
	// Metodo que retorna o ultimo id de um inser��o
	function id()
	{
		return mysql_insert_id($this->link);
	}

	// Metodo fechar conexao
	function fechar()
	{
		return mysql_close($this->link);
	}
}
?>
