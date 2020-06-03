<?php
    include_once dirname(__DIR__).'../model/DB.php';
    include_once dirname(__DIR__).'../model/Recurso.php';

    class RecursoService{

        public function getAll(){
            
            $recursos = [];

            $db = new DB();
            $db->connect();
            
            $resultado = $db->query("SELECT * FROM Recursos ORDER BY cantidad ASC");

            while( $fila = mysqli_fetch_array($resultado) ){
                $recurso = new Recurso($fila['id'],$fila['nombre'],$fila['unidad_medida'],$fila['cantidad']);
                //array_push( arreglo, item a insertar ); 
                array_push($recursos, $recurso);
            }
            
            $db->close();
            
            return $recursos;
        }

        public function getDisponibles(){
            
            $recursos = [];

            $db = new DB();
            $db->connect();
            
            $resultado = $db->query("SELECT * FROM Recursos WHERE cantidad > 0");

            while( $fila = mysqli_fetch_array($resultado) ){
                $recurso = new Recurso($fila['id'],$fila['nombre'],$fila['unidad_medida'],$fila['cantidad']);
                //array_push( arreglo, item a insertar ); 
                array_push($recursos, $recurso);
            }
            
            $db->close();
            
            return $recursos;
        }

        public function findByNombre($nombre){
            $db = new DB();

            $db->connect();
            $resultado = $db->query("SELECT * FROM Recursos WHERE nombre='$nombre' ");
            $recurso = null;
            while( $fila = mysqli_fetch_array($resultado) ){
                $recurso = new Recurso($fila['id'],$fila['nombre'],$fila['unidad_medida'],$fila['cantidad']);
            }
            $db->close();

            return $recurso;
        }

        public function findById($id){
            $db = new DB();

            $db->connect();
            $resultado = $db->query("SELECT * FROM Recursos WHERE id=$id ");
            $cama = null;
            while( $fila = mysqli_fetch_array($resultado) ){
                $recurso = new Cama($fila['id'],$fila['nombre'],$fila['unidad_medida'],$fila['cantidad']);
            }
            $db->close();

            return $recurso;
        }

        public function create($nombre,$unidad_medida,$cantidad){
        
            $sql = "INSERT INTO Recursos(nombre, unidad_medida, cantidad) 
            values ('$nombre','$unidad_medida',$cantidad)";

            $db = new DB();
            $db->connect();
            $exito = $db->query($sql);
            $db->close();
            
            return $exito;
        }

        public function update($id,$nombre,$unidad_medida,$cantidad){
           
            $sql = "UPDATE Recursos
                    SET nombre = '$nombre', unidad_medida = '$unidad_medida', cantidad = $cantidad
                    WHERE id = $id; ";
            
            $db = new DB();
            $db->connect();
            $exito = $db->query($sql);
            $db->close();

            return $exito;
        }


        public function delete($id){
            $sql = "DELETE FROM Recursos where id=$id;";
            
            $db = new DB();          
            $db->connect();
            $exito = $db->query($sql);
            $db->close();

            return $exito;
          }

        public function solicitar($nombre, $cantidad){
            $recurso = $this->findByNombre($nombre);
            $exito = true;
            $nuevaCantidad = 0;
            if( $recurso === null){
                $exito = false;
            }else{
                $nuevaCantidad = $recurso->getCantidad() - $cantidad; 
                if( $nuevaCantidad < 0 ){
                    $exito = false;
                    echo "No existe suficiente cantidad disponible del recurso";
                }
            }

            if( $exito ){
                $exito = $this->update($recurso->getId(),$recurso->getNombre(),$recurso->getUnidades(),$nuevaCantidad);
            }
            return $exito;
        }
    }
?>