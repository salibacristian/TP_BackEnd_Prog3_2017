<?php
require_once './Modelo/Operacion.php';
require_once './Interfaces/IApiUsable.php';

class OperacionService extends Operacion //implements IApiUsable
{
 	public function TraerUno($request, $response, $args) {
     	$id=$args['id'];
    	$o=Operacion::TraerOperacion($id);
     	$newResponse = $response->withJson($o, 200);  
    	return $newResponse;
    }
     public function TraerTodos($request, $response, $args) {
      	$operaciones=Operacion::TraerOperaciones();
     	$response = $response->withJson($operaciones, 200);  
    	return $response;
    }
      public function CargarUno($request, $response, $args) {
     	 $ArrayDeParametros = $request->getParsedBody();
        //var_dump($ArrayDeParametros);
		$dominio= $ArrayDeParametros['dominio'];
        $foto= $ArrayDeParametros['foto'];
        $id_empleado_ingreso= $ArrayDeParametros['id_empleado_ingreso'];
		$fecha_hora_ingreso= $ArrayDeParametros['fecha_hora_ingreso'];
        $tiempo= $ArrayDeParametros['tiempo'];
        $importe= $ArrayDeParametros['importe'];
		$color= $ArrayDeParametros['color'];
        
        $o = new Operacion();
		$o->dominio=$dominio;
		$o->id_empleado_ingreso=$id_empleado_ingreso;
        $o->fecha_hora_ingreso=$fecha_hora_ingreso;
		$o->tiempo=$tiempo;
        $o->importe=$importe;
		$o->color=$color;

        $archivos = $request->getUploadedFiles();
        $destino="./fotos/";
        //var_dump($archivos);
        //var_dump($archivos['foto']);

        $nombreAnterior=$archivos['foto']->getClientFilename();
        $extension= explode(".", $nombreAnterior)  ;
        //var_dump($nombreAnterior);die();
        $extension=array_reverse($extension);
		$o->foto=$dominio.".".$extension[0];
		$o->IngresarOperacion();
		$archivos['foto']->moveTo($destino.$dominio.".".$extension[0]);
        $response->getBody()->write("se guardo la operacion");

        return $response;
	}
	
    //   public function BorrarUno($request, $response, $args) {
    //  	$ArrayDeParametros = $request->getParsedBody();
    //  	$id=$ArrayDeParametros['id'];
    //  	$v= new Vehiculo();
    //  	$v->id=$id;
    //  	$cantidadDeBorrados=$v->BorrarVehiculo();

    //  	$objDelaRespuesta= new stdclass();
	//     $objDelaRespuesta->cantidad=$cantidadDeBorrados;
	//     if($cantidadDeBorrados>0)
	//     	{
	//     		 $objDelaRespuesta->resultado="algo borro!!!";
	//     	}
	//     	else
	//     	{
	//     		$objDelaRespuesta->resultado="no Borro nada!!!";
	//     	}
	//     $newResponse = $response->withJson($objDelaRespuesta, 200);  
    //   	return $newResponse;
    // }
     
     // public function ModificarUno($request, $response, $args) {
     	// //$response->getBody()->write("<h1>Modificar  uno</h1>");
     	// $ArrayDeParametros = $request->getParsedBody();
	    // //var_dump($ArrayDeParametros);    	
	    // $micd = new cd();
	    // $micd->id=$ArrayDeParametros['id'];
	    // $micd->titulo=$ArrayDeParametros['titulo'];
	    // $micd->cantante=$ArrayDeParametros['cantante'];
	    // $micd->año=$ArrayDeParametros['anio'];

	   	// $resultado =$micd->ModificarCdParametros();
	   	// $objDelaRespuesta= new stdclass();
		// //var_dump($resultado);
		// $objDelaRespuesta->resultado=$resultado;
		// return $response->withJson($objDelaRespuesta, 200);		
    // }


}