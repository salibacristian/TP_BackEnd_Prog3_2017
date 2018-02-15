<?php
require_once './Modelo/Operacion.php';
require_once './Modelo/Ingreso_empleado.php';
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
      $id_empleado_ingreso= $ArrayDeParametros['id_empleado_ingreso'];
      $fecha_hora_ingreso= $ArrayDeParametros['fecha_hora_ingreso'];
      $color= $ArrayDeParametros['color'];

      $o = new Operacion();
      $o->dominio=$dominio;
      $o->id_empleado_ingreso=$id_empleado_ingreso;
      $o->fecha_hora_ingreso=$fecha_hora_ingreso;
      $o->color=$color;

      $archivos = $request->getUploadedFiles();
      $destino="./fotosVehiculos/";
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

      $i = new Ingreso_empleado();
      $i->fecha_hora_ingreso = $fecha_hora_ingreso;
      $i->id_empleado = $id_empleado_ingreso;
      $i->Ingresar();

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
     
     public function ModificarUno($request, $response, $args) {
     $ArrayDeParametros = $request->getParsedBody();
      // var_dump($ArrayDeParametros);die();

      $o=Operacion::TraerOperacionPorDominio($ArrayDeParametros['dominio']);
      if($o != null){
      //$o = new Operacion();
      //$o->id=$ArrayDeParametros['id'];
      //$o->nombre=$ArrayDeParametros['dominio'];
      $o->id_empleado_salida = $ArrayDeParametros['id_empleado_salida'];//sacarlo del session
      $today = getdate();
      $o->fecha_hora_salida = $today->mday."/".$today->mon."/".$today->year." "
      .$today->hours.":".$today->minutes;


      //format date dd/mm/yyyy hh:mm

      $dateTime = explode(" ", $o->fecha_hora_ingreso);
      $date = explode("/", $dateTime[0]);
      $time = explode(":", $dateTime[1]);
      $day = intval($date[0],10);
      $month = intval($date[1],10);
      $year = intval($date[2],10);
      $hour = intval($time[0],10);
      $min = intval($time[1],10);
      $ingreso = new DateTime(mktime($hour,$min,0,$month,$day,$year));
      $now = new DateTime(date(DATE_ATOM));
      $dif = $now ->diff($ingreso);
      $o->tiempo =  $dif->h;
      $o->importe = $this->CalculateImport($o->tiempo);  

    $resultado =$o->Modificar();    
      $objDelaRespuesta= new stdclass();
    //var_dump($resultado);
    $objDelaRespuesta->resultado=$resultado;
    return $response->withJson($objDelaRespuesta, 200); 
    }	
     return $response->getBody()->write("El auto no está"); 
    }

     function CalculateImport($hours){
      $days = 0;
      $halfDays = 0;
      $resto = $hours;
      if($resto >= 24)
      {
          $days = intval($resto / 24);
          $resto %= 24;
      }
      if($resto >= 12)
      {
        $halfDays = intval($resto / 12);
        $resto %= 12;
      }

      return ($resto * 10) + ($halfDays * 90) + ($days * 170);
    }


}