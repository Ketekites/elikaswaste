<?php
include("conexion.php");
$bd = new BaseDatos();
//------HOSTING ONLINE-----------
$conexion= $bd->conectar("u116520402_elikawaste");
//------LOCAL HOST-----------
//$conexion= $bd->conectar("elika_waste");

class oferta{

    private $id_oferta;
    private $id_usuario;
    private $id_menu;
    private $direccion;
    private $cp;
    private $anotacion;
    private $raciones;
    private $h_recogida;
    private $f_recogida;
    private $estado;


    public function __construct($id_oferta,$id_usuario,$id_menu,$direccion,$cp,$anotacion,$raciones,$h_recogida,$f_recogida,$estado){

        $this->id_oferta=$id_oferta;
        $this->id_usuario=$id_usuario;
        $this->id_menu=$id_menu;
        $this->direccion=$direccion;
        $this->cp=$cp;
        $this->anotacion=$anotacion;
        $this->raciones=$raciones;
        $this->h_recogida=$h_recogida;
        $this->f_recogida=$f_recogida;
        $this->estado=$estado;

    }

    public static function guardarMenu($nombre,$descripcion,$alergenos,$notas,$id_usuario,$direccion,$cp,$anotacion,$raciones,$h_recogida,$f_recogida){
        global $bd;
        $sql = "INSERT INTO menu (nombre,descripcion,alergenos,notas) 
        VALUES ('$nombre','$descripcion','$alergenos','$notas')";
        $bd->insertar($sql);
        $sql="SELECT id_menu FROM menu ORDER BY id_menu DESC LIMIT 1";
        $resultado=$bd->seleccionar($sql);
        $men = mysqli_fetch_assoc($resultado);
        $im = $men['id_menu'];
        $sql = "INSERT INTO oferta (id_usuario,id_menu,direccion,cp,anotacion,raciones,h_recogida,f_recogida,estado) 
        VALUES ('$id_usuario','$im','$direccion','$cp','$anotacion','$raciones','$h_recogida','$f_recogida',1)";
        $bd->insertar($sql);
        $sql="SELECT * FROM oferta ORDER BY id_oferta DESC LIMIT 1";
        $resultado=$bd->seleccionar($sql);

        while ($of = mysqli_fetch_assoc($resultado)) {
             $data[]=$of;
        }
        $var= json_encode($data);
        echo $var;
    }
    public static function obtenerOfertas($idu){
        global $bd;
        $data=[];
        if($idu==0){ 
            $sql="SELECT oferta.*, menu.* FROM oferta inner join menu on oferta.id_menu = menu.id_menu";
            $resultado=$bd->seleccionar($sql);
                while ($ofer = mysqli_fetch_assoc($resultado)) {
                    $data[]=$ofer;
                }
            $var= json_encode($data);

            echo $var;
        }else{
                $sql="SELECT oferta.*, menu.* FROM oferta inner join menu on oferta.id_menu = menu.id_menu where oferta.id_usuario='".$idu."'";
                $resultado=$bd->seleccionar($sql);
                while ($usu = mysqli_fetch_assoc($resultado)) {
                        $data[]=$usu;
                    }
                $var= json_encode($data);
                echo $var;
            }
        }
        public static function obtenerOfertasO($ido){
            global $bd;
            $data=[];

                    $sql="SELECT oferta.*, menu.* FROM oferta inner join menu on oferta.id_menu = menu.id_menu where oferta.id_oferta='".$ido."'";
                    $resultado=$bd->seleccionar($sql);
                    while ($usu = mysqli_fetch_assoc($resultado)) {
                            $data[]=$usu;
                        }
                    $var= json_encode($data);
                    echo $var;
            }
       
        public static function eliminarOferta($id){
            global $bd;
            $sql=" SET FOREIGN_KEY_CHECKS = 0";
            $bd->eliminar($sql);
            $sql="DELETE FROM oferta where id_oferta='$id'";
            $bd->eliminar($sql);
            $sql=" SET FOREIGN_KEY_CHECKS = 1";
            $bd->eliminar($sql);
        }

        public static function modificarOferta($id_oferta,$direccion,$cp,$anotacion,$raciones,$h_recogida,$f_recogida,$id_menu,$nombre,$descripcion,$alergenos,$notas){
            global $bd;
            $sql="UPDATE oferta SET direccion='$direccion',cp='$cp',anotacion='$anotacion',raciones='$raciones',h_recogida='$h_recogida',f_recogida='$f_recogida' where id_oferta='".$id_oferta."'";
            $resultado=$bd->update($sql);
            $sql="UPDATE menu SET nombre='$nombre',descripcion='$descripcion',alergenos='$alergenos',notas='$notas' where id_menu='".$id_menu."'";
            $resultado=$bd->update($sql);
        }

}
