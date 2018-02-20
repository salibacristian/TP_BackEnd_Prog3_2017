<?php
class Cochera
{
	public $id;
	public $esParaDiscapacitados;
	public $enUso;
	public $piso;
	public $numero;

	public static function TraerCocheras($libres) 
	{
		$enUso = $libres? 0 : 1;
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  * from Cocheras WHERE enUso =
				:enUso");
			$consulta->bindValue(':enUso',$enUso, PDO::PARAM_INT);
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_CLASS, "Cochera");	
			
	}
  	
	//llamado al ingresar/sacar vehiculo
	public static function Modificar($id,$enUso)
	 {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("
			update Cocheras 
			set 
			enUso = :enUso
			WHERE id =:id");
		$consulta->bindValue(':id',$id, PDO::PARAM_INT); 
		$consulta->bindValue(':enUso',$enUso, PDO::PARAM_INT); 
		
		return $consulta->execute();
	  }
	



}