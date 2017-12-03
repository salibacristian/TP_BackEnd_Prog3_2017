<?php
require_once './Modelo/Vehiculo.php';
require_once './Interfaces/IApiUsable.php';

class VehiculoService extends Vehiculo implements IApiUsable
{
 	public function TraerUno($request, $response, $args) {
     	$id=$args['id'];
    	$v=Vehiculo::TraerVehiculo($id);
     	$newResponse = $response->withJson($v, 200);  
    	return $newResponse;
    }
     public function TraerTodos($request, $response, $args) {
      	$vehiculos=Vehiculo::TraerVehiculos();
     	$response = $response->withJson($vehiculos, 200);  
    	return $response;
    }
      public function CargarUno($request, $response, $args) {
     	 $ArrayDeParametros = $request->getParsedBody();
        //var_dump($ArrayDeParametros);
		$dominio= $ArrayDeParametros['dominio'];
        $marca= $ArrayDeParametros['marca'];
        $linea= $ArrayDeParametros['linea'];
        $modelo= $ArrayDeParametros['modelo'];
		$color= $ArrayDeParametros['color'];
        
        $v = new Vehiculo();
		$v->dominio=$dominio;
        $v->marca=$marca;
        $v->linea=$linea;
        $v->modelo=$modelo;
		$v->color=$color;
        $v->IngresarVehiculo();

        $archivos = $request->getUploadedFiles();
        $destino="./fotos/";
        //var_dump($archivos);
        //var_dump($archivos['foto']);

        $nombreAnterior=$archivos['foto']->getClientFilename();
        $extension= explode(".", $nombreAnterior)  ;
        //var_dump($nombreAnterior);die();
        $extension=array_reverse($extension);

        $archivos['foto']->moveTo($destino.$dominio.".".$extension[0]);
        $response->getBody()->write("se guardo el vehiculo");

        return $response;
    }
      public function BorrarUno($request, $response, $args) {
     	$ArrayDeParametros = $request->getParsedBody();
     	$id=$ArrayDeParametros['id'];
     	$v= new Vehiculo();
     	$v->id=$id;
     	$cantidadDeBorrados=$v->BorrarVehiculo();

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