<?php
class Empleado
{
	public $id;
	public $nombre;
 	public $apellido;
	public $clave;
	public $mail;
	public $turno;
	public $perfil;
	public $fecha_creacion;
	public $foto;

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

	 public function IngresarEmpleado()
	 {
		 //var_dump($this);die;
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO Empleados 
		(nombre,apellido,calve,mail,turno,perfil,fecha_creacion,foto)
		VALUES(:nombre,:apellido,:calve,:mail,:turno,:perfil,:fecha_creacion,:foto)");
		$consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
		$consulta->bindValue(':apellido',$this->apellido, PDO::PARAM_STR);
		$consulta->bindValue(':calve', $this->calve, PDO::PARAM_INT);
		$consulta->bindValue(':mail', $this->mail, PDO::PARAM_STR);
		$consulta->bindValue(':turno', $this->turno, PDO::PARAM_STR);
		$consulta->bindValue(':perfil', $this->perfil, PDO::PARAM_STR);
		$consulta->bindValue(':fecha_creacion', $this->fecha_creacion, PDO::PARAM_STR);
		$consulta->bindValue(':foto', $this->foto, PDO::PARAM_STR);
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


  	public static function TraerEmpleados()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from Empleados");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "Operacion");		
	}

	public static function TraerEmpleado($id) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select *
			from Empleados where id = $id");
			$consulta->execute();
			$v= $consulta->fetchObject('Empleado');
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