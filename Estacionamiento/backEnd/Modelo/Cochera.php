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
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  * from Cocheras WHERE enUso =
				:libres");
			$consulta->bindValue(':libres',$libres, PDO::PARAM_BOOL);
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
			enUso = :enUso,
			WHERE id =:id");
		$consulta->bindValue(':id',$id, PDO::PARAM_INT); 
		$consulta->bindValue(':enUso',$enUso, PDO::PARAM_BOOL); 
		
		return $consulta->execute();
	  }
	



}