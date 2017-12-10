<?php
require_once './Modelo/Empleado.php';
require_once './Modelo/Ingreso_empleado.php';
require_once './Interfaces/IApiUsable.php';

class EmpleadoService extends Empleado //implements IApiUsable
{
 	public function TraerUno($request, $response, $args) {
     	$id=$args['id'];
    	$e=Empleado::TraerEmpleado($id);
     	$newResponse = $response->withJson($e, 200);  
    	return $newResponse;
    }
     public function TraerTodos($request, $response, $args) {
      	$empleados=Empleado::TraerEmpleados();
     	$response = $response->withJson($empleados, 200);  
    	return $response;
    }
      public function CargarUno($request, $response, $args) {
     	 $ArrayDeParametros = $request->getParsedBody();
        //var_dump($ArrayDeParametros);
		$nombre= $ArrayDeParametros['nombre'];
        $apellido= $ArrayDeParametros['apellido'];
        $clave= $ArrayDeParametros['clave'];
		$mail= $ArrayDeParametros['mail'];
        $turno= $ArrayDeParametros['turno'];
        $perfil= $ArrayDeParametros['perfil'];
        $fecha_creacion= $ArrayDeParametros['fecha_creacion'];

        
        $e = new Empleado();
		$e->nombre=$nombre;
		$e->apellido=$apellido;
        $e->clave=$clave;
		$e->mail=$mail;
        $e->turno=$turno;
		$e->perfil=$perfil;
		$e->fecha_creacion=$fecha_creacion;

        $archivos = $request->getUploadedFiles();
        $destino="./fotosEmpleados/";
        //var_dump($archivos);
        //var_dump($archivos['foto']);

        $nombreAnterior=$archivos['foto']->getClientFilename();
        $extension= explode(".", $nombreAnterior);
        //var_dump($nombreAnterior);die();
        $extension=array_reverse($extension);
		$e->foto=$mail.".".$extension[0];
		$id_empleado = $e->IngresarEmpleado();
		$archivos['foto']->moveTo($destino.$mail.".".$extension[0]);

		$i = new Ingreso_empleado();
		$i->fecha_hora_ingreso=$fecha_creacion;
		$i->id_empleado = $id_empleado;
		$i->Ingresar();

        $response->getBody()->write("se guardo el empleado");

        return $response;
	}
	
      public function BorrarUno($request, $response, $args) {
     	$ArrayDeParametros = $request->getParsedBody();
     	$id=$ArrayDeParametros['id'];
     	$e= new Empleado();
     	$e->id=$id;
     	$cantidadDeBorrados=$e->Borrar();

     	$objDelaRespuesta= new stdclass();
	    $objDelaRespuesta->cantidad=$cantidadDeBorrados;
	    if($cantidadDeBorrados>0)
	    	{
	    		 $objDelaRespuesta->resultado="algo borro!!!";
	    	}
	    	else
	    	{
	    		$objDelaRespuesta->resultado="no Borro nada!!!";
	    	}
	    $newResponse = $response->withJson($objDelaRespuesta, 200);  
      	return $newResponse;
    }
     
     public function ModificarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		//var_dump($ArrayDeParametros); 
	    $e = new Empleado();
	    $e->id=$ArrayDeParametros['id'];
	    $e->nombre=$ArrayDeParametros['nombre'];
	    $e->apellido=$ArrayDeParametros['apellido'];
	    $e->clave=$ArrayDeParametros['clave'];
	    $e->turno=$ArrayDeParametros['turno'];
		$e->perfil=$ArrayDeParametros['perfil'];
		$resultado =$e->Modificar();		
	   	$objDelaRespuesta= new stdclass();
		//var_dump($resultado);
		$objDelaRespuesta->resultado=$resultado;
		return $response->withJson($objDelaRespuesta, 200);		
    }


}