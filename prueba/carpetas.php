<?php

require_once 'carpeta.php';
require_once 'utilidades.php';

header('Content-Type: application/json');

$carpeta = new Carpeta();

$method = $_SERVER['REQUEST_METHOD'];

$uri = $_SERVER['REQUEST_URI'];

$parametros = Utilidades::parseUriParameters($uri);

$id = Utilidades::getParameterValue($parametros, 'id');
$metodo = Utilidades::getParameterValue($parametros, 'metodo');

switch($method){
    case 'GET':
        $respuesta = getAllCarpetas($carpeta);
        echo json_encode($respuesta);
        break;
    case 'POST':
      if($metodo == 'nuevo'){
        setCarpeta($carpeta);
      }
      if($metodo == 'eliminar'){
        if($id){
          deleteCarpeta($carpeta, $id);
        }else{
          http_response_code(400);
          echo json_encode(['error' => 'ID no proporcionado']);
        }
      }
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
  }


  function getAllCarpetas($carpeta){
    return $carpeta->getAll();
  }


  function setCarpeta($carpeta){
    $data = json_decode(file_get_contents('php://input'), true);
    if( isset($data['name']) && isset($data['fecha'])){
      $id = $carpeta->create($data['name'], $data['fecha']);
      echo json_encode(['id' => $id]);
    }else{
      echo json_encode(['Error' => 'Datos insuficientes']);
    }
  }


  function deleteCarpeta($carpeta, $id)
{
    $affected = $carpeta->delete($id);
    echo json_encode(['affected' => $affected]);
}