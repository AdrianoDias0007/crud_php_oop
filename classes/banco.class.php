<?php
abstract class banco{
	//Propiredades
	public $servidor		= "localhost";
	public $usuario			= "root";
	public $senha			= "";
	public $nomedobanco		= "raca";
	public $conexao			= Null;
	public $dataset			= NULL;
	public $linhasafetadas 	= -1;
	
	//Metodos
	public function __construct(){
		$this->conecta();
	}//construct
	
	public function __destruct(){
		if ($this->conexao != NULL):
			mysql_close($this->conexao);
		endif;
	}//destruct
	
	public function  conecta()
	{
		$this->conexao = mysql_connect($this->servidor,$this->usuario,$this->senha,TRUE)
		or die ($this->tratarerro(__FILE__,__FUNCTION__,mysql_errno(),mysql_error(),TRUE));
		mysql_select_db($this->nomedobanco) 
		or die ($this->tratarerro(__FILE__,__FUNCTION__,mysql_errno(),mysql_error(),TRUE));
		mysql_query("SET NAMES 'UTF8'");
		mysql_query("SET character_set_connection=utf8");
		mysql_query("SET character_set_client=utf8");
		mysql_query("SET character_set_results=utf8");
		echo "<br />Metodo conecta foi chamado";
	}	//conecta
	
	public function tratarerro($arquivo=NULL,$rotina=NULL,$numerro=NULL, $msgerro=NULL, $geraexcept=false)
	{
		if ($arquivo==NULL) $arquivo="nao informado";	
		if ($rotina==NULL) 	$rotina="nao informada";
		if ($numerro==NULL) 	$numero=mysql_errno($this->conexao);
		if ($msgerro==NULL)	$msgerro=mysql_error($this->conexao);
		$resultado = 		'<br />Ocorreu um erro com  os seguintes detalhes:<br />
							<strong>Arquivo:</strong> ' .$arquivo. '<br />
							<strong>Rotina:</strong> '	.$rotina. '<br />
							<strong>Codigo:</strong> '	.$numerro. '<br />
							<strong>Mensagem:</strong> '.$msgerro;
		if($geraexcept==FALSE):
			echo ($resultado);
		else:
			die($resultado);
		endif;
	}//tratarerro
	
	//fim da classe banco
}