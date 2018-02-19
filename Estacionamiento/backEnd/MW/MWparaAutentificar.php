<?php

require_once './AutentificadorJWT.php';
class MWparaAutentificar
{
 /**
   * @api {any} /MWparaAutenticar/  Verificar Usuario
   * @apiVersion 0.1.0
   * @apiName VerificarUsuario
   * @apiGroup MIDDLEWARE
   * @apiDescription  Por medio de este MiddleWare verifico las credeciales antes de ingresar al correspondiente metodo 
   *
   * @apiParam {ServerRequestInterface} request  El objeto REQUEST.
 * @apiParam {ResponseInterface} response El objeto RESPONSE.
 * @apiParam {Callable} next  The next middleware callable.
   *
   * @apiExample Como usarlo:
   *    ->add(\MWparaAutenticar::class . ':VerificarUsuario')
   */
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
		    $ArrayDeParametros = $request->getParsedBody();
		    $nombre=$ArrayDeParametros['nombre'];
		    $tipo=$ArrayDeParametros['tipo'];
		    if($tipo=="administrador")
		    {
		      $response->getBody()->write("<h3>Bienvenido $nombre </h3>");
		      $response = $next($request, $response);
		    }
		    else
		    {
		      $response->getBody()->write('<p>no tenes habilitado el ingreso</p>');
		    }  
		  }
		  $objRespuesta = new stdClass();
		  $objRespuesta->datos="algo";
		  $response->getBody()->write('<p>vuelvo del verificador de credenciales</p>');
		  return $response;   
	}

	public static function VerificarToken($request, $response, $next) {
       $response->getBody()->write('<p>recibi token!</p>');
      var_dump($ArrayDeParametros['token']);
      try 
      {
      	$ArrayDeParametros = $request->getParsedBody();
        AutentificadorJWT::verificarToken($ArrayDeParametros['token']);
        $response = $next($request, $response);      
      }
      catch (Exception $e) {      
        //guardar en un log
        echo $e;
      }  
      return $response;
	}
}