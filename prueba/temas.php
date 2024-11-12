<?php

require_once 'tema.php';
require_once 'utilidades.php';

header('Content-Type: application/json');

$tema = new Tema();

$method = $_SERVER['REQUEST_METHOD'];

$uri = $_SERVER['REQUEST_URI'];

$parametros = Utilidades::parseUriParameters($uri);

$id = Utilidades::getParameterValue($parametros, 'id');
$metodo = Utilidades::getParameterValue($parametros, 'metodo');

switch($method){
    case 'GET':

          $respuesta = getAllTemas($tema);

        echo json_encode($respuesta);
        break;
    case 'POST':
      if($metodo == 'nuevo'){
        setTema($tema);
      }
      if($metodo == 'actualizar'){
        if($id){
          updateTema($tema, $id);
        }else{
          http_response_code(400);
          echo json_encode(['error' => 'ID no proporcionado']);
        }
      }
      if($metodo == 'eliminar'){
        if($id){
          deleteTema($tema, $id);
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


  function getAllTemas($tema){
    return $tema->getAll();
  }

  function setTema($tema){
    $data = json_decode(file_get_contents('php://input'), true);
    if(isset($data['titulo']) && isset($data['artista']) && isset($data['id_spotify']) && isset($data['preview_url']) && isset($data['tempo'])){
      $id = $tema->create($data['titulo'], $data['artista'], $data['id_spotify'], $data['preview_url'], $data['tempo']);
      echo json_encode(['id' => $id]);
    }else{
      echo json_encode(['Error' => 'Datos insuficientes']);
    }
  }


  function deleteTema($tema, $id)
{
    $affected = $tema->delete($id);
    echo json_encode(['affected' => $affected]);
}