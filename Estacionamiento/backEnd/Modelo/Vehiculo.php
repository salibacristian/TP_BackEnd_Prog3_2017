<?php
class Vehiculo
{
	public $id;
	public $dominio;
 	public $marca;
  	public $linea;
  	public $modelo;
	public $color;

  	public function BorrarVehiculo()
	 {
	 		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from Vehiculos 				
				WHERE id=:id");	
				$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();
	 }

	// public static function BorrarCdPorAnio($año)
	 // {

			// $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			// $consulta =$objetoAccesoDato->RetornarConsulta("
				// delete 
				// from cds 				
				// WHERE jahr=:anio");	
				// $consulta->bindValue(':anio',$año, PDO::PARAM_INT);		
				// $consulta->execute();
				// return $consulta->rowCount();

	 // }
	// public function ModificarCd()
	 // {

			// $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			// $consulta =$objetoAccesoDato->RetornarConsulta("
				// update cds 
				// set titel='$this->titulo',
				// interpret='$this->cantante',
				// jahr='$this->año'
				// WHERE id='$this->id'");
			// return $consulta->execute();

	 // }
	

	  // public function ModificarCdParametros()
	 // {
			// $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			// $consulta =$objetoAccesoDato->RetornarConsulta("
				// update cds 
				// set titel=:titulo,
				// interpret=:cantante,
				// jahr=:anio
				// WHERE id=:id");
			// $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
			// $consulta->bindValue(':titulo',$this->titulo, PDO::PARAM_INT);
			// $consulta->bindValue(':anio', $this->año, PDO::PARAM_STR);
			// $consulta->bindValue(':cantante', $this->cantante, PDO::PARAM_STR);
			// return $consulta->execute();
	 // }

	 public function IngresarVehiculo()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into Vehiculos 
				(dominio,marca,linea,modelo,color)
				values(:dominio,:marca,:linea,:modelo,:color)");
				$consulta->bindValue(':dominio',$this->dominio, PDO::PARAM_STR);
				$consulta->bindValue(':marca',$this->marca, PDO::PARAM_STR);
				$consulta->bindValue(':linea', $this->linea, PDO::PARAM_STR);
				$consulta->bindValue(':modelo', $this->modelo, PDO::PARAM_INT);
				$consulta->bindValue(':color', $this->color, PDO::PARAM_STR);
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
	 }
	 // public function GuardarCD()
	 // {

	 	// if($this->id>0)
	 		// {
	 			// $this->ModificarCdParametros();
	 		// }else {
	 			// $this->InsertarElCdParametros();
	 		// }

	 // }


  	public static function TraerVehiculos()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from Vehiculos");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "Vehiculo");		
	}

	public static function TraerVehiculo($id) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select *
			from Vehiculos where id = $id");
			$consulta->execute();
			$v= $consulta->fetchObject('Vehiculo');
			return $v;				

			
	}

	// public static function TraerUnCdAnio($id,$anio) 
	// {
			// $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			// $consulta =$objetoAccesoDato->RetornarConsulta("select  titel as titulo, interpret as cantante,jahr as año from cds  WHERE id=? AND jahr=?");
			// $consulta->execute(array($id, $anio));
			// $cdBuscado= $consulta->fetchObject('cd');
      		// return $cdBuscado;				

			
	// }

	// public static function TraerUnCdAnioParamNombre($id,$anio) 
	// {
			// $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			// $consulta =$objetoAccesoDato->RetornarConsulta("select  titel as titulo, interpret as cantante,jahr as año from cds  WHERE id=:id AND jahr=:anio");
			// $consulta->bindValue(':id', $id, PDO::PARAM_INT);
			// $consulta->bindValue(':anio', $anio, PDO::PARAM_STR);
			// $consulta->execute();
			// $cdBuscado= $consulta->fetchObject('cd');
      		// return $cdBuscado;				

			
	// }
	
	// public static function TraerUnCdAnioParamNombreArray($id,$anio) 
	// {
			// $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			// $consulta =$objetoAccesoDato->RetornarConsulta("select  titel as titulo, interpret as cantante,jahr as año from cds  WHERE id=:id AND jahr=:anio");
			// $consulta->execute(array(':id'=> $id,':anio'=> $anio));
			// $consulta->execute();
			// $cdBuscado= $consulta->fetchObject('cd');
      		// return $cdBuscado;				

			
	// }

	// public function mostrarDatos()
	// {
	  	// return "Metodo mostar:".$this->titulo."  ".$this->cantante."  ".$this->año;
	// }

}