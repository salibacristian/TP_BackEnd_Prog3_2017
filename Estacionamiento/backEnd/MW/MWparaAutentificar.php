<?php

require_once './AutentificadorJWT.php';
// require_once './Aplication/SessionService.php';
class MWparaAutentificar
{
 
	public static function VerificarUsuario($request, $response, $next) {
         

		  if($request->isGet())
		  {
		     $response->getBody()->write('<p>NO necesita credenciales para los get </p>');
		     $response = $next($request, $response);
		  }
		  else
		  {
		  		//aqui buscar en la tabla empleados
		    $response->getBody()->write('<p>verifico credenciales</p>');
		    $usr = EmpleadoService::VerificarUsuario($request,$response);
	    	if($usr != null){
			    $objDelaRespuesta= new stdclass();
			    $objDelaRespuesta->user =  $usr;
			    $objDelaRespuesta->token=AutentificadorJWT::CrearToken(array('usuario' => $usr->mail,'perfil' => $usr->perfil));

				$data = Session::getInstance();
				$data->set('userId', $usr->id);
				$data->set('mail', $usr->mail);
				$data->set('perfil', $usr->perfil);
				$data->set('token', $objDelaRespuesta->token);
				$objDelaRespuesta->session = $data->get('mail');
				
		    	MWparaAutentificar::RegistrarInicio($data);
			  
			    $response = $response->withJson($objDelaRespuesta, 200);  

	    
		    	$response->getBody()->write("<h3>Bienvenido</h3>");
		    	$response = $next($request, $response);
			}
		    else $response->getBody()->write('<p>usuario no encontrado</p>');
		      
		  }
		  return $response;   
	}

	 static function RegistrarInicio($data){
		$file = fopen("ingresos.txt", "a");
		$date = date(DATE_ATOM);
		fwrite($file, $data->get('mail') . '-' . $date . PHP_EOL);

		fclose($file);
	}

	public static function VerificarToken($request, $response, $next) {
      try 
      {
      	$ArrayDeParametros = $request->getParsedBody();
        // AutentificadorJWT::verificarToken($ArrayDeParametros['token']);
        $data = Session::getInstance();
        AutentificadorJWT::verificarToken($data->get('token'));
        $response = $next($request, $response);      
      }
      catch (Exception $e) {      
        //guardar en un log
        echo $e;
      }  
      return $response;
	}

	public static function VerificarPerfil($request, $response, $next) {
		try 
		{
			$ArrayDeParametros = $request->getParsedBody();
		  // AutentificadorJWT::verificarToken($ArrayDeParametros['token']);
		  $data = Session::getInstance();
		  if($data->get('perfil') == 'Administrador')
			  $response = $next($request, $response);  
		  else $response->getBody()->write('<p>no tenes habilitado el ingreso</p>');
		}
		catch (Exception $e) {      
		  //guardar en un log
		  echo $e;
		}  
		return $response;
	  }
}