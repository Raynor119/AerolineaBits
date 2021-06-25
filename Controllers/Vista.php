<?php
    class Vista extends Controllers{
        function inicio(){
           
            require VW . DF . "head.html";
            $this->view->render($this, "inicio");
            
        }

        function pasajero(){
            require VW . DF . "headP.html";
            $this->view->render($this, "pasajero");


        }
        function recepcionista(){

            require VW . DF . "headR.html";
            
            $this->view->render($this, "recepcionista");
                    
        }
        function registrarReserva(){
			$hostname='127.0.0.1';
            $database='aerolinea';
            $username='raynor';
            $password='67895421d';
            $conexion= new mysqli($hostname,$username,$password,$database);   
            if($conexion->connect_errno){
                echo "No se pudo Conectar";
                }else{
                //print("entro");
                
             } 
			$query="SELECT id FROM equipaje order by id desc limit 1";
			$consulta = mysqli_query($conexion,$query);
            $arry=mysqli_fetch_array($consulta);

            $idEquipaje=(int) $arry['id'];


            $idV = $_POST['idV'];
            $cedula = $_POST['cedula'];
            $equipaje = $_POST['Equipaje'];
            //update vuelos set puestos = where id=
            if($equipaje!=""){
                $query="INSERT INTO  equipaje(tipo_maleta) values('".$equipaje."')";
                $consulta2 = mysqli_query($conexion,$query) or die (mysqli_error());
                $idEquipaje=$idEquipaje+1;
                $query="INSERT INTO  reserva(cedulaU,idEquipaje,idVuelo) values('".$cedula."','".$idEquipaje."','".$idV."')";
                $consulta3 = mysqli_query($conexion,$query) or die (mysqli_error());
                $query="SELECT puestos FROM vuelos where id ='".$idV."'";
                $consulta4 =mysqli_query($conexion,$query);
                $arry=mysqli_fetch_array($consulta4);
                $puestos=(int)$arry['puestos'];
                $puestos=$puestos+1;
                $query="update vuelos set puestos = '".$puestos."' where id='".$idV."'";
                $consulta5=mysqli_query($conexion,$query);

            }else{
                $query="INSERT INTO reserva(cedulaU,idVuelo) values('".$cedula."','".$idV."')";
                $consulta3 = mysqli_query($conexion,$query) or die (mysqli_error());
				$query="SELECT puestos FROM vuelos where id ='".$idV."'";
                $consulta4 =mysqli_query($conexion,$query);
                $arry=mysqli_fetch_array($consulta4);
                $puestos=(int)$arry['puestos'];
                $puestos=$puestos+1;
                $query="update vuelos set puestos = '".$puestos."' where id='".$idV."'";
                $consulta5=mysqli_query($conexion,$query);
			
            }
            echo 1;
            
        }
        function Vrecepcionista(){
            $hostname='127.0.0.1';
            $database='aerolinea';
            $username='raynor';
            $password='67895421d';
            $conexion= new mysqli($hostname,$username,$password,$database);   
            if($conexion->connect_errno){
                echo "No se pudo Conectar";
                }else{
                //print("entro");
                
             } 
			$query="SELECT * FROM vuelos";  
            $consulta = mysqli_query($conexion,$query);
            require VW . DF . "headVR.html";
            $this->view->render($this, "recepcionista");

					echo "<div class='container'>";
       
    
        
        
            
                
                
            
        
        
        
        
        
        
    
            
    

            while($arry = mysqli_fetch_array($consulta)){
						echo "<div class='card'>";
                        echo "<img src='http://127.0.0.1:9000/Resources/img/vuelos1.jpg'>";
                        echo "<div class='conten'>";
                        echo "<div class='id'>";
                        echo "<h4>Vuelo Id: </h4>";
                        echo "<h4 id='idV' name='idV'>".$arry['id']."</h4>";
                        echo "</div>";
                        echo "<h6>Fecha: ".$arry['fecha']."</h6>";
                        $cod=$arry['CodAO'];
                        $consulta2 = mysqli_query($conexion,"SELECT ciudad FROM aeropuerto where codigo ='".$cod."'");
                        $arry2=mysqli_fetch_array($consulta2);
                        echo "<h6>Ciudad de Origen: ".$arry2['ciudad']."</h6>";
                        $cod=$arry['CodAD'];
                        $consulta2 = mysqli_query($conexion,"SELECT ciudad FROM aeropuerto where codigo ='".$cod."'");
                        $arry2=mysqli_fetch_array($consulta2);
                        echo "<h6>Ciudad de Destino: ".$arry2['ciudad']."</h6>";
                        $espacios=50;
                        $diferencia=(int) $arry['puestos'];
                        $total=$espacios-$diferencia;
                        echo "<h6>Puestos Disponibles: ".$total."</h6>";
                        echo"<input type='checkbox' id='btn-modal'>";
                        echo "<label for='btn-modal' class='lbl-modal' onclick='idV(".$arry['id'].")'>Hacer una Reserva</label>";
                        echo "</div>";
                        echo "</div>";			                
            }
				echo "</div>";
            


					    
        }

            
            

        function cerrar(){
            session_destroy();
            require VW . DF . "head.html";
            $this->view->render($this, "inicio");
        }


        function login(){
            $hostname='127.0.0.1';
            $database='aerolinea';
            $username='raynor';
            $password='67895421d';
            $conexion= new mysqli($hostname,$username,$password,$database);   
            if($conexion->connect_errno){
                echo "No se pudo Conectar";
                }else{
                //print("entro");
                
             }       
            $usuario = $_POST['usuario'];
            $clave= $_POST['clave'];
            $query="SELECT * FROM usuario inner join persona on usuario.cedula=persona.cedula where usuario = '".$usuario."' and contraseña ='".$clave."'";
            $consulta = mysqli_query($conexion,$query);
            while($arry = mysqli_fetch_array($consulta)){
                $flag[]=$arry;
            }
            $control=false;
            foreach ($flag as &$valor){
                foreach($valor as &$valor1){
                    $control=true;
                    $roll=$valor1;
                    
                }
            }
            
            if($control){
                $_SESSION['usuario'] = $usuario;
                $_SESSION['roll'] = $roll;
                if($roll=="pasajero"){
                    
                    $this->pasajero();
                }else{
                    $this->Vrecepcionista();
                }


            }else{
                require VW . DF . "head.html";
                $this->view->render($this, "inicioe");


            }
        }
    }
?>