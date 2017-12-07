<?php
class Operacion
{
	public $id;
	public $dominio;
 	public $foto;
	public $id_empleado_ingreso;
	public $id_empleado_salida;
	public $fecha_hora_ingreso;
	public $fecha_hora_salida;
	public $tiempo;
	public $importe;
	public $color;

  	// public function BorrarVehiculo()
	//  {
	//  		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	// 		$consulta =$objetoAccesoDato->RetornarConsulta("
	// 			delete 
	// 			from Vehiculos 				
	// 			WHERE id=:id");	
	// 			$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
	// 			$consulta->execute();
	// 			return $consulta->rowCount();
	//  }

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

	 public function IngresarOperacion()
	 {
		 //var_dump($this);die;
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO Operaciones 
		(dominio,foto,id_empleado_ingreso,id_empleado_salida,fecha_hora_ingreso,fecha_hora_salida,tiempo,importe,color)
		VALUES(:dominio,:foto,:id_empleado_ingreso,:id_empleado_salida,:fecha_hora_ingreso,:fecha_hora_salida,:tiempo,:importe,:color)");
		$consulta->bindValue(':dominio',$this->dominio, PDO::PARAM_STR);
		$consulta->bindValue(':foto',$this->foto, PDO::PARAM_STR);
		$consulta->bindValue(':id_empleado_ingreso', $this->id_empleado_ingreso, PDO::PARAM_INT);
		$consulta->bindValue(':id_empleado_salida', $this->id_empleado_salida, PDO::PARAM_INT);
		$consulta->bindValue(':fecha_hora_ingreso', $this->fecha_hora_ingreso, PDO::PARAM_STR);
		$consulta->bindValue(':fecha_hora_salida', $this->fecha_hora_salida, PDO::PARAM_STR);
		$consulta->bindValue(':tiempo', $this->tiempo, PDO::PARAM_INT);
		$consulta->bindValue(':importe', $this->importe, PDO::PARAM_STR);
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


  	public static function TraerOperaciones()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from Operaciones");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "Operacion");		
	}

	public static function TraerOperacion($id) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select *
			from Operaciones where id = $id");
			$consulta->execute();
			$v= $consulta->fetchObject('Operacion');
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


}