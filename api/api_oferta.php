<?php
header("Content-Type: application/json");
include_once("../class/class_oferta.php"); //incluimos clase producto
include_once("../servicio.php"); 
login();
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
$_POST=json_decode(file_get_contents('php://input'),true); //decodificar el json


switch($_SERVER['REQUEST_METHOD']){
    case 'POST':

         break;
    case 'GET':
            //todos
            oferta::obtenerOfertas();//ESTATICO  
        break;

    case 'PUT':
        break;

    case 'DELETE':
        break;

    }
?>