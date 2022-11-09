<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once("../class/class_oferta.php"); //incluimos clase producto
include_once("../servicio.php"); 
login();

$_POST=json_decode(file_get_contents('php://input'),true); //decodificar el jsonn


switch($_SERVER['REQUEST_METHOD']){
    case 'POST':
        if (isset($_POST['nombre'])&&isset($_POST['descripcion'])&&isset($_POST['id_usuario'])&&isset($_POST['raciones'])&&isset($_POST['h_recogida'])&&isset($_POST['f_recogida'])){
            oferta::guardarMenu($_POST['nombre'],$_POST['descripcion'],$_POST['alergenos'],$_POST['notas'],$_POST['id_usuario'],$_POST['direccion'],$_POST['cp'],$_POST['anotacion'],$_POST['raciones'],$_POST['h_recogida'],$_POST['f_recogida']);
        }else{
            echo 'faltan datos basicos';
        }
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